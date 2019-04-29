<?php
class GalleryAction extends CommonAction {
	public function __construct() {
		parent::__construct();

	}

    public function index() {
        //导航索引ID
        $this->nid = 3;

       
        //所有分类
        //$this->all_cat=M('articlecat')->where('parent_id=3')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
       // $this->banner=M('ads')->where("cat_id=3 and title='案例展示'")->getField('original_img');
        //分类星系
        $this->banner=M('ads')->where("cat_id=5 and title='装修案例'")->find();
        $space_id = !empty($_REQUEST['space_id'])?intval($_REQUEST['space_id']):0;
        $style_id = !empty($_REQUEST['style_id'])?intval($_REQUEST['style_id']):0;
        $keywords=!empty($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:17;
      //上层分类
        $cat_info=M('articlecat')->where('cat_id=2')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=2 and cat_id='.$cat_id)->find();
           if(!$this->cat_less_info)
        {
            $page_title = $cat_info;
        }else
        {
            $page_title = $this->cat_less_info;
        }

        $this->site_title       = $page_title['cat_name']? $page_title['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $page_title['keywords']? $page_title['keywords']:$this->site_info['keyword'];
        $this->site_description = $page_title['cat_desc']? $page_title['cat_desc']:$this->site_info['cat_desc'];


        //风格
         $style = M('comcat')->where("type_filed='style'")->select();
         $style = $this->setcomcat($style);

        //空间
        $space = M('comcat')->where("type_filed='space'")->select();
        $space = $this->setcomcat($space);

        //案例图片

        $arr = M('picimg')->where('p_articleid='.$id)->order('p_comid desc')->limit($pages,6)->select();



          /************************图库*****************************/
          /*
         $list = M('article')->where('cat_id=16')->getField('article_id,title');
         foreach($list as $key=>$val)
         {
            $list_ids[$key]=$key;
         }
         $string=implode(',',$list_ids);*/
       //  $where=' and article_id in('.$string.')';
         $where=' and p_articlecatid in(16)';
        if($space_id) $where.=' and p_comid='.$space_id;
        if($style_id) $where.=' and style='.$style_id;
             if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }


         $limit      = $this->limit? $this->limit :32;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('picimg')->where($this->com_where.$where)->join('tp_article on tp_picimg.p_articleid=tp_article.article_id')->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);
        $show       = $Page->show();
        $this->assign('page',$show);
        $this->gallery      = M('picimg')->where($this->com_where.$where)->join('tp_article on tp_picimg.p_articleid=tp_article.article_id')->limit($Page->firstRow.','.$Page->listRows)->select();//

      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('style',$style);
        $this->assign('space',$space);
        $this->assign('space_id',$space_id);
        $this->assign('style_id',$style_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
    
        $html="";
        $space_id = !empty($_REQUEST['space_id'])?intval($_REQUEST['space_id']):0;
        $style_id = !empty($_REQUEST['style_id'])?intval($_REQUEST['style_id']):0;

        $pages =  intval($_POST['pages']);
        $keywords =  intval($_POST['keywords']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页
        $list = M('article')->where('cat_id=16')->getField('article_id,title');
         foreach($list as $key=>$val)
         {
            $list_ids[$key]=$key;
         }
         $string=implode(',',$list_ids);
         $where=' and article_id in('.$string.')';
        if($space_id) $where.=' and p_comid='.$space_id;
        if($style_id) $where.=' and style='.$style_id;


         //搜索
        $keywords=!empty($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }

           //风格
         $style = M('comcat')->where("type_filed='style'")->select();
         $style = $this->setcomcat($style);

        //空间
        $space = M('comcat')->where("type_filed='space'")->select();
        $space = $this->setcomcat($space);


        $arr    = M('picimg')->where($this->com_where.$where)->join('tp_article on tp_picimg.p_articleid=tp_article.article_id')->limit($pages,6)->select();//

         foreach ($arr as $key=>$val){
            //$val['href'] = U("Case/detail",array("id"=>$val["article_id"]));
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.=' <a class="lazy clearfixs" data-size="750x400" data-med="/'.$val["p_path"].'" data-med-size="750x400">
                    <img src="/'.$val["p_path"].'" class="lazy_img"/>
                        <p>'.$space[$val["p_comid"]]["com_name"].'-'.$style[$val["style"]]["com_name"].'-'.$val["title"].'
                        </p>
                        
                </a>';
         }
        echo $html;exit;


    }



     //加载空间数据
    public function loadpic(){
    
        $html="";

        $pages =  intval($_POST['pages']);
        $pages=$pages?$pages:0;
        $id = intval($_POST['id']);
        $id=$id?$id:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页
        $where=" and cat_id in(16)";

        $arr = M('picimg')->where('p_articleid='.$id)->order('p_comid desc')->limit($pages,6)->select();

         //空间
        $space =M('comcat')->where("type_filed='space'")->select();
        $space = $this->setcomcat($space);

         foreach ($arr as $key=>$val){
            //$val['href'] = U("Case/detail",array("id"=>$val["article_id"]));
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.=' <div class="item clearfixs">
                        <a href="javascript:void(0)">
                            <div class="pic lazy">
                                <img data-original="/'.$val["p_path"].'" class="lazy_img">
                            </div>
                        </a>
                        <h2>'.$space[$val["p_comid"]]["com_name"].'</h2>
                    </div>';
         }
        echo $html;exit;


    }

      public function detail() {
        //导航索引ID
        $this->nid = 3;

        $this->css_style='background: #333333;';
       
        //所有分类
        //$this->all_cat=M('articlecat')->where('parent_id=3')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
       // $this->banner=M('ads')->where("cat_id=3 and title='案例展示'")->getField('original_img');
        //分类星系
         $id = !empty($_REQUEST['id'])?intval($_REQUEST['id']):0;
        $space_id = !empty($_REQUEST['space_id'])?intval($_REQUEST['space_id']):0;
        $style_id = !empty($_REQUEST['style_id'])?intval($_REQUEST['style_id']):0;
        $keywords=!empty($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:17;
        //上层分类
        $cat_info=M('articlecat')->where('cat_id=2')->find();
        $this->banner=M('ads')->where("cat_id=5 and title='装修案例'")->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=2 and cat_id='.$cat_id)->find();
        $this->site_title       = $cat_info['cat_name']? $cat_info['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $cat_info['keywords']? $cat_info['keywords']:$this->site_info['keyword'];
        $this->site_description = $cat_info['description']? $cat_info['description']:$this->site_info['description'];


        //风格
         $style = M('comcat')->where("type_filed='style'")->select();
         $style = $this->setcomcat($style);

         foreach($style as $k=>$v)
         {
           $style_article = M('article')->where('cat_id=16 and style='.$v['com_id'])->getField('article_id',true);
            $style_article_ids = implode(',',$style_article);

            $num = M('picimg')->where('p_articleid in('.$style_article_ids.')')->count();
            if($num){
                $style[$k]['num'] = $num;
            }else
            {
                $style[$k]['num'] = 0;
            }
           
         }
       
                    

        //空间
        $space = M('comcat')->where("type_filed='space'")->select();
        $space = $this->setcomcat($space);


         foreach($space as $k=>$v)
         {
           $space[$k]['num'] = M('picimg')->where('p_comid='.$v['com_id'])->count();
         }
        //案例图片

       // $arr = M('picimg')->where('p_articleid='.$id)->order('p_comid desc')->limit($pages,6)->select();



          /************************图库*****************************/
          /*
         $list = M('article')->where('cat_id=16')->getField('article_id,title');
         foreach($list as $key=>$val)
         {
            $list_ids[$key]=$key;
         }
         $string=implode(',',$list_ids);
         $where=' and article_id in('.$string.')';*/

           $where=' and p_articlecatid in(16)';
        if($id)
        {
          $where=' and p_id='.$id;
        }
        if($space_id) {
            $where.=' and p_comid='.$space_id;
            $where_new =' and p_comid='.$space_id; 
        };
        if($style_id) {
            $where.=' and style='.$style_id;
             $where_new =' and style='.$style_id; 
        };
             if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }




         $limit      = $this->limit? $this->limit :8;


        $this->gallery      = M('picimg')->where($this->com_where.$where)->join('tp_article on tp_picimg.p_articleid=tp_article.article_id')->order('p_id asc')->find();//
        

        
        $pid = $this->gallery['p_id'];

        $where_pre=" and p_id < $pid";
        $this->pre = M('picimg')->where($this->com_where.' and p_articlecatid in(16)'.$where_pre.$where_new)->join('tp_article on tp_picimg.p_articleid=tp_article.article_id')->order('p_id desc')->find();//;
        $where_back=" and p_id > $pid";
        $this->back = M('picimg')->where($this->com_where.' and p_articlecatid in(16)'.$where_back.$where_new)->join('tp_article on tp_picimg.p_articleid=tp_article.article_id')->order('p_id asc')->find();//(SO)->find();
        
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('style',$style);
        $this->assign('space',$space);
        $this->assign('space_id',$space_id);
        $this->assign('style_id',$style_id);
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