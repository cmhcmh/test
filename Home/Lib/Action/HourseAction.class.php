<?php
class HourseAction extends CommonAction {
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
        $province_id = !empty($_REQUEST['province_hourse'])?intval($_REQUEST['province_hourse']):0;
        $city_id = !empty($_REQUEST['city_hourse'])?intval($_REQUEST['city_hourse']):0;
        $district_id = !empty($_REQUEST['district_id'])?intval($_REQUEST['district_id']):0;
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):'';
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:19;
            //上层分类
        $cat_info=M('articlecat')->where('cat_id=2')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=2 and cat_id='.$cat_id)->find();
        if($this->cat_less_info)
        {
            $page_title = $cat_info;
        }else
        {
            $page_title = $this->cat_less_info;
        }



        $this->site_title       = $page_title['cat_name']? $page_title['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $page_title['keywords']? $page_title['keywords']:$this->site_info['keyword'];
        $this->site_description = $page_title['cat_desc']? $page_title['cat_desc']:$this->site_info['cat_desc'];


        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();

         /************************楼盘数据*****************************/
         $where="";
         //搜索
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):'';
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }

         if($province_id)
         {
            $where.=' and province_id='.$province_id;
         }
             if($city_id)
         {
            $where.=' and city_id='.$city_id;
         }
             if($district_id)
         {
            $where.=' and district_id='.$district_id;
         }

        $limit      = $this->limit? $this->limit :6;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->where($this->com_where.' and cat_id=19'.$where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);

        $this->hourse      = M('article')->where($this->com_where.' and cat_id=19'.$where)->join('tp_area on city_id=a_id')->limit($Page->firstRow.','.$Page->listRows)->order($this->company_sort)->select();

        //城市
        if($province_id){
            $this->city_list=$this->citysublist($province_id,2);

        }
        //地区
        if($city_id){
            $this->district_list=$this->citysublist($city_id,3);

        }


      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('province_id',$province_id);
        $this->assign('city_id',$city_id);
        $this->assign('district_id',$district_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
    
        $html="";
        $province_id = !empty($_REQUEST['province_id'])?intval($_REQUEST['province_id']):0;
        $city_id = !empty($_REQUEST['city_id'])?intval($_REQUEST['city_id']):0;
        $district_id = !empty($_REQUEST['district_id'])?intval($_REQUEST['district_id']):0;

        $pages =  intval($_POST['pages']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页
        $where=" and cat_id in(16)";
        if($layout_id) $where.=' and layout='.$layout_id;
        if($acreage_id) $where.=' and acreage='.$acreage_id;
        if($style_id) $where.=' and style='.$style_id;

         $where="";
         //搜索
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }

         if($province_id)
         {
            $where.=' and province_id='.$province_id;
         }
             if($city_id)
         {
            $where.=' and city_id='.$city_id;
         }
             if($district_id)
         {
            $where.=' and district_id='.$district_id;
         }

        $arr    = M('article')->where($this->com_where.' and cat_id=19'.$where)->join('tp_area on city_id=a_id')->limit($pages,5)->select();

         foreach ($arr as $key=>$val){
            $val['href'] = U("Hourse/detail",array("id"=>$val["article_id"]));
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.='   <li class="clearfix clearfixs">
                        <a href="'.$val["href"].'">
                            <div class="lazy fl"><img data-original="/'.$val["original_img"].'" class="lazy_img"></div>
                            <div class="fr hot_t">
                                <h2 class="txt_overflow">'.$val["title"].'（'.$val["area_name"].'）</h2>
                                <p>'.$val["short"].'</p>
                                <div id="mor" class="clearfix"> <span>咨询户数：'.$val["com_number"].'户</span> <span>开工户数：'.$val["start_number"].'户</span>    <a class="ms" href="'.$val["href"].'"> 查看更多</a></div>
                            </div>
                        </a>
                    </li>';
         }
        echo $html;exit;


    }



    public function detail(){
        $id = intval($_GET['id']);
        $article_detail=M('article')->where($this->com_where.' and is_show=1 and article_id='.$id)->join('tp_area on city_id=a_id')->find();//楼盘详情
        //判断内容为空的时候
		if(empty($article_detail)){
			header("Location: /index.php");
		}

         $this->banner=M('ads')->where("cat_id=5 and title='装修案例'")->find();
        //$case=M('article')->where($this->com_where.' and cat_id=16 and be_hourse='.$article_detail['article_id'])->select();//相关的案例
        $case=M('article')->where('1 and cat_id=16 and be_hourse='.$article_detail['article_id'])->select();//相关的案例
        if(!empty($case))
        {
            foreach($case as $k=>$v)
            {
                $desgin=M('article')->where($this->com_where.' and cat_id=23 and article_id='.$v['be_design'])->find();//相关的设计师
                $case[$k]['desgin'] = $desgin;
            }
        }

        //在建工地
       // $startwork=M('article')->where($this->com_where.' and cat_id=20 and be_hourse='.$article_detail['article_id'])->select();//相关的在建工地
        $startwork=M('article')->where('1 and cat_id=20 and be_hourse='.$article_detail['article_id'])->select();//相关的在建工地
        foreach($startwork as $k=>$v)
        {
            if($v['construct_data']){
            $construct_data = unserialize($v['construct_data']);
            $startwork[$k]['construct_end'] = end($construct_data);
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

        //施工
         $work = M('comcat')->where("type_filed='work'")->select();
         $work = $this->setcomcat($work);


        //分类星系
        $cat_id=$article_detail['cat_id'];
            //上层分类
        $cat_info=M('articlecat')->where('cat_id=2')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=2 and cat_id='.$cat_id)->find();
        // var_dump($cat_info);die;
       
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
       
        $this->assign('article_detail',$article_detail);
        $this->assign('case',$case);
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('work',$work);
         $this->assign('cat_info',$cat_info);
        $this->assign('startwork',$startwork);
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