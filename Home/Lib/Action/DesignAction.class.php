<?php
class DesignAction extends CommonAction {
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
         $this->banner=M('ads')->where("cat_id=5 and title='服务团队'")->find();
        $special_style_id = !empty($_REQUEST['special_style_id'])?intval($_REQUEST['special_style_id']):0;
        $grade_id = !empty($_REQUEST['grade_id'])?intval($_REQUEST['grade_id']):0;
          $obtain_id = !empty($_REQUEST['obtain_id'])?intval($_REQUEST['obtain_id']):0;
        $keywords=!empty($_REQUEST['keywords'])?addslashes(htmlspecialchars($_REQUEST['keywords'])):0;
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:23;
         $province_id = !empty($_REQUEST['province_design'])?intval($_REQUEST['province_design']):0;
        $city_id = !empty($_REQUEST['city_design'])?intval($_REQUEST['city_design']):0;
        $c_id = !empty($_REQUEST['company_design'])?intval($_REQUEST['company_design']):0;
         //上层分类
        $cat_info=M('articlecat')->where('cat_id=3')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=3 and cat_id='.$cat_id)->find();

		 if(!$this->cat_less_info)
        {
             $page_title = $this->cat_less_info;
        }else
        {
           $page_title = $cat_info;
        }
		
        $this->site_title       = $cat_info['cat_name']? $cat_info['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $cat_info['keywords']? $cat_info['keywords']:$this->site_info['keyword'];
        $this->site_description = $cat_info['cat_desc']? $cat_info['cat_desc']:$this->site_info['cat_desc'];


        //擅长风格风格
         $special_style = M('comcat')->where("type_filed='special_style'")->select();
         $special_style = $this->setcomcat($special_style);

        //级别
        $grade = M('comcat')->where("type_filed='grade'")->select();
        $grade = $this->setcomcat($grade);

        //工作经验
        $obtain = M('comcat')->where("type_filed='obtain'")->select();
        $obtain = $this->setcomcat($obtain);

           //风格
         $style = M('comcat')->where("type_filed='style'")->select();
         $style = $this->setcomcat($style);

        //户型
        $layout = M('comcat')->where("type_filed='layout'")->select();
        $layout = $this->setcomcat($layout);
        //面积
        $acreage =M('comcat')->where("type_filed='acreage'")->select();
        $acreage = $this->setcomcat($acreage);


          /************************设计师*****************************/
          $where='';
        if($special_style_id) $where.=" and special_style like '%$special_style_id%'";
        if($grade_id) $where.=' and grade='.$grade_id;
        if($obtain_id) $where.=' and obtain='.$obtain_id;
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }


        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();

         /************************分公司数据*****************************/
         if($province_id)
         {
            $where.=' and admin_province_id='.$province_id;
         }
             if($city_id)
         {
            $where.=' and admin_city_id='.$city_id;
         }
             if($c_id)
         {
            $where.=' and company_id='.$c_id;
         }

        //城市
        if($province_id){
            $this->city_list=$this->citysublist($province_id,2);

        }
        //公司
        if($city_id){
            $this->company_list=$this->getcompany($city_id);

        }

        //$this->company_id等于0重新定义where条件
        if($this->company_id==0)
        {
             $this->com_where='1 and is_show=1'; //文章条件
        }

        $limit      = $this->limit? $this->limit :32;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->where($this->com_where.' and cat_id=23'.$where)->join('tp_company on company_id=c_id')->count();// 查询满足要求的总记录数 $map表示查询条件
        $count2      = M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id=23'.$where)->join('tp_company on company_id=c_id')->count();// 查询满足要求的总记录数 $map表示查询条件
		if($this->company_id == 0){
			$Page       = new Page($count2,$limit);// 实例化分页类 传入总记录数
		}else{
			$Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
		}
		
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);

        $this->design      = M('article')->where($this->com_where.' and cat_id=23'.$where)->join('tp_company on company_id=c_id')->order($this->company_sort)->limit($Page->firstRow.','.$Page->listRows)->select();
		
        $this->design2      = M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id=23'.$where)->join('tp_company on company_id=c_id')->order($this->company_sort)->limit($Page->firstRow.','.$Page->listRows)->select();
         $this->special_style_data =D('Design')->list_special_style_data($this->design);
		 
         $design = $this->design;
         foreach($design as  $k=>$v)
         {
            $design[$k]['case_detail'] = M('article')->where('cat_id=16 and be_design='.$v['article_id'])->find();
         }
      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('special_style',$special_style);
        $this->assign('grade',$grade);
        $this->assign('obtain',$obtain);
         $this->assign('design',$design);
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('special_style_id',$special_style_id);
        $this->assign('grade_id',$grade_id);
        $this->assign('obtain_id',$obtain_id);
        $this->assign('province_id',$province_id);
        $this->assign('city_id',$city_id);
        $this->assign('c_id',$c_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
    
        $html="";
        $special_style_id = !empty($_REQUEST['special_style_id'])?intval($_REQUEST['special_style_id']):0;
        $grade_id = !empty($_REQUEST['grade_id'])?intval($_REQUEST['grade_id']):0;

        $pages =  intval($_POST['pages']);
        $keywords =  intval($_POST['keywords']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页
               /************************设计师*****************************/
        $where='';
        if($special_style_id) $where.=' and special_style='.$special_style_id;
        if($grade_id) $where.=' and grade='.$grade_id;
        

         //搜索
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }

           //擅长风格风格
         $special_style = M('comcat')->where("type_filed='special_style'")->select();
         $special_style = $this->setcomcat($special_style);

        //级别
        $grade = M('comcat')->where("type_filed='grade'")->select();
        $grade = $this->setcomcat($grade);

           //工作经验
        $obtain = M('comcat')->where("type_filed='obtain'")->select();
        $obtain = $this->setcomcat($obtain);
   //$this->company_id等于0重新定义where条件
        if($this->company_id==0)
        {
             $this->com_where='1 and is_show=1'; //文章条件
        }

        $arr    = M('article')->where($this->com_where.' and cat_id=23'.$where)->join('tp_company on company_id=c_id')->order('sort_order asc,add_time desc')->limit($pages,8)->select();//
        $special_style_data =D('Design')->list_special_style_data($arr);
        $company_html="";
         foreach ($arr as $key=>$val){
            $val['href'] = U("Design/detail",array("id"=>$val["article_id"]));
            foreach($special_style_data[$val['article_id']] as $k=>$v)
            {
                $special_style_html.=$v['com_name'].'&nbsp;';
            }
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            if($val['c_name']) $company_html='<p>所属公司：'.$val['c_name'].'</p>';
            $html.='   <li class="clearfix clearfixs">
                    <div class="lazy fl"><a href="'.$val["href"].'"><img data-original="/'.$val["original_img"].'" class="lazy_img"></a></div>
                    <div class="fl des_t">
                    <a href="'.$val["href"].'">
                        <h2><font>'.$val["title"].'</font><span>'.$grade[$val['grade']]["com_name"].'</span></h2>
                        '.$company_html.'
                        <p>擅长：'.$special_style_html.'</p>
                        <p class="flsub">'.$obtain[$val['obtain']]["com_name"].'<font>|</font>'.$val["short"].'</p>
                    </a>
                    </div>
                </li>';
            $special_style_html="";//重新定义
         }
        echo $html;exit;


    }



    public function detail(){
        $id   = intval($_GET['id']);
        $type = 2;
         $this->com_where='1  and is_show=1'; //文章条件
        $article_detail=M('article')->where('1 and is_show=1 and article_id='.$id)->join('tp_company on company_id=c_id')->find();//设计师详情
        //判断内容为空的时候
			if(empty($article_detail)){
				header("Location: /index.php");
			}
        $this->design_name = $article_detail['title'];

         //擅长风格风格
         $special_style = M('comcat')->where("type_filed='special_style'")->select();
         $special_style = $this->setcomcat($special_style);
         //获取设计师的风格
         $this->one_special_style_data = D('Design')->one_special_style_data($article_detail);

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
        $grade = M('comcat')->where("type_filed='grade'")->select();
        $grade = $this->setcomcat($grade);

           //工作经验
        $obtain = M('comcat')->where("type_filed='obtain'")->select();
        $obtain = $this->setcomcat($obtain);

        $limit      = $this->limit? $this->limit :6;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->where($this->com_where.' and cat_id=16 and be_design='.$article_detail['article_id'])->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);

        //案例
        $this->case=M('article')->where($this->com_where.' and cat_id=16 and be_design='.$article_detail['article_id'])->order('f_sort_order asc,add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();//案例详情


        //分类星系
        $cat_id=$article_detail['cat_id'];
        $this->cat_info=M('articlecat')->where('cat_id=23')->find();

        // var_dump($cat_info);die;
       
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('article_detail',$article_detail);
        $this->assign('special_style',$special_style);
        $this->assign('count',$count);
        $this->assign('grade',$grade);
        $this->assign('obtain',$obtain);
        $this->assign('id',$article_detail['article_id']);
        $this->assign('type',$type);
    


      $this->display();  
    }

   //加载案例数据
    public function loadcase(){
    
        $html="";
        $id = !empty($_REQUEST['id'])?intval($_REQUEST['id']):0;

        $pages =  intval($_POST['pages']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页

        $arr    = M('article')->where($this->com_where.' and cat_id=16 and be_design='.$id)->limit($pages,4)->select();//

        $company_html="";
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
         foreach ($arr as $key=>$val){
            $val['href'] = U("Case/detail",array("id"=>$val["article_id"]));
        
            $html.='<div class="item clearfixs">
                    <a href="'.$val["href"].'"><div class="pic lazy">
                        <img data-original="/'.$val["original_img"].'" class="lazy_img">
                    </div></a>
                    <div class="sj2_t">
                        <h2>'.$val["title"].'</h2>
                        <p>
                           '.$val["short"].'
                        </p>
                        <div class="clearfix"><!--<span class="fl">已有299人浏览</span>--><a class="fr" href="'.$val["href"].'">查看详情></a></div>
                    </div>
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



}
?>