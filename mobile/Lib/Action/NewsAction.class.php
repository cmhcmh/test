<?php
class NewsAction extends CommonAction {
    public function __construct() {
        parent::__construct();

    }

    public function index() {
        //导航索引ID
        $this->nid = 3;

      
       
        //所有分类
        //$this->all_cat=M('articlecat')->where('parent_id=3')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
       
        //分类星系
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:11;
        //上层分类
        $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();
         $this->banner=M('ads')->where("cat_id=3 and title='".$cat_info['cat_name']."'")->getField('original_img');
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=3 and cat_id='.$cat_id)->find();



        $this->site_title       = $cat_info['cat_name']? $cat_info['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $cat_info['keywords']? $cat_info['keywords']:$this->site_info['keyword'];
        $this->site_description = $cat_info['description']? $cat_info['description']:$this->site_info['description'];

            //重新定义where条件
        if($this->company_id==0 && $cat_id!=11)
        {
            $this->com_where='1  and is_show=1'; //文章条件
        }
         $this->company_sort_new='add_time desc,sort_order asc';
 
        $this->newslist      = M('article')->where($this->com_where.' and cat_id='.$cat_id)->order($this->company_sort_new)->limit(20)->field('article_id,title,original_img,description,short')->select();//

      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('cat_id',$cat_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
    
        $html="";
        $cat_id = !empty($_REQUEST['cat_id'])?intval($_REQUEST['cat_id']):0;
        $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();

        $pages =  intval($_POST['pages']);
        $keywords =  intval($_POST['keywords']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页

         //搜索
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }


            //重新定义where条件
        if($this->company_id==0 && $cat_id!=11)
        {
            $this->com_where='1  and is_show=1'; //文章条件
        }
        $this->company_sort_new='add_time desc,sort_order asc';

         $arr= M('article')->where($this->com_where.' and cat_id='.$cat_id)->order($this->company_sort_new)->limit($pages,20)->field('article_id,title,original_img,description,short')->select();//


         foreach ($arr as $key=>$val){
            $val['href'] = U("News/detail",array("id"=>$val["article_id"]));
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.='<li class="clearfix clearfixs">
                        <a href="'.$val["href"].'">
                            <div class="lazy fl"><img data-original="'.returnhead1($val["original_img"]).'" class="lazy_img"></div>
                            <div class="fr gui_t">
                                <h2 class="txt_overflow">'.$val["title"].'</h2>
                                <p>'.$val["short"].'</p>
                            </div>
                        </a>
                    </li>';
         }
        echo $html;exit;


    }



    public function detail(){
        $id = intval($_GET['id']);
        //$article_detail=M('article')->where($this->com_where.' and article_id='.$id)->find();//案例详情
        $article_detail=M('article')->where('1 and article_id='.$id)->find();//案例详情

        //分类星系
        $cat_id=$article_detail['cat_id'];

        $this->cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();

        //相关阅读
               //重新定义where条件
        if($this->company_id==0 && $cat_id!=11)
        {
            $this->com_where='1  and is_show=1'; //文章条件
        }
 
        $this->newslist= M('article')->where($this->com_where.' and cat_id='.$cat_id)->limit(6)->select();//

        // var_dump($cat_info);die;
       
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->news_site_title       =  $this->cat_info['cat_name'];

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


    public function setcomcat($data)
    {
         $data_arr =array();
        if(!empty($data))
        {

            foreach($data as $k=>$v)
            {
                $data_arr[$v['com_id']]=$v;
            }

            return $data_arr;
        }


    }



}
?>