<?php
class PageAction extends CommonAction {
    public function __construct() {
        parent::__construct();

    }

    public function index() {
        //导航索引ID
        $this->nid = 3;

      
       
        $cat_id = intval($_GET['cat_id']);
        $article_detail=M('article')->where('cat_id='.$cat_id)->find();//案例详情

        //分类星系
        $cat_id=$article_detail['cat_id'];
        $this->cat_info=M('articlecat')->where('cat_id=3')->find();
        //相关阅读
        $this->newslist= M('article')->where($this->com_where.' and cat_id='.$cat_id)->select();//
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=3 and cat_id='.$cat_id)->find();
        // var_dump($cat_info);die;
       
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
       
        $this->assign('article_detail',$article_detail);
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('space',$space);
        $this->assign('grade',$grade);
        $this->assign('id',$article_detail['article_id']);
    


      $this->display();
    }
   



}
?>