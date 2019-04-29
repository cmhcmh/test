<?php
class ProductAction extends CommonAction {
	public function __construct() {
		parent::__construct();

        /******************************网站标题及面包屑导航******************************/
   
	}

    public function index() {

        //banner

            $this->banner=M('ads')->where("cat_id=3 and  title='产品列表页'")->getField('original_img');
            // print_r( $this->banner);

            //顶级分类
            $this->top_cat=M('goodscat')->where('parent_id=0')->order('sort_order asc, cat_id asc ')->select();

            //二级分类
            $re_cat=M('goodscat')->where('parent_id=0 and is_recommend')->getField('cat_id');//获取推荐的顶级id

            $this->son_cat=M('goodscat')->where('parent_id='.$re_cat)->order('sort_order asc ,cat_id asc')->select();
            $cat_id=$_GET['cat_id'];

            //分类信息
            



            if(empty($cat_id)){
            $cat_id=8;
            $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();
            //网站标题 关键字 描述
            $this->site_title       = $cat_info['cat_name']?$cat_info['cat_name']: $this->site_info['title'];
            $this->site_keywords    =$cat_info['keywords']?$cat_info['keywords']: $this->site_info['keyword'];
            $this->site_description = $cat_info['cat_desc']?$cat_info['cat_desc']:$this->site_info['description'];



           //产品总介绍
           //亮点
            $this->point=M('article')->where('cat_id=19 and is_open=1')->select();

           //驱动
            $this->power=M('article')->where('cat_id=20 and is_open=1')->select();

            $this->display('index');
        }else{

            $cat_info=M('goodscat')->where('cat_id='.$cat_id)->find();
            if($cat_info['parent_id']==0){
                //顶级分类
                //二级分类
                $er_cat=M('goodscat')->where('parent_id='.$cat_info['cat_id'])->select();
                

            }else{

                $er_cat=M('goodscat')->where('parent_id='.$cat_info['parent_id'])->select();


            }

            //网站标题 关键字 描述
            $this->site_title       = $cat_info['cat_name']?$cat_info['cat_name']: $this->site_info['title'];
            $this->site_keywords    =$cat_info['keywords']?$cat_info['keywords']: $this->site_info['keyword'];
            $this->site_description = $cat_info['cat_desc']?$cat_info['cat_desc']:$this->site_info['description'];

             $a=goods_cat_list2($cat_id);
             $b=implode(',',$a);
             $where="is_open=1 and  ";
             $where .="cat_id in ($b)";
             // print_r($b);die;
             // $all_pro=M('goods')->where($where)->order('sort_order asc,goods_id desc')->select();
             $limit      = $this->limit? $this->limit : 1;

             import('ORG.Util.Page2');// 导入分页类
             $count      = M('goods')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
             $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
             $Page->setConfig('theme',$this->pageTheme);

             $show       = $Page->show();
             $this->assign('page',$show);

             $this->all_pro = M('goods')->where($where)->order('sort_order asc,goods_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
                
            
             $this->assign('totalPage',ceil($count/$limit));





             // echo M('goods')->_sql();
             $this->assign('er_cat',$er_cat);
             $this->assign('cat',$cat_info);
             // $this->assign('cat_info',$all_pro);
             $this->display('index1');

        }
     



    }


    public function detail(){
        //banner
        $this->banner=M('ads')->where("cat_id=3 and title='产品详细页' ")->getField('original_img');
        $goods_id = $_GET['id']+0;
        $detail = M('goods')->where("goods_id=$goods_id and is_open=1")->find();
         //网站标题 关键字 描述
            $this->site_title       = $detail['title']?$detail['title']: $this->site_info['title'];
            $this->site_keywords    =$detail['keywords']?$detail['keywords']: $this->site_info['keyword'];
            $this->site_description = $detail['description']?$detail['description']:$this->site_info['description'];
        //顶级分类
        $this->top_cat=M('goodscat')->where('parent_id=0')->order('sort_order asc, cat_id asc ')->select();
        //当前分类
        $this->cat_info=M('goodscat')->where('cat_id='.$detail['cat_id'])->find();
        //该分类旗下所有产品
        $this->all_detail=M('goods')->where('is_open=1 and cat_id='.$detail['cat_id'])->select();
        //产品推荐
        $this->is_recommend=M('goods')->where('is_open=1 and is_recommend=1')->order('sort_order asc,goods_id desc')->select();
        $this->assign('detail',$detail);
        $this->display();
    }
}