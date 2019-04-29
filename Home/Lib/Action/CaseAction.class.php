<?php
class CaseAction extends CommonAction {
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
        $layout_id = !empty($_REQUEST['layout_id'])?intval($_REQUEST['layout_id']):0;
        $acreage_id = !empty($_REQUEST['acreage_id'])?intval($_REQUEST['acreage_id']):0;
        $style_id = !empty($_REQUEST['style_id'])?intval($_REQUEST['style_id']):0;
        $keywords=!empty($_REQUEST['keywords'])?addslashes(htmlspecialchars($_REQUEST['keywords'])):0;
        $is_hn = !empty($_REQUEST['is_hn'])?intval($_REQUEST['is_hn']):1;
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:16;
        //上层分类
        $cat_info=M('articlecat')->where('cat_id=2')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=2 and cat_id='.$cat_id)->find();
        if(!$this->cat_less_info)
        {
             $page_title = $this->cat_less_info;
        }else
        {
           $page_title = $cat_info;
        }



        $this->site_title       = $page_title['cat_name']? $page_title['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $page_title['keywords']? $page_title['keywords']:$this->site_info['keyword'];
        $this->site_description = $page_title['cat_desc']? $page_title['cat_desc']:$this->site_info['cat_desc'];


        //风格
         $style = M('comcat')->where("type_filed='style'")->select();
         $style = $this->setcomcat($style);

        //户型
        $layout = M('comcat')->where("type_filed='layout'")->select();
        $layout = $this->setcomcat($layout);
        //面积
        $acreage =M('comcat')->where("type_filed='acreage'")->select();
        $acreage = $this->setcomcat($acreage);

          /************************案例*****************************/
          $where='';
        if($layout_id) $where.=' and a.layout='.$layout_id;
        if($acreage_id) $where.=' and a.acreage='.$acreage_id;
        if($style_id) $where.=' and a.style='.$style_id;

        if($keywords){
             $comcat_arr = M('comcat')->where("com_name like '%$keywords%'")->field('com_id')->find();
             $comcat_ids = implode(',',$comcat_arr);


            if(!empty($comcat_ids))
            {
                 $where.=" and (a.title like '%$keywords%' or a.content like '%$keywords%' or a.style in($comcat_ids))";
            }else
            {

                 $where.=" and (a.title like '%$keywords%' or a.content like '%$keywords%')";
            }
        }

       //读取楼盘
      // $this->hourse_list = $this->changdata(19);
        //读取设计师
       // $this->design_list = $this->changdata(23);

         $limit      = $this->limit? $this->limit :32;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->where($this->com_where.' and cat_id=16'.$where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $count2      = M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id=16'.$where)->count();// 查询满足要求的总记录数 $map表示查询条件
		if($this->company_id == 0){
			$Page       = new Page($count2,$limit);// 实例化分页类 传入总记录数
		}else{
			$Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
		}
        //print_R()
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);
        $order = 'a.sort_order asc,a.add_time desc';


       if($is_hn==1) {
            //$order='counts desc,add_time desc';
           // $order=$this->company_sort;
                $order = 'a.sort_order asc,a.counts desc';
         }
        else{
             $order='a.add_time desc';
        }

        $this->case      = M('article')->alias('a')->field('a.*,b.article_id as design_id,b.original_img as design_img,b.title as design_title')->where($this->com_table_where.' and a.cat_id=16'.$where)->join('tp_article  as  b  on b.article_id = a.be_design')->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();//

		$this->case2     = M('article')->alias('a')->field('a.*,b.article_id as design_id,b.original_img as design_img,b.title as design_title')->where($this->com_table_where.' and (a.is_jt=1 or a.company_id=0) and a.cat_id=16 '.$where)->join('tp_article  as  b  on b.article_id = a.be_design')->order($order)->limit($Page->firstRow.','.$Page->listRows)->select();//
		
      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('layout_id',$layout_id);
             $this->assign('is_hn',$is_hn);
        $this->assign('acreage_id',$acreage_id);
        $this->assign('style_id',$style_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
    
        $html="";
        $layout_id = !empty($_REQUEST['layout_id'])?intval($_REQUEST['layout_id']):0;
        $acreage_id = !empty($_REQUEST['acreage_id'])?intval($_REQUEST['acreage_id']):0;
        $style_id = !empty($_REQUEST['style_id'])?intval($_REQUEST['style_id']):0;

        $pages =  intval($_POST['pages']);
        $keywords =  intval($_POST['keywords']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页
        $where=" and cat_id in(16)";
        if($layout_id) $where.=' and layout='.$layout_id;
        if($acreage_id) $where.=' and acreage='.$acreage_id;
        if($style_id) $where.=' and style='.$style_id;

         //搜索
        $keywords=!empty($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        if($keywords){
        //数据分页
            $comcat_arr = M('comcat')->where("com_name like '%$keywords%'")->field('com_id')->find();
             $comcat_ids = implode(',',$comcat_arr);

            if(!empty($comcat_ids))
            {
                 $where.=" and (title like '%$keywords%' or content like '%$keywords%' or style in($comcat_ids))";
            }else
            {

                 $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
            }
        }

           //风格
         $style = M('comcat')->where("type_filed='style'")->select();
         $style = $this->setcomcat($style);

        //户型
        $layout = M('comcat')->where("type_filed='layout'")->select();
        $layout = $this->setcomcat($layout);
        //面积
        $acreage =M('comcat')->where("type_filed='acreage'")->select();
        $acreage = $this->setcomcat($acreage);

         //读取楼盘
       $hourse_list = $this->changdata(19);
        //读取设计师
        $design_list = $this->changdata(23);

        $arr = M('article')->where($this->com_where.$where)->order('sort_order asc,add_time desc')->limit($pages,6)->select();

         foreach ($arr as $key=>$val){
            $val['href'] = U("Case/detail",array("id"=>$val["article_id"]));
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.='<div class="item clearfixs">
                    <a href="'.$val["href"].'"><div class="pic pr lazy">
                        <div class="lazy"><img data-original="/'.$val["original_img"].'" class="lazy_img"></div>
                        <!-- <span class="picNum pa"><i></i><span class="num vm">10</span></span> -->
                    </div></a>
                    <div class="info pr">
                        <p class="name">'.$val["title"].'</p>
                        <p class="tag"><a href="">'.$layout[$val["layout"]]["com_name"].'</a><font>|</font><a href="">'.$style[$val["style"]]["com_name"].'</a><font>|</font><a href="">'.$acreage[$val["acreage"]]["com_name"].'</a> </p>
                        <p class="tag"><a href="">设计师：'.$design_list[$val["be_design"]]["title"].'</a>&nbsp;<a href="">楼盘：'.$hourse_list[$val["be_hourse"]]["title"].'</a></p>
                        <!-- <p class="like liked pa"><i></i><span class="num vm">2</span></p> -->
                    </div>
                </div>';
         }
        echo $html;exit;


    }



    public function detail(){
        $id = intval($_GET['id']);
        $this->com_where='1  and is_show=1'; //文章条件
        $article_detail=M('article')->alias('a')->join('tp_company b ON b.c_id= a.company_id')->where($this->com_where.' and article_id='.$id)->find();//案例详情
        //判断内容为空的时候
		if(empty($article_detail)){
			header("Location: /index.php");
		}
        M('article')->where('article_id='.$id)->setInc('counts');

        $this->banner=M('ads')->where("cat_id=5 and title='装修案例'")->find();
         
        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();


        //楼盘
       $this->hourse_info = M('article')->where("article_id=".$article_detail['be_hourse'])->find();

        //城市
        $this->city=M('area')->where("a_id=".$article_detail['c_city'])->find();

        //风格
        $style = M('comcat')->where("type_filed='style'")->select();
        $style = $this->setcomcat($style);

        //户型
        $layout = M('comcat')->where("type_filed='layout'")->select();
        $layout = $this->setcomcat($layout);
        //面积
        $acreage =M('comcat')->where("type_filed='acreage'")->select();
        $acreage = $this->setcomcat($acreage);
        //级别
        $grade =M('comcat')->where("type_filed='grade'")->select();


        //空间
        $space =M('comcat')->where("type_filed='space'")->order('sort_order asc,com_id desc')->select();
        $space = $this->setcomcat($space);
          $grade = $this->setcomcat($grade);

        //设计师
        $this->design=M('article')->where('1 and article_id='.$article_detail['be_design'])->find();//案例详情
         $type = 2;
       $this->design_name = $this->design['title'];

        //案例
        $this->case=M('article')->where($this->com_where.' and cat_id=16 and be_design='.$this->design['article_id'])->limit(6)->select();//相关案列
        // print_r($this->banner);
        //空间图片
        //$this->picimg = M('picimg')->where('p_articleid='.$article_detail['article_id'])->order('p_sort asc')->limit(100)->select();
        $pace_img = array();
      foreach($space as $key=>$val)
      {
        $pace_img[$val['com_id']]['data']=M('picimg')->where('p_articleid='.$article_detail['article_id'].' and p_comid='.$val['com_id'])->order('p_sort asc')->select();
        $pace_img[$val['com_id']]['space']=$val['com_name'];
      }
 



        //分类星系
        $cat_id=$article_detail['cat_id'];
              //上层分类
        $this->cat_info=M('articlecat')->where('cat_id=2')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=2 and cat_id=16')->find();
       
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
       
	   
	   
        $this->assign('article_detail',$article_detail);
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('space',$space);
        $this->assign('grade',$grade);
         $this->assign('pace_img',$pace_img);
         $this->assign('type',$type);
        $this->assign('id',$article_detail['article_id']);
    


      $this->display();  
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

        $arr = M('picimg')->where('p_articleid='.$id)->order('p_comid desc')->limit($pages,100)->select();

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

       public function changdata($cat_id)
    {

         $data = M('article')->where('cat_id='.$cat_id)->select();
         foreach($data as $k=>$v)
         {
                $data_new[$v['article_id']] =$v;
         }
         return $data_new;
    }



}
?>