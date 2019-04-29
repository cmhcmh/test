<?php
class NetAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        $this->nid = 1;
        $cat_id=4;
        $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();
        //网站标题 关键字 描述
        $this->site_title       = $cat_info['cat_name']?$cat_info['cat_name']: $this->site_info['title'];
        $this->site_keywords    =$cat_info['keywords']?$cat_info['keywords']: $this->site_info['keyword'];
        $this->site_description = $cat_info['cat_desc']?$cat_info['cat_desc']:$this->site_info['description'];
        
        /************************轮播图*****************************/
        $this->banner           = M('ads')->where("cat_id=3 and title='营销网络'")->order('ads_id asc')->getField('original_img');
        // print_r($this->banner_list);die;

        $this->net=M('article')->where('cat_id='.$cat_id)->select();



        $this->display();
    }
}
?>