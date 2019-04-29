<?php
require_once('Home/Lib/Action/sms.php');

class MemberAction extends CommonAction {

	public function __construct() {
		parent::__construct();
	}

    public function member() {
	
       $this->display();
    }
	
	public function reg() {
		// echo '22222222222222222222';
        $this->display();
    }

	public function memberindex(){
		// echo '3333333333333333';
        $this->display();
    }

	private function postRequest($url, $data = '')
	{
		$header = array(
			'Content-Type' => 'application/json;charset=utf-8',
		);
	//   初始化连接资源
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
	//   设置不验证ssl证书
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	//	设置请求结果以文件流的形式返回
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		if ( $data ) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		}
	 //  发送请求
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
	}

	
	public function add(){
		$uname = $_POST['username'];
		$uemail = $_POST['email'];
		$uphone = $_POST['phone'];
		$password = $_POST['password'];
		// $password2 = $_POST['password2'];
		//验证输入数据
		if($uname   == '' or
		   $password   == '' or
		   $uemail      == '')
		{
			die("<script type=\"text/javascript\">alert('字段不能为空');history.go(-1);</script>");
			exit();
		}
		if ($_SESSION['verify'] != md5(strtoupper($_POST['verify']))) {
            die("<script type=\"text/javascript\">alert('请正确的验证码');history.go(-1);</script>");
        }
		// $password2    = $_POST['password2'];
		// if($password2 != $_POST['password']){
			// die("<script type=\"text/javascript\">alert('两次密码不一致');history.go(-1);</script>");
		// }
		if(strlen($_POST['phone'])<11 or strlen($_POST['phone'])>11){
			die("<script type=\"text/javascript\">alert('请输入的正确电话');history.go(-1);</script>");
		}
		
		$login = M()->table('tp_member')->where(("user_name='$uname' or phone=$uphone"))->find();
		
		if($uname == $login['user_name']){
			die("<script type=\"text/javascript\">alert('此用户名已存在！');history.go(-1);</script>");
		}
		elseif($uphone == $login['phone']){
			die("<script type=\"text/javascript\">alert('此手机号已注册！');history.go(-1);</script>");
		}
		// elseif($uemail == $login['email']){
			// die("<script type=\"text/javascript\">alert('此邮箱已注册！');history.go(-1);</script>");
		// }
		$Model = M("member");
		$data['user_name']     = $_POST['username'];
		$data['password']    = md5($_POST['password']);
		$data['phone']     = $_POST['phone'];
		$data['add_time']     = time();
		$data['email']     = $_POST['email'];
		$data['type']     = 0;
		
		$insert = $Model->data($data)->add();

		if($insert){
			echo "<script type=\"text/javascript\">alert('注册成功');</script>";
			
			
			$name    = $_POST['username'];
			$password    = md5($_POST['password']);
			
			$user = M()->table('tp_member')->where((" phone='$name' or user_name='$name' "))->find();
			$data['login_count'] = $user['login_count']+1;

			if($password != $user['password']){
				die("<script type=\"text/javascript\">alert('密码不正确！');history.go(-1);</script>");
				
			}
				
			$updateId=M()->table('tp_member')->where(array('user_id'=>$user['user_id']))->save($data);
			
			// die("<script type=\"text/javascript\">alert('登陆成功！');history.go(-1);</script>");
			
			C( 'api_appsecret', '7eCQqiAl5i3xLYhEomjQ3oWPqOQdP45r' );
			C( 'api_appkey', 'AEQXIQyrQM' );
			$timestamp = $this -> getMillisecond();
			$appuid = $user['user_id'];
			//换取token参数
			$urlParams = array(
				'appkey' => C( 'api_appkey' ),
				'timestamp' => $timestamp,
				'sign' => $this -> getSign( C('api_appsecret'), C( 'api_appkey' ), $appuid, $timestamp ),
			);
			//需要传的用户参数
			$postData = array(
				'appuid' => $appuid,
				'appuname' => $user['user_name'],
				'appuemail' => $user['email'],
				'appuphone' => $user['phone'],
				'appussn' => '',
				'appuaddr' => '',
				'apputype' => '1',
				'appuavatar' => 'https://qhyxpicoss.kujiale.com/avatars/2014/09/10/KQIBDTSDN5IWG4VGABAQAAAA.jpg',
			);
			
			$url = 'http://www.kujiale.com/p/openapi/login?' . http_build_query($urlParams);
			$res = $this->postRequest($url,$postData);
			$arr = json_decode($res,true);
			// echo $res;
			$durl = $arr['errorMsg'].'&dest=4';

			//按订单形式插入订单表并短信提醒代码开始
			if($durl){
			
				$data['name']=$_POST['username'];
				
				$data['hourse']='默认没有';
			 
				$hourse_new='默认没有';

				if($hourse_new)
				{
					$data['hourse'] =$hourse_new;
					 if(eregi("[^\x80-\xff]",$data['hourse'])){ 
					   $this->error('楼盘请填写中文');  
				   }
				}
				$data['design_name']='默认没有';
				   $design_new='默认没有';
				if($design_new)
				{
					$data['design_name'] =$design_new;
				}
				$data['content']='在线设计注册';
				$data['address']='在线设计注册';
				$data['tel']=addslashes(htmlspecialchars($_POST['phone']));
				$data['type']='191';
				$data['province_id']=!empty($_POST['province_id'])?$_POST['province_id']:0;
				$data['city_id']=!empty($_POST['city_id'])?$_POST['city_id']:0;
				$data['district_id']=!empty($_POST['district_id'])?$_POST['district_id']:0;
				$data['company_id']=!empty($_POST['company_id'])?$_POST['company_id']:0;
				$data['add_time']=time();
				 $data['is_equ']=!empty($_POST['is_equ'])?$_POST['is_equ']:0;
				$data['ip']=get_ip();
				
				$add=M('message')->add($data);
				if($add){
					// $data1 =array(
						// 'info' =>'您的留言提交成功',
						// 'status'=>1
					// );
					//在这里插入短信发送
					$com_id = M('company')->where('c_id='.$data['company_id'])->find();
					$areaname1 = M('area')->where('a_id='.$data['province_id'])->find();
					$areaname2 = M('area')->where('a_id='.$data['city_id'])->find();
						if(empty($com_id['c_name'])){
							$com_id['c_name'] = '集团';
						}
												
					$da = array(
						"ssgs" => $com_id['c_name'],
						"yhm" => $data['name'],
						"dh" => $data['tel'],
						"dz" => '在线设计',
						"xq" => '在线设计'
					);
					$response = SmsDemo::sendBatchSms($data['tel'],$da);
					
					// $this->ajaxReturn($data1);
					//dump($data1);
				
					
			}}
					
			$this->assign('durl', $durl);
			$this->display(login);
			
			
			
			// $this->success('注册成功!',U('Member/member'));
		}else{
			$this->error('注册失败！！',U('Member/reg/'));
		}
		exit();
	}
	
	public function login(){
		
		$name    = $_POST['name'];
		$password    = md5($_POST['password']);
		//验证输入数据
		if($name   == '' or $password   == '' ) {
			 die("<script type=\"text/javascript\">alert('字段不能为空');history.go(-1);</script>");
			exit();
		}
		if ($_SESSION['verify'] != md5(strtoupper($_POST['verify']))){
            die("<script type=\"text/javascript\">alert('请正确的验证码');history.go(-1);</script>");
        }
		 $loginuser = M()->table('tp_member')->where(" email='$name' or phone='$name' or user_name='$name' ")->select();
		if($loginuser == false){
			 die("<script type=\"text/javascript\">alert('登陆账号或密码不正确！');history.go(-1);</script>");
		 }
		
		$user = M()->table('tp_member')->where((" email='$name' or phone='$name' or user_name='$name' "))->find();
		$data['login_count'] = $user['login_count']+1;

		if($password != $user['password']){
			die("<script type=\"text/javascript\">alert('密码不正确！');history.go(-1);</script>");
			
		}
			
		$updateId=M()->table('tp_member')->where(array('user_id'=>$user['user_id']))->save($data);
		
		// die("<script type=\"text/javascript\">alert('登陆成功！');history.go(-1);</script>");
		
		C( 'api_appsecret', '7eCQqiAl5i3xLYhEomjQ3oWPqOQdP45r' );
		C( 'api_appkey', 'AEQXIQyrQM' );
		$timestamp = $this -> getMillisecond();
		$appuid = $user['user_id'];
		//换取token参数
		$urlParams = array(
			'appkey' => C( 'api_appkey' ),
			'timestamp' => $timestamp,
			'sign' => $this -> getSign( C('api_appsecret'), C( 'api_appkey' ), $appuid, $timestamp ),
		);
		//需要传的用户参数
		$postData = array(
			'appuid' => $appuid,
			'appuname' => $user['user_name'],
			'appuemail' => $user['email'],
			'appuphone' => $user['phone'],
			'appussn' => '',
			'appuaddr' => '',
			'apputype' => '1',
			'appuavatar' => 'https://qhyxpicoss.kujiale.com/avatars/2014/09/10/KQIBDTSDN5IWG4VGABAQAAAA.jpg',
		);
		
		$url = 'http://www.kujiale.com/p/openapi/login?' . http_build_query($urlParams);
		$res = $this->postRequest($url,$postData);
		$arr = json_decode($res,true);
	 // echo $res;
		$durl = $arr['errorMsg'].'&dest=4';//把最终的token加dest传给HTML并加装最终的页面

		$this->assign('durl', $durl);
		$this->display();
		// dump($postData);die;
		// $this->success($user['user_name'].'欢迎您登陆!',U('member/login'));	
		// die("<script type=\"text/javascript\">alert('欢迎登陆！');</script>");
				
	}
	
	private function getSign( $appsecret, $appkey, $appuid, $timestamp ) {
		return md5($appsecret . $appkey . $appuid . $timestamp);
	}
	
	private function getMillisecond() {
		list($t1, $t2) = explode(' ', microtime());
		return ($t2 .  ceil( ($t1 * 1000) ));
	}
	
		
	
	

	
}






?>