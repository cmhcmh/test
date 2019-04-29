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
         $bsort1 = "sort_order asc,add_time desc limit 0,1";
         $bsort = "sort_order asc,add_time desc limit 0,2";
        $this->banner_list      = M('ads')->where($this->banner_where.' and cat_id=2')->order($bsort)->select();

        if($this->company_info)
        {
             //全国展示banner图在分公司展示

             $this->banner_public_list      = M('ads')->where('1 and is_whole=1 and cat_id=2')->order($bsort1)->select();
        }

        /************************案例*****************************/
        /*
        $case      = M('article')->alias('a')->where($this->com_where.' and cat_id=16 and is_recommend=1')->join('tp_comcat b ON a.style=b.com_id')->order('a.sort_order asc,add_time desc')->select();
        $case = array_chunk($case,4);*/
        $case  = M('comcat')->alias('a')->where('1 and type_filed="style" and is_top=1')->order('a.sort_order asc,com_id desc')->limit(8)->select();
        $case = array_chunk($case,4);

        /************************头条*****************************/
        $this->top      = M('article')->where($this->com_where.' and cat_id=14')->order($this->company_sort)->field('article_id,title,original_img')->select();//读取8个图标

        /************************装修图库*****************************/
        $this->space      = M('comcat')->where('type_filed="space"')->order('sort_order asc,com_id desc')->limit(8)->select();//读取8个图标

        /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();

        /************************vr数据*****************************/
        $this->vr      = M('article')->where('cat_id=18')->order('sort_order asc,add_time desc')->select();//

          /************************报名业主数据*****************************/
        $this->message      = M('message')->where('type=1')->field('id')->select();//
        $m_num = count($this->message);
        $this->message_num = $m_num+2048;
        /************************设计师数据*****************************/
        //全部设计师数据
        $this->designs_all=M('article')->where($this->com_where.' and cat_id=23')->order($this->company_sort)->limit(6)->field('article_id,title,original_img')->select();//
        
        //级别
        $grade = M('comcat')->where("type_filed='grade'")->limit(3)->field('com_id,com_name')->select();
        foreach($grade as $k=>$v){
              
          $designs[]      = M('article')->where($this->com_where.' and cat_id=23 and grade='.$v['com_id'])->limit(6)->field('article_id,title,original_img')->select();//
        }
     

        $this->assign('grade',$grade);
        $this->assign('designs',$designs);

         if($this->company_id==0)
         {
               $where = ' and is_recommend=1';
         }else
         {
             $where =' and '.$this->company_recommend;
         }
         /************************资讯*****************************/
         $this->company_sort_info ='add_time desc,sort_order asc';//重新定义
        $this->information      = M('article')->where($this->com_where.' and cat_id=11 '.$where)->order($this->company_sort_info)->limit(3)->select();//

        /************************家装指南*****************************/
        $this->company_sort_guide ='add_time desc,sort_order asc';//重新定义
        $this->guide      = M('article')->where($this->com_where.' and cat_id=36 '.$where)->order($this->company_sort_guide)->limit(3)->select();//

        /************************装修故事*****************************/
        $this->company_sort_Story ='add_time desc,sort_order asc';//重新定义
        $this->Story      = M('article')->where($this->com_where.' and cat_id=34 '.$where)->order($this->company_sort_Story)->limit(3)->select();//

        /************************品牌视频*****************************/
        $this->video      = M('article')->where('cat_id=13')->find();//
        $this->assign('case',$case);
        $this->assign('arr',$arr);
    
     
        $this->display();
    }
  
  public function search() {
        //导航索引ID
        $this->nid = 1;

        //网站标题 关键字 描述
        $this->site_title       = '搜索 - '.$this->site_info['title'];
        $this->site_keywords    = $this->site_info['keyword'];
        $this->site_description = $this->site_info['description'];




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