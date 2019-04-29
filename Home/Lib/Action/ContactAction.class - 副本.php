<?php
require_once('Home/Lib/Action/sms.php');

class ContactAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        // $this->nid = 2;

        $type = !empty($_REQUEST['type'])?intval($_REQUEST['type']):1;
        $hourse_id = !empty($_REQUEST['hourse_id'])?addslashes(htmlspecialchars($_REQUEST['hourse_id'])):'';
        $design_id = !empty($_REQUEST['design_id'])?addslashes(htmlspecialchars($_REQUEST['design_id'])):'';
        if($design_id)
        {
            $design =M('article')->where('article_id='.$design_id)->find();
            $design_name = $design['title'];
        }

          if($hourse_id)
        {
            $hoursedata =M('article')->where('article_id='.$hourse_id)->find();
            $hourse = $hoursedata['title'];
        }
       
        //所有分类
        $this->all_cat=M('articlecat')->where('parent_id=1')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
        $this->banner=M('ads')->where("cat_id=3 and title='联系我们'")->getField('original_img');
        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();
         // print_r($this->banner);

             /************************报名业主数据*****************************/
        $this->message      = M('message')->where('type='.$type)->select();//
        $this->message_num =count($this->message);

        //分类星系
        $cat_id=6;
        $this->cat_info=M('articlecat')->where('cat_id='. $cat_id)->find();
        $a=$this->cat_info;
        $contact=M('article')->where('cat_id=17')->find();
        // echo M('article')->_sql();
          //网站标题 关键字 描述
        $a['cat_name']='在线预约';
		if(!$this->cat_less_info)
        {
             $page_title = $this->cat_less_info;
        }else
        {
           $page_title = $cat_info;
        }
        $this->site_title       = $a['cat_name']? $a['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $a['keywords']? $a['keywords']:$this->site_info['keyword'];
        $this->site_description = $a['cat_desc']? $a['cat_desc']:$this->site_info['description'];
        // print_r($about);die;
        $this->assign('hourse',$hourse);
        $this->assign('design_name',$design_name);
        $this->assign('type',$type);
        $this->assign('contact',$contact);
        $this->display(); 
    }
	
     public  function message(){

       // print_r($_SESSION['verify']);die;
        
        /*if($_SESSION['verify']!=md5(strtoupper($_POST['verify']))){

            $this->error('验证码错误');        
        }*/

        $data['name']=addslashes(htmlspecialchars($_POST['name']));
        if(eregi("[^\x80-\xff]",$data['name'])){ 
               $this->error('姓名请填写中文');  
        }
        $data['hourse']=addslashes(htmlspecialchars($_POST['hourse']));
      if(eregi("[^\x80-\xff]",$data['hourse'])){ 
               $this->error('楼盘请填写中文');  
        }
        $hourse_new=addslashes(htmlspecialchars($_POST['hourse_new']));

        if($hourse_new)
        {
            $data['hourse'] =$hourse_new;
             if(eregi("[^\x80-\xff]",$data['hourse'])){ 
               $this->error('楼盘请填写中文');  
           }
        }
        $data['design_name']=addslashes(htmlspecialchars($_POST['design_name']));
           $design_new=addslashes(htmlspecialchars($_POST['design_new']));
        if($design_new)
        {
            $data['design_name'] =$design_new;
        }
        $data['content']=addslashes(htmlspecialchars($_POST['content']));
        $data['address']=addslashes(htmlspecialchars($_POST['address']));
        $data['tel']=addslashes(htmlspecialchars($_POST['mobile']));
        $data['type']=$_POST['type'];
        $data['province_id']=!empty($_POST['province_id'])?$_POST['province_id']:0;
        $data['city_id']=!empty($_POST['city_id'])?$_POST['city_id']:0;
        $data['district_id']=!empty($_POST['district_id'])?$_POST['district_id']:0;
        $data['company_id']=!empty($_POST['company_id'])?$_POST['company_id']:0;
        $data['add_time']=time();
        $data['is_equ']=!empty($_POST['is_equ'])?$_POST['is_equ']:0;
        $data['yuming']=$_SERVER['SERVER_NAME'];
        $data['ip']=get_ip();

         if(!is_phone($data['tel'])){
           $this->error('手机号码格式不正确');  
           exit;
        }
        
        $add=M('message')->add($data);
        if($add){
            $data1 =array(
                'info' =>'您的留言提交成功',
                'status'=>1
            );
			//在这里插入短信发送
			$com_id = M('company')->where('c_id='.$data['company_id'])->find();
			$areaname1 = M('area')->where('a_id='.$data['province_id'])->find();
			$areaname2 = M('area')->where('a_id='.$data['city_id'])->find();
				if(empty($com_id['c_name'])){
					$com_id['c_name'] = '集团';
				}
				if(empty($areaname2['area_name'])){
					$areaname2['area_name'] = '';
				}
				 if($data['is_equ'] == 1){
					 $is_equ ='PC';
				 }elseif($data['is_equ'] == 2){
					 $is_equ ='WAP';
				}
				$da = array(
                "xdly" => $is_equ,
                "ssgs" => $com_id['c_name'],
                "yhm" => $data['name'],
                "dh" => $data['tel'],
                "dz" => $areaname1['area_name'].$areaname2['area_name'],
                "xq" => $data['hourse']
            );
			$response = SmsDemo::sendBatchSms($data['tel'],$da);
			
			$this->ajaxReturn($data1);
			//dump($data1);
			exit;
			
        }else{
            $this->error('留言提交失败');  

        }



    }
}
?>