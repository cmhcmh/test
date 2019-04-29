<?php
class IndexAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {

        //导航索引ID
        $this->nid = 1;

        //网站标题 关键字 描述
        $this->site_title       = $this->site_info['title'];
        if($this->company_info)
        {
           // $this->site_title       = $this->company_info['c_name'].' - '.$this->site_info['title'];
            if($this->site_title=="")
            {
                 $this->site_title       = '华浔品味装饰'.$this->company_info['c_name'];
            }
           
        }
        $this->site_keywords    = $this->site_info['keyword'];
        $this->site_description = $this->site_info['description'];
        
        /************************轮播图*****************************/
        $upwhere=" and is_shelves=1";
        $bsort1 = "sort_order asc,add_time desc limit 0,1";
		if($this->company_id==0){
        $bsort = "sort_order asc,add_time desc limit 0,3";
		}else{
        $bsort = "sort_order asc,add_time desc limit 0,2";
		}
        $this->banner_list      = M('ads')->where($this->banner_where.' and cat_id=4'.$upwhere)->order($bsort)->select();
		
        $designtd_list = $this->Designtd_list      = M('ads')->where('1 and cat_id=12')->order('sort_order asc limit 0,7')->select();
       // print_R($this->banner_list);
        
        if($this->company_info)
        {
             //全国展示banner图在分公司展示

             $this->banner_public_list      = M('ads')->where('1 and is_whole=1 and cat_id=4')->order($bsort1)->select();
        }

        /************************底图土建*****************************/
        $this->ditu_list      = M('ads')->where('1 and cat_id=7')->order('ads_id asc')->limit(6)->select();

        /************************ 首页土建*****************************/
        $this->shouye_list      = M('ads')->where('1 and cat_id=8')->order('ads_id asc')->limit(6)->select();

        /************************ pc分公司设计师推荐*****************************/
        $this->banner_sheji      = M('ads')->where('1 and cat_id=10')->order('ads_id asc')->limit(2)->select();

                /************************ 标语*****************************/
        $this->biaoyu_list      = M('ads')->where('1 and cat_id=9')->order('ads_id asc')->select();

        /************************案例*****************************/
        
        $pc_casestyle = M('comcat')->alias('a')->where('1 and type_filed="style" and is_pctop=1')->order('a.sort_order asc,com_id desc')->limit(5)->select();
        $pc_case      = M('article')->alias('a')->where($this->com_where.' and cat_id=16 and '.$this->company_recommend)->join('tp_comcat b ON a.style=b.com_id')->limit(5)->order($this->company_table_sort)->select();
		
		$pc_tcase      = M('article')->alias('a')->where($this->com_where.' and cat_id=16 and is_homelz=1 and '.$this->company_recommend)->join('tp_comcat b ON a.style=b.com_id')->limit(3)->order($this->company_table_sort)->select();
		$pc_tcase2      = M('article')->alias('a')->where($this->com_where.' and cat_id=16 and is_homelf=1 and '.$this->company_recommend)->join('tp_comcat b ON a.style=b.com_id')->limit(3)->order($this->company_table_sort)->select();
		//设计师读取
		$design_list = $this->changdata(23);
		//面积
		$acreage =M('comcat')->where("type_filed='acreage'")->select();
        $acreage = $this->setcomcat($acreage);
        //$case = array_chunk($case,4);
        $case  = M('comcat')->alias('a')->where('1 and type_filed="style" and is_top=1')->order('a.sort_order asc,com_id desc')->limit(8)->select();
        $case = array_chunk($case,4);

        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();
        //统计公司省份的总数
        $provincelist_new = $this->provincelist;
        foreach($provincelist_new as $k=>$v){
             $num = M('company')->where('c_province='.$v['a_id'])->Count();
             if(!$num) $num= 0;
             $p_company[$v['a_id']]['num'] =  $num;
             $p_company[$v['a_id']]['area_name'] = $v['area_name'];
        }
  
         $this->assign('p_company',$p_company);

        /************************vr数据*****************************/
         $this->vr          = M('article')->where('cat_id=18 and is_big=0')->order('sort_order asc,add_time desc')->limit(3)->select();//
        $this->vr_big      = M('article')->where('cat_id=18 and is_big=1')->order('sort_order asc,add_time desc')->find();//

        /*********已经放到了公共类里面***************报名业主数据***************************
        $this->message = M('message')->where('type=1')->count();
       
        $this->message_num = $this->message+2048;
		
		**/
		
        /************************设计师数据*****************************/
        //全部设计师数据
        $this->designs_all=M('article')->alias('a')->join('tp_company b ON a.company_id=b.c_id')->where($this->com_where.' and cat_id=23 and '.$this->company_recommend)->limit(12)->order($this->company_sort)->select();// 分公司数据
        //级别
        $grade = M('comcat')->where("type_filed='grade'")->limit(1)->select();
         //级别
        $grade_arr = M('comcat')->where("type_filed='grade'")->select();
        $grade_arr = $this->setcomcat($grade_arr);



        foreach($grade as $k=>$v){
        //右边栏目
          $design_left[$v['com_id']]      = M('article')->alias('a')->join('tp_company b ON a.company_id=b.c_id')->where($this->com_where.' and cat_id=23 and grade='.$v['com_id'].' and is_left=1')->limit(2)->select();//
        }
        //工作年龄      
        $obtain =M('comcat')->where("type_filed='obtain'")->select();
        $obtain = $this->setcomcat($obtain);
        //右栏目
        $design_right = M('article')->alias('a')->join('tp_company b ON a.company_id=b.c_id')->where($this->com_where.' and cat_id=23  and is_right=1')->limit(2)->select();
        //首页推荐
        $designs = M('article')->alias('a')->join('tp_company b ON a.company_id=b.c_id')->where($this->com_where.' and cat_id=23  and '.$this->company_recommend)->order($this->company_sort)->limit(4)->select();
        //选中风格
        $this->special_style_data =D('Design')->list_special_style_data($designs);
		$tdnum = 7;
        $this->assign('pc_casestyle',$pc_casestyle);
        $this->assign('tdnum',$tdnum);
        $this->assign('grade',$grade);
         $this->assign('grade_arr',$grade_arr);
        $this->assign('obtain',$obtain);
        $this->assign('designs',$designs);
        $this->assign('design_left',$design_left);
        $this->assign('design_right',$design_right);
        $this->assign('designtd_list',$designtd_list);
		$this->assign('acreage',$acreage);
		$this->assign('design_list',$design_list);

         if($this->company_id==0)
         {
               $where = ' and is_recommend=1';
         }else
         {
         	   $where ='';
         }
        /************************营销活动*****************************/
        if($this->company_id)
        {
           $cat_id=26;
        }else
        {
           $cat_id=25;
        }
         $where_a =' and cat_id='.$cat_id;
             //重新定义where条件
        if($this->company_id==0)
        {
            $this->where_a='1  and is_show=1'; //文章条件
            $where_a =' and cat_id in(25,26)';
        }
         $this->company_sort_activi ='add_time desc,sort_order asc';//重新定义
         $this->activilist        = M('article')->alias('a')->join('tp_company b ON b.c_id= a.company_id and is_big=1')->where($this->com_where.$where_a.' and '.$this->company_recommend)->order($this->company_sort_activi)->limit(4)->select();//大图
         $this->activilist_x      = M('article')->alias('a')->join('tp_company b ON b.c_id= a.company_id and is_recommend=1')->where($this->com_where.$where_a.' and '.$this->company_recommend)->order($this->company_sort_activi)->limit(3)->select();//小图

         /************************资讯*****************************/
       // $this->information      = M('article')->where($this->com_where.' and cat_id=11'.$where)->order('sort_order asc,add_time desc')->limit(5)->select();//
       // $this->information_one      = M('article')->where($this->com_where.' and cat_id=11 and is_big=1')->order('sort_order asc,add_time desc')->find();//
         $this->company_sort_info ='add_time desc,sort_order asc';//重新定义
         $this->information      = M('article')->where($this->com_where.' and cat_id=11'.$where)->order($this->company_sort_info)->limit(4)->select();//
         $this->informationpic      = M('article')->where($this->com_where.' and cat_id=11'.$where)->order($this->company_sort_info)->limit(1)->select();//
         //var_dump($this->information);
         $this->information_one      = M('article')->where($this->com_where.' and cat_id=11 and is_big=1')->order($this->company_sort_info)->find();//


        /************************家装指南*****************************/
       // $this->guide      = M('article')->where($this->com_where.' and cat_id=36'.$where)->order('sort_order asc,add_time desc')->limit(5)->select();//
        //$this->guide_one      = M('article')->where($this->com_where.' and cat_id=36 and is_big=1')->order('sort_order asc,add_time desc')->find();//
        $this->company_sort_guide ='add_time desc,sort_order asc';//重新定义
        $this->guide      = M('article')->where($this->com_where.' and cat_id=36'.$where)->order($this->company_sort_guide)->limit(4)->select();//
        $this->guidepic      = M('article')->where($this->com_where.' and cat_id=36'.$where)->order($this->company_sort_guide)->limit(1)->select();//
        $this->guide_one      = M('article')->where($this->com_where.' and cat_id=36 and is_big=1')->order($this->company_sort_guide)->find();//

        /************************装修故事*****************************/
       // $this->Story      = M('article')->where($this->com_where.' and cat_id=34'.$where)->order('sort_order asc,add_time desc')->limit(5)->select();//
        //$this->Story_one    = M('article')->where($this->com_where.' and cat_id=34 and is_big=1')->order('sort_order asc,add_time desc')->find();//
         $this->company_sort_Story ='add_time desc,sort_order asc';//重新定义
         $this->Story      = M('article')->where($this->com_where.' and cat_id=34'.$where)->order($this->company_sort_Story)->limit(4)->select();//
        $this->Story_one    = M('article')->where($this->com_where.' and cat_id=34 and is_big=1')->order($this->company_sort_Story)->find();//

        /************************品牌视频*****************************/
        $this->video      = M('article')->where('cat_id=13')->select();//

        /************************分公司楼盘*****************************/
        if($this->company_id>0){
                $company_info = $this->getcompanyinfo($this->company_id);
                $hourse_arr = M('article')->join('tp_area on district_id=a_id')->where($this->com_where.' and cat_id=19 and province_id='.$company_info['c_province'])->order($this->company_sort)->select();//

                foreach($hourse_arr as $key=>$val)
                {
                    $area_ids[$val['district_id']] =$val['district_id'];
                    $hourse_arr_new[$val['district_id']][] = $val;
                }
                if($area_ids){
                    $area_ids = implode(',', $area_ids);
                $this->area_arr      = M('area')->where('a_id in ('.$area_ids.')')->select();//
                }

        }



        $this->assign('hourse_arr',$hourse_arr);
        
        $this->assign('hourse_arr_new',$hourse_arr_new);
        $this->assign('case',$case);
        $this->assign('pc_case',$pc_case);
        $this->assign('pc_tcase',$pc_tcase);
        $this->assign('pc_tcase2',$pc_tcase2);
        $this->assign('arr',$arr);


        $this->display();
    }
	
	public function search() {
             $this->nid = 1;
          $keywords=!empty($_REQUEST['keywords'])?addslashes(htmlspecialchars($_REQUEST['keywords'])):'';
        if($keywords)
        {

          //  $keywords = urldecode($keywords);
           // $keywords = iconv('GBK',"UTF-8",$keywords);

        }

        //网站标题 关键字 描述
        $this->site_title       = '搜索 - '.$this->site_info['title'];
        $this->site_keywords    = $this->site_info['keyword'];
        $this->site_description = $this->site_info['description'];


         $this->assign('keywords',$keywords);
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