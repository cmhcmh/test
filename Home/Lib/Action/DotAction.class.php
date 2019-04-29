<?php
class DotAction extends CommonAction {
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
          $this->banner=M('ads')->where("cat_id=5 and title='服务门店'")->find();
        $province_id = !empty($_REQUEST['province_dot'])?intval($_REQUEST['province_dot']):0;
        $city_id = !empty($_REQUEST['city_dot'])?intval($_REQUEST['city_dot']):0;
        $c_id = !empty($_REQUEST['c_id'])?intval($_REQUEST['c_id']):0;
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):'';
        $cat_info['cat_name']="全国网店";

        $this->site_title       = $cat_info['cat_name']? $cat_info['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $cat_info['keywords']? $cat_info['keywords']:$this->site_info['keyword'];
        $this->site_description = $cat_info['cat_desc']? $cat_info['cat_desc']:$this->site_info['cat_desc'];


        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();

         /************************分公司数据*****************************/
         $where="1";
         if($province_id)
         {
            $where.=' and c_province='.$province_id;
         }
             if($city_id)
         {
            $where.=' and c_city='.$city_id;
         }
             if($keywords)
         {
            $where.=" and c_name like '%$keywords%'";
         }

           $limit      = $this->limit? $this->limit :10;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('company')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);

        $this->dotlist      = M('company')->where($where)->limit($Page->firstRow.','.$Page->listRows)->order('c_sort asc,c_id desc')->select();

        //城市
        if($province_id){
            $this->city_list=$this->citysublist($province_id,2);

        }
        //公司
        if($city_id){
            $this->company_list=$this->getcompany($city_id);

        }


      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('province_id',$province_id);
        $this->assign('city_id',$city_id);
        $this->assign('c_id',$c_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
        $html="";
        $province_id = !empty($_REQUEST['province_id'])?intval($_REQUEST['province_id']):0;
        $city_id = !empty($_REQUEST['city_id'])?intval($_REQUEST['city_id']):0;
        $c_id = !empty($_REQUEST['c_id'])?intval($_REQUEST['c_id']):0;

        $pages =  intval($_POST['pages']);
        $pages=$pages?$pages:0;
        $limit      = $this->limit? $this->limit :6;
        //数据分页
        $where=" and cat_id in(16)";
        if($layout_id) $where.=' and layout='.$layout_id;
        if($acreage_id) $where.=' and acreage='.$acreage_id;
        if($style_id) $where.=' and style='.$style_id;

         $where="1";
         //搜索
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        if($keywords){
        //数据分页
            $where.=" and (title like '%$keywords%' or content like '%$keywords%')";
        }

            $where="1";
         if($province_id)
         {
            $where.=' and c_province='.$province_id;
         }
             if($city_id)
         {
            $where.=' and c_city='.$city_id;
         }
             if($c_id)
         {
            $where.=' and c_id='.$c_id;
         }

         $arr    = M('company')->where($where)->limit($pages,5)->select();

         foreach ($arr as $key=>$val){
            $val['href'] = U("Index/index",array("company_id"=>$val["c_id"]));
            if($val['c_domain']!='')
            {
                $href='<a href="http://'.$list["c_domain"].'.'.$host_domain.'">立即进入1</a>';
            }
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.='   <li class="clearfixs">
                        <h2>'.$val["c_name"].'</h2>
                        <p>电话：'.$val["c_mobile"].'</p>
                        <p>传真：'.$val["c_fx"].'</p>
                        <p>地 址：'.$val["c_address"].'</p>
                        '.$href.'
                    </li>';
         }
        echo $html;exit;


    }



    public function detail(){
        $id = intval($_GET['id']);
        $article_detail=M('article')->where($this->com_where.' and article_id='.$id)->join('tp_area on city_id=a_id')->find();//楼盘详情
		//判断内容为空的时候
		if(empty($article_detail)){
			header("Location: /index.php");
		}
		
        $case=M('article')->where($this->com_where.' and cat_id=16 and be_hourse='.$article_detail['article_id'])->select();//相关的案例
        if(!empty($case))
        {
            foreach($case as $k=>$v)
            {
                $desgin=M('article')->where($this->com_where.' and cat_id=23 and article_id='.$v['be_design'])->find();//相关的设计师
                $case[$k]['desgin'] = $desgin;
            }
        }

        //在建工地
        $startwork=M('article')->where($this->com_where.' and cat_id=20 and be_hourse='.$article_detail['article_id'])->select();//相关的在建工地
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
        $this->cat_info=M('articlecat')->where('cat_id=3')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=3 and cat_id='.$cat_id)->find();
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