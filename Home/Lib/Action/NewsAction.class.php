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

        $this->banner=M('ads')->where("cat_id=5 and title='品牌实力'")->find();
        //分类星系
        $keywords=isset($_POST['keywords'])?addslashes(htmlspecialchars($_POST['keywords'])):0;
        $cat_id = intval($_GET['cat_id']);
        $cat_id=$cat_id?$cat_id:35;
     //上层分类
        $flg = 0;
        $cat_info=M('articlecat')->where('cat_id=1')->find();
        $new_cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();
        if($cat_id==36)
        {
           $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find(); 
            $this->banner=M('ads')->where("cat_id=5 and title='装修指南'")->find();
            $flg = 1;
        }
           if($cat_id==34)
        {
           $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find(); 
            $this->banner=M('ads')->where("cat_id=5 and title='服务保障'")->find();
            $flg = 1;
        }
        if($cat_id==11)
        {
            $flg = 1;
        }
        //下层分类
        $this->cat_less_info=M('articlecat')->where('parent_id=1 and cat_id='.$cat_id)->find();

		if($this->cat_less_info)
		{
			 $new_cat_info = $this->cat_less_info;
		}else
		{
		   $new_cat_info = $cat_info;
		}
        
        $this->site_title       = $new_cat_info['cat_name']? $new_cat_info['cat_name']:$this->site_info['title'];
        $this->site_keywords    = $new_cat_info['keywords']? $new_cat_info['keywords']:$this->site_info['keyword'];
        $this->site_description = $new_cat_info['cat_desc']? $new_cat_info['cat_desc']:$this->site_info['cat_desc'];
        $this->site_description3 = $this->site_info['description'];

          $article_detail=M('article')->where('cat_id='.$cat_id)->find();//关联文章
          if(!$flg){
            
          if($article_detail)
          {
               $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['cat_desc']? $article_detail['cat_desc']:$this->site_info['cat_desc'];
        $this->site_description4 =$this->site_info['description'];
          }
          }


            //重新定义where条件
        /*
        if($this->company_id==0 && $cat_id!=11)
        {
            $this->com_where='1  and is_show=1'; //文章条件
        }
      
        $this->newslist      = M('article')->where($this->com_where.' and cat_id='.$cat_id)->order('sort_order asc,add_time desc')->limit(20)->select();//*/
         $this->company_sort_new='add_time desc,sort_order asc';
        $this->assign('keywords',$keywords);
        $this->assign('cat_info',$cat_info);
        $this->assign('cat_id',$cat_id);
        if($cat_id==11 || $cat_id==34 || $cat_id==36)
        {

            $limit      = $this->limit? $this->limit :6;

            import('ORG.Util.Page2');// 导入分页类
			
            $count      = M('article')->where($this->com_where.' and cat_id='.$cat_id)->count();// 查询满足要求的总记录数 $map表示查询条件
            $count2      = M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id='.$cat_id)->count();// 在总站时候查询满足要求的总记录数 $map表示查询条件
			if($this->company_id == 0){
				$Page       = new Page($count2,$limit);// 在总站时候
			}else{
				$Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
			}
            $Page->setConfig('theme',$this->pageTheme);

            $show       = $Page->show();
            $this->assign('page',$show);

            $this->newslist      = M('article')->where($this->com_where.' and cat_id='.$cat_id)->order($this->company_sort_new)->limit($Page->firstRow.','.$Page->listRows)->select();//*/
			// 在总站时候
			$this->newslist2      = M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id='.$cat_id)->order($this->company_sort_new)->limit($Page->firstRow.','.$Page->listRows)->select();//*/
         
			
		
			
            switch ($cat_id) {
                case '34':
                //上层分类
                 $cat_info=M('articlecat')->where('cat_id=6')->find();
                //下层分类
                  $this->cat_less_info=M('articlecat')->where('parent_id=6 and cat_id='.$cat_id)->find();
                    $this->assign('cat_info',$cat_info);
                   $this->display('index4');
                    break;
                 case '36':
                    $this->display('index4');
                         break;
                default:
                       $this->display('index2');
                    break;
            }
        }
        elseif($cat_id==13)
        {
            $limit      = $this->limit? $this->limit :6;

            import('ORG.Util.Page2');// 导入分页类
            $count      = M('article')->where($this->com_where.' and cat_id='.$cat_id)->count();// 查询满足要求的总记录数 $map表示查询条件
            $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
            $Page->setConfig('theme',$this->pageTheme);

            $show       = $Page->show();
            $this->assign('page',$show);
            $this->newslist      = M('article')->where('cat_id=13')->order('sort_order asc,add_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();//*/
              $this->display('index5');
        }
        elseif($cat_id==9)
        {
                 foreach($this->all_cats[1]['sub_cat'][9]['sub_cat'] as $k=>$v) {
                        $sub_cat_article[$v['cat_id']]= M('article')->where('cat_id='.$v['cat_id'])->order($this->company_sort_new)->find();//*/

                 }
                $this->assign('sub_cat_article',$sub_cat_article);
                 $this->display('index3');
        }
        else
        {

             $article_detail = M('article')->where('cat_id='.$cat_id)->order($this->company_sort_new)->find();
             $this->assign('article_detail',$article_detail);
              $this->display();
        }
      
          //网站标题 关键字 描述

       
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

         $arr= M('article')->where($this->com_where.' and cat_id='.$cat_id)->order('sort_order asc,add_time desc')->limit($pages,20)->select();//


         foreach ($arr as $key=>$val){
            $val['href'] = U("News/detail",array("id"=>$val["article_id"]));
            /*$html.='<li class="clearfixs"><a href="'.$val["href"].'"><img src="/'.$val["original_img"].'" width="100%" alt="">
                    <h5>'.$val["title"].'</h5>
                    <p><svg class="icon" aria-hidden="true"><use xlink:href="#icon-shijian"></use></svg>'.date('Y.m.d',$val["add_time"]).'</p></a></li>';*/
            $html.='<li class="clearfix clearfixs">
                        <a href="'.$val["href"].'">
                            <div class="lazy fl"><img data-original="/'.$val["original_img"].'" class="lazy_img"></div>
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
        $article_detail=M('article')->where($this->com_where.' and article_id='.$id)->find();//案例详情

		//判断内容为空的时候
		if(empty($article_detail)){
			header("Location: /index.php");
		}
		
		
        //分类星系
        $cat_id=$article_detail['cat_id'];

     $this->banner=M('ads')->where("cat_id=5 and title='品牌实力'")->find();

     //上层分类
        $cat_info=M('articlecat')->where('cat_id=1')->find();
        if($cat_id==36)
        {
           $cat_info=M('articlecat')->where('cat_id=36')->find(); 
            $this->banner=M('ads')->where("cat_id=5 and title='装修指南'")->find();
        }
                if($cat_id==34)
        {
           $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find(); 
            $this->banner=M('ads')->where("cat_id=5 and title='服务保障'")->find();
        }
        // var_dump($cat_info);die;
           //上层分类
        $this->cats=M('articlecat')->where('cat_id='.$cat_id)->find();
        $this->cat_info=M('articlecat')->where('cat_id='.$this->cats['parent_id'])->find();
        //下层分类
		
		$company_id=$article_detail['company_id'];
        $this->company_name=M('company')->where('c_id='.$company_id)->find();
        $this->cat_less_info=M('articlecat')->where(' cat_id='.$cat_id)->find();
       
        $this->site_title       = $article_detail['title']? $article_detail['title']:$this->site_info['title'];
        $this->site_keywords    = $article_detail['keywords']? $article_detail['keywords']:$this->site_info['keyword'];
        $this->site_description = $article_detail['description']? $article_detail['description']:$this->site_info['description'];
		
		if($this->company_id == 0){
			//下一篇 
			$front=M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id='.$cat_id.' and article_id >'.$id)->order('article_id asc')->limit('0,1')->find(); 
			$this->assign('front',$front);  
			
			//上一篇  		
			$after=M('article')->where($this->com_where.' and (is_jt=1 or company_id=0) and cat_id='.$cat_id.' and article_id <'.$id)->order('article_id desc')->limit('0,1')->find();
			$this->assign('after',$after);
			// dump($after);die;
		}else{
			//下一篇 
			$front=M('article')->where($this->com_where.' and cat_id='.$cat_id.' and article_id >'.$id)->order('article_id asc')->limit('0,1')->find(); 
			$this->assign('front',$front);  
			
			//上一篇  		
			$after=M('article')->where($this->com_where.' and cat_id='.$cat_id.' and article_id <'.$id)->order('article_id desc')->limit('0,1')->find();
			$this->assign('after',$after);
			// dump($after);die;

		}
		

		
	   
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