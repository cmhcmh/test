<?php
class PageAction extends CommonAction {
    public function __construct() {
        parent::__construct();

    }

    public function index() {
        //导航索引ID
        $this->nid = 3;

      
        $cat_id = !empty($_REQUEST['cat_id'])?intval($_REQUEST['cat_id']):35;
        if($cat_id==27 || $cat_id==28){

         $this->banner=M('ads')->where("cat_id=5 and title='无忧工程'")->find();
     }else
     {
         $this->banner=M('ads')->where("cat_id=5 and title='服务保障'")->find();
     }

         
        $article_detail=M('article')->where('cat_id='.$cat_id)->find();//案例详情

        //上层分类
        $cat_sub=M('articlecat')->where('cat_id='.$cat_id)->find();
        $cat_info=M('articlecat')->where('cat_id='.$cat_sub['parent_id'])->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('cat_id='.$cat_id)->find();
        //相关阅读
        $this->article_detail= M('article')->where('cat_id='.$cat_id)->find();//

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
          $this->assign('cat_info',$cat_info);
        $this->assign('id',$article_detail['article_id']);
        $this->display();
    }
   



}
?>