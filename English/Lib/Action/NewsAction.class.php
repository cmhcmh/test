<?php
class NewsAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        $this->nid = 3;

      
       
        //所有分类
        $this->all_cat=M('articlecat')->where('parent_id=2')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
        $this->banner=M('ads')->where("cat_id=3 and title='新闻动态'")->getField('original_img');
        // print_r($this->banner);
        //分类星系
        $cat_id=$_GET['cat_id']?$_GET['cat_id']:15;
        $cat_info=M('articlecat')->where('cat_id='. $cat_id)->find();

        $this->site_title       = $cat_info['cat_name']? $cat_info['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $cat_info['keywords']? $cat_info['keywords']:$this->site_info['keyword'];
        $this->site_description = $cat_info['description']? $cat_info['description']:$this->site_info['description'];

        //数据分页
        $where="is_open=1 and cat_id=".$cat_id;
        // echo $where;
        $limit      = $this->limit? $this->limit : 1;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);

        $this->article_list = M('article')->where($where)->order(SO)->limit($Page->firstRow.','.$Page->listRows)->select();
        
    
        $this->assign('totalPage',ceil($count/$limit));

      
          //网站标题 关键字 描述
    

        $this->assign('cat_info',$cat_info);
        $this->display();
    }

    public function detail(){
        $id=$_GET['id'];
        $article_detail=M('article')->where('article_id='.$id)->find();
        $this->all_cat=M('articlecat')->where('parent_id=2')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
        $this->banner=M('ads')->where("cat_id=3 and title='新闻动态'")->getField('original_img');
        // print_r($this->banner);
        //分类星系
        $cat_id=$article_detail['cat_id'];
        $this->cat_info=M('articlecat')->where('cat_id='. $cat_id)->find();
        // var_dump($cat_info);die;
       
        $this->site_title       = $article_detail['cat_name']? $article_detail['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
       
        $this->assign('article_detail',$article_detail);
    


      $this->display();  
    }



}
?>