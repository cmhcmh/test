<?php
class IndexAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        $this->nid = 1;

        //网站标题 关键字 描述
        $this->site_title       = '首页 - '.$this->site_info['title'];
        $this->site_keywords    = $this->site_info['keyword'];
        $this->site_description = $this->site_info['description'];
        
        /************************轮播图*****************************/
        $this->banner_list      = M('ads')->where('cat_id=2')->order('ads_id asc')->select();

        //公司简介
        $this->intr_c=M('articlecat')->where('cat_id=1')->find();
        //$this->fbo_projects     = array_slice($this->all_cats[4]['sub_cat'], 0, 3);
        $this->fbo_projects     = M('ads')->where('cat_id=6')->limit(3)->select();

        //产品服务
        $this->rec_services     = $this->all_cats[1]['sub_cat'];

        //新闻中心
        $this->news_c=M('articlecat')->where('cat_id=2')->find();
        //推荐新闻
        $this->news_list=M('article')->where('is_open=1 and is_recommend=1')->order('sort_order asc,add_time desc')->select();

        //产品
        $goodscat=M('goodscat');
        $godds=M('goods');
        //推荐的产品分类
        $goodscat_info= $goodscat->where('is_recommend=1 and parent_id <> 0')->select();
        $arr=array();
        foreach($goodscat_info as $key=>$value){

            $goods_info= $godds->where('is_recommend=1 and is_open=1 and cat_id='.$value['cat_id'])->order('sort_order asc,add_time desc,goods_id asc')->select();
            $arr[$key]['info']=$goods_info;
           
        }
        // print_r($arr);die;
       $this->assign('goodscat_info',$goodscat_info);
       $this->assign('arr',$arr);


        $this->display();
    }
}
?>