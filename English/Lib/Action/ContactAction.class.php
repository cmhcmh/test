<?php
class ContactAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        // $this->nid = 2;

      
       
        //所有分类
        $this->all_cat=M('articlecat')->where('parent_id=1')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
        $this->banner=M('ads')->where("cat_id=3 and title='联系我们'")->getField('original_img');
         // print_r($this->banner);
        //分类星系
        $cat_id=6;
        $this->cat_info=M('articlecat')->where('cat_id='. $cat_id)->find();
        $a=$this->cat_info;
        $contact=M('article')->where('cat_id=17')->find();
        // echo M('article')->_sql();
          //网站标题 关键字 描述
        $this->site_title       = $a['cat_name']? $a['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $a['keywords']? $a['keywords']:$this->site_info['keyword'];
        $this->site_description = $a['cat_desc']? $a['cat_desc']:$this->site_info['description'];
        // print_r($about);die;
        //用户
        $this->user=M('article')->where('is_open=1 and cat_id=18')->select();

        $this->assign('contact',$contact);
        $this->display();
    }

    public  function message(){

       // print_r($_SESSION['verify']);die;

        if($_SESSION['verify']!=md5(strtoupper($_POST['verify']))){

            $this->error('验证码错误');        
        }
       
        $data['type']=$_POST['user'];
        $data['tel']=$_POST['tel'];
        $data['name']=$_POST['username'];
        $data['content']=addslashes(htmlspecialchars($_POST['content']));
        if(!is_phone($data['tel'])){
           $this->error('手机号码格式不正确');  
        }
        
        $data['add_time']=time();
        $data['ip']=get_ip();

        $add=M('message')->add($data);
        if($add){

            $this->success('您的留言提交成功');
        }else{
            $this->error('留言提交失败');  

        }



    }

}
?>