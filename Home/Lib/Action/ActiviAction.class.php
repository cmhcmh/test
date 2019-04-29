<?php
class ActiviAction extends CommonAction {
    public function __construct() {
        parent::__construct();

    }

    public function index() {
        //导航索引ID
        $this->nid = 3;

      
       
        //所有分类
        //$this->all_cat=M('articlecat')->where('parent_id=3')->order('sort_order asc,cat_id asc')->select();
        /************************轮播图*****************************/
       // $this->banner=M('ads')->where("cat_id=3 and title='新闻'")->getField('original_img');
        //分类星系
         $this->banner=M('ads')->where("cat_id=5 and title='营销活动'")->find();
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;

         if(!empty($_REQUEST['cat_id']))
         {
            $cat_id = intval($_REQUEST['cat_id']);
         }
       // $where =' and cat_id='.$cat_id;
        //上层分类
        $cat_info=M('articlecat')->where('cat_id=4')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=4 and cat_id='.$cat_id)->find();
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
        //重新定义where条件
        if($this->company_id==0)
        {
            $this->com_where='1  and is_show=1'; //文章条件
            if(!empty($_REQUEST['cat_id']))
            { 
             $where =' and cat_id in('.$cat_id.')';
           }else
           {
           
            $where =' and cat_id in(25,26)';
           }
        }else
        {
            $where =' and cat_id in(26)';
            $cat_id =26;
        }

        $limit      = $this->limit? $this->limit :8;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->alias('a')->join('tp_company b ON b.c_id= a.company_id')->where($this->com_where.$where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);
         //$order = 'sort_order asc,add_time desc';
         $this->company_sort_activi ='add_time desc,sort_order asc';//重新定义
        $this->activilist      = M('article')->alias('a')->join('tp_company b ON b.c_id= a.company_id')->where($this->com_where.$where)->order($this->company_sort_activi)->limit($Page->firstRow.','.$Page->listRows)->select();//

      
          //网站标题 关键字 描述
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('cat_id',$cat_id);
        $this->display();
    }
    //加载案例数据
    public function load(){
    
        $html="";
        if($this->company_id)
        {
           $cat_id=26;
        }else
        {
           $cat_id=25;
        }
        $where =' and cat_id='.$cat_id;
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


       if($this->company_id==0)
        {
            $this->com_where='1  and is_show=1'; //文章条件
              $where =' and cat_id in(25,26)';
        }
         $arr= M('article')->alias('a')->join('tp_company b ON b.c_id= a.company_id')->where($this->com_where.$where)->limit($pages,8)->select();//


         foreach ($arr as $key=>$val){
            $val['href'] = U("Activi/detail",array("id"=>$val["article_id"]));
            if($val['cat_id']==25)
            {
                $str='【全国】';

            }else{
                 $str='【'.$val['c_name'].'】';

            }
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.=' <div class="item clearfixs">
                    <a href="'.$val['href'].'">
                        <div class="pic lazy">
                            <img data-original="/'.$val["original_img"].'" class="lazy_img">
                            <em></em>
                        </div>
                    </a>
                    <h2>'.$str.''.$val["title"].'</h2>
                </div>';
         }
        echo $html;exit;


    }



    public function detail(){
        $id = intval($_GET['id']);
         $this->banner=M('ads')->where("cat_id=5 and title='营销活动'")->find();
        $article_detail=M('article')->where($this->com_where.' and article_id='.$id)->find();//案例详情

		//判断内容为空的时候
	if(empty($article_detail)){
		header("Location: /index.php");
	}
		
        //分类星系
        $cat_id=$article_detail['cat_id'];
        // var_dump($cat_info);die;
           //上层分类
        $this->cat_info=M('articlecat')->where('cat_id=4')->find();
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=4 and cat_id='.$cat_id)->find();
		$company_id=$article_detail['company_id'];
        $this->company_name=M('company')->where('c_id='.$company_id)->find();
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
      
        $this->assign('article_detail',$article_detail);
        $this->assign('style',$style);
        $this->assign('layout',$layout);
        $this->assign('acreage',$acreage);
        $this->assign('space',$space);
        $this->assign('grade',$grade);
        $this->assign('cat_id',$cat_id);
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