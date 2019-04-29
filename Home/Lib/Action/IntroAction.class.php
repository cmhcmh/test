<?php
class IntroAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        $this->nid = 2;

      
       
        //所有分类
        $this->all_cat=M('articlecat')->where('parent_id=1')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
        $this->banner=M('ads')->where("cat_id=3 and title='公司简介'")->getField('original_img');
        // print_r($this->banner);
        //分类星系
        $cat_id=$_GET['cat_id']?$_GET['cat_id']:11;
        $this->cat_info=M('articlecat')->where('cat_id='. $cat_id)->find();
        $about=M('article')->where('cat_id='.$cat_id)->find();
          //网站标题 关键字 描述
        $this->site_title       = $about['title']? $about['title']:$this->site_info['title'];
        $this->site_keywords    = $about['keywords']? $about['keywords']:$this->site_info['keyword'];
        $this->site_description = $about['description']? $about['description']:$this->site_info['description'];

        $this->assign('about',$about);
        $this->display();
    }
}
?>