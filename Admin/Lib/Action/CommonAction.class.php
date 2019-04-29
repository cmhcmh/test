<?php
set_time_limit(0);
class CommonAction extends Action {

    public $loginMarked;
    public $admin_info;

    /**
      +----------------------------------------------------------
     * 初始化
     * 如果 继承本类的类自身也需要初始化那么需要在使用本继承类的类里使用parent::_initialize();
      +----------------------------------------------------------
     */
    public function _initialize() {
        header("Content-Type:text/html; charset=utf-8");
        header('Content-Type:application/json; charset=utf-8');
		    $this->logined();
        
        $systemConfig = include WEB_ROOT . 'Common/systemConfig.php';
		if (empty($systemConfig['TOKEN']['admin_marked'])) {
            $systemConfig['TOKEN']['admin_marked'] = "华浔品味装饰集团";
            $systemConfig['TOKEN']['admin_timeout'] = 3600;
            $systemConfig['TOKEN']['member_marked'] = "http://www.hxdec.com";
            $systemConfig['TOKEN']['member_timeout'] = 3600;
            F("systemConfig", $systemConfig, WEB_ROOT . "Common/");
        }
        $systemConfig1 = include WEB_ROOT . 'Common/systemConfig1.php';
        if (empty($systemConfig1['TOKEN']['admin_marked'])) {
            $systemConfig1['TOKEN']['admin_marked'] = "华浔品味装饰集团";
            $systemConfig1['TOKEN']['admin_timeout'] = 3600;
            $systemConfig1['TOKEN']['member_marked'] = "http://www.hxdec.com";
            $systemConfig1['TOKEN']['member_timeout'] = 3600;
            F("systemConfig", $systemConfig1, WEB_ROOT . "Common/");
        }
        
        $this->assign("site1", $systemConfig1);
		    $this->assign("site", $systemConfig);

        $this->province_list = M()->table('tp_area')->where("a_parentid=0")->select();//地址省份数据

        //$this->company_list = M()->table('tp_company')->select();//地址公司数据

        $this->admin_province_list = M()->table('tp_area')->where("a_parentid=0")->select();//权限省份数据

        //$this->admin_company_list = M()->table('tp_company')->select();//权限公司数据
   
        if(!empty($_SESSION['admin_id']))
        {
          $this->admin_info=M('admin_user')->alias('a')->join("tp_company as b on a.company_id=b.c_id")->where('user_id='.$_SESSION['admin_id'])->find();
          $this->assign("admin_info", $this->admin_info);
          //查询对应的省份，城市，地区
          //$admin_info['province'] = M('area')->where()->getField
        }
        $host_name = $this->getUrlRoot();
        $this->host_name = $host_name[1];
    }

        public function _empty(){
        // 这样写就够了
         header("Location: /index.php");
       // $this -> display();        //会自动调用配置里的 404 页面设置
    }
	
	/**
      +----------------------------------------------------------
     * 判断管理员对某一个操作是否有权限。
      +----------------------------------------------------------
     */
	public function admin_priv($priv_str, $msg_type = '' , $msg_output = true){
		
		if ($_SESSION['action_list'] == 'all'){
			return true;
		}

		if (strpos(',' . $_SESSION['action_list'] . ',', ',' . $priv_str . ',') === false){
			$this->error('您没有权限进行此操作！');
		}else{
			return true;
		}
	}
	
	/**
      +----------------------------------------------------------
     * 记录管理员的操作内容
      +----------------------------------------------------------
     */
	function admin_log($sn = '', $action, $content)
	{
		$M_admin_log = M('admin_log');
		require('./Admin/Lang/' .C('DEFAULT_LANG'). '/log_action.php');
		$log_info = $_LANG['log_action'][$action] . $_LANG['log_action'][$content] .': '. addslashes($sn);

		$data['log_time']=time();
		$data['user_id'] =$_SESSION['admin_id'];
		$data['log_info']=stripslashes($log_info);
		$data['ip_address']=real_ip();
		$M_admin_log->add($data);
	}
	/**
      +----------------------------------------------------------
     * 验证登陆
      +----------------------------------------------------------
     */
      public function getUrlRoot(){
        $domain = $_SERVER['HTTP_HOST'];  
        $host=explode('.',$domain);
        return $host;


    }
	public function logined(){
		if(empty($_SESSION['admin_id'])){
			// $this->error('您的登录信息已过期或者还未登录！',U('Public/index'));
			$this->redirect('Public/index');
		}
	}
	/**
      +----------------------------------------------------------
     * 图片上传
      +----------------------------------------------------------
     */
	function upload($allowExts=array('jpg', 'gif', 'png', 'jpeg'),$savePath,$saveRule,$thumb=true,$thumbPath,$thumbMaxWidth,$thumbMaxHeight,$thumbPrefix){ 
		
		$message = A("Commonfunction");
		import("ORG.Util.UploadFile"); 
		import("ORG.Util.File");
		$upload = new UploadFile(); // 实例化上传类 
		if(!is_dir($savePath)){
			File::make_dir('./'.$savePath);
		}
		$smPath = explode(',',$thumbPath);
		foreach($smPath as $key => $value){
			if(!is_dir($value)){
				File::make_dir('./'.$value);
			}
		}
		
		$upload->maxSize = 3145728 ; // 设置附件上传大小 
		$upload->allowExts = $allowExts; // 设置附件上传类型 
		$upload->savePath = $savePath; // 设置附件上传目录 
		$upload->saveRule = $saveRule; // 上传文件的保存规则 
		$upload->thumb = true; // 是否需要对图片文件进行缩略图处理，默认为false  		
		$upload->thumbPath = $thumbPath;  //缩略图的保存路径，留空的话取文件上传目录本身
		$upload->thumbMaxWidth=$thumbMaxWidth;   //缩略图的最大宽度，多个使用逗号分隔
		$upload->thumbMaxHeight=$thumbMaxHeight;   //缩略图的最大高度，多个使用逗号分隔
		$upload->thumbPrefix=$thumbPrefix;   //缩略图的文件前缀，默认为thumb_  （如果你设置了多个缩略图大小的话，请在此设置多个前缀）
		// $upload->autoSub=true;   //是否使用子目录保存上传文件
		// $upload->subType='date'; 
		
		
		
		if(!$upload->upload()) { // 上传错误 提示错误信息 
			$this->error($upload->getErrorMsg());
		}else{ // 上传成功 获取上传文件信息 
			$info = $upload->getUploadFileInfo(); 
		}
		
		return $info;
	}

    
    //家谱树
    public function supCat($cat_id,$includeself=true,$model = 'articlecat'){
        $tree = array();
        $url = array();
        while($cat_id){
            $cat = M($model)->where(array('cat_id'=>$cat_id))->find();
            $tree[] = $cat;
            $cat_id = $cat['parent_id'];
        }
        if(!$includeself)array_shift($tree);
        return array_reverse($tree);
    }

    //子孙树
    public function subCat($cat_id,$model='articlecat'){
        $cat_list = M($model)->where(array('parent_id'=>$cat_id))->select();
        $tree=array();
        foreach($cat_list as $cat){
            if($cat['parent_id'] == $cat_id){
                $cat['sub_cat'] = $this->subCat($cat['cat_id'],$model);
                $tree[]=$cat;
            }
        }
        return $tree;
    }

    //查找子孙树2
    public function subCat2($model='articlecat',$list,$cat_id=0,$includeself=false,$level=0){
        $level++;
        $tree = array();
        foreach($list as $key=>$value){
            if($value['parent_id']==$cat_id){
                $value['level'] = $level;
                $tree[] = $value;
                $tree = array_merge($tree,$this->subCat2($model,$list,$value['cat_id'],false,$level));
            }
        }
        if($includeself){
            $temp = M($model)->where(array('cat_id'=>$cat_id))->find();
            array_unshift($tree, $temp);
        }
        return $tree;
    }


    //子类ID
    public function sub_cat_ids($cat_id,$model='articlecat',$array=false){
        $sub_cat_tree = is_array($cat_id)? $cat_id : $this->subCat($cat_id,$model);
        $cat_ids = $this->get_sub_cat_ids($sub_cat_tree);
        return $cat_ids?($array? $cat_ids : implode(',',$cat_ids)) : ($array? array($cat_id) : $cat_id);
    }

    //递归求子类cat_id
    private function get_sub_cat_ids($sub_cat_tree){
        $cat_ids = array();
        foreach($sub_cat_tree as $value){
            $cat_ids[] = $value['cat_id'];
            if($value['sub_cat'])$cat_ids = array_merge($cat_ids,$this->get_sub_cat_ids($value['sub_cat']));
        }
        return $cat_ids;
    }
    public function citysublist($parent_id,$level)
    {
        if($level==2){
          $data = M()->table('tp_area')->where(" a_parentid=".$parent_id.' and level=2')->select();//城市数据
        }
        elseif($level==3){
          $data = M()->table('tp_area')->where(" parent_id=".$parent_id.' and level=3')->select();//地区
        }
        return $data;

    }
    public function getcompanyinfo($company_id)
    {
       if(!empty($company_id))
      {

              $company = M('company')->where('c_id='.$company_id)->find();
              $company_info['province_id']=$company['c_province'];
              $company_info['city_id']=$company['c_city'];
              $company_info['company_id']=$company['c_id'];
              $company_info['c_status']=$company['c_status'];
      }
      return $company_info;
    }
      public function getcompanylist($city_id)
    {
       if(!empty($city_id))
      {

              $companylist = M('company')->where('c_city='.$city_id)->select();
      }
      return $companylist;
    }

public function CurlPost($url,$data=''){
$curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包

   // curl_setopt($curl, CURLOPT_TIMEOUT, 100000); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
       echo 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据

        
}

public function CurlGet($url,$data)
{
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
$data = curl_exec($curl);
curl_close($curl);
var_dump($data);
}

public function returnhead($data){

      foreach($data as $key=>$val){
        if(!empty($val['head'])){
        $pos = strpos($val['head'],"ttp");

            if(!$pos)
            {
               $data[$key]['head']="/".$val['head'];

            }
        }
    }

    return $data;

}

}



 function returnhead1($data,$k="")
{
   //$k=!empty($k)?$k:'original_img';
        if(!empty($data)){
        $pos = strpos($data,"ttp");

            if(!$pos)
            {
               $data="/".$data;

            }
        }
        return $data;
}

/* 权限判断，模版里用 */
function admin_priv2($priv_str){
  if ($_SESSION['action_list'] == 'all'){
    return true;
  }
  
  if (strpos($_SESSION['action_list'], $priv_str) === false){
    return false;
  }else{
    return true;
  }
}