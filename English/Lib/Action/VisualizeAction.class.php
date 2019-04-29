<?php
class VisualizeAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        // $this->nid = 2;

      
       
        //所有分类
        $this->all_cat=M('articlecat')->where('parent_id=1')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
        $this->banner=M('ads')->where("cat_id=3 and title='公司形象'")->getField('original_img');
         // print_r($this->banner);
        //分类星系
        $cat_id=3;
        $this->cat_info=M('articlecat')->where('cat_id='. $cat_id)->find();
        $a=$this->cat_info;
        $about=M('article')->where('cat_id='.$cat_id)->select();
        // echo M('article')->_sql();
          //网站标题 关键字 描述
        $this->site_title       = $a['cat_name']? $a['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $a['keywords']? $a['keywords']:$this->site_info['keyword'];
        $this->site_description = $a['cat_desc']? $a['cat_desc']:$this->site_info['description'];
        // print_r($about);die;
        $this->assign('about',$about);
        $this->display();
    }
}
?>