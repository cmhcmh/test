<?php

class ArticleAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
		$arr = $this->arr();
		$this->assign("arr", $arr);

	}
	/**
      +----------------------------------------------------------
     * 文章列表
      +----------------------------------------------------------
     */
    public function index($cat_id=0) {
		// 筛选条件及排序
		$filter = array();
		$prefix = $this->_request('prefix', 'trim', 'tp_');
        $filter['keyword']    = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
		$filter['cat_id']     = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
		$filter['company_id']     = empty($_REQUEST['company_id']) ? 0 : intval($_REQUEST['company_id']);
		$filter['res']     = empty($_REQUEST['res']) ? 0 : intval($_REQUEST['res']);
		if($filter['cat_id']==0){
	        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'add_time' : trim($_REQUEST['sort_by']);
	        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);/* 
			$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.article_id' : trim($_REQUEST['sort_by']);
	        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']); */
		}else{
	        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'add_time' : trim($_REQUEST['sort_by']);
	        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);/* 
			$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.sort_order' : trim($_REQUEST['sort_by']);
	        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'asc' : trim($_REQUEST['sort_order']); */
		}
		$this->assign('prefix',$prefix);
		$M_Article = M()->table($prefix."article");

		$filter['record_count'] = $count = D("Article")->listArticleCount($filter,$prefix,$this->admin_info);
		// print_r($count);die;
        
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
		
		$this->assign("filter", $filter);
        $this->assign("page", $showPage);
        $list = D("Article")->listArticle($page->firstRow, $page->listRows,$filter,$prefix,$this->admin_info);
        $this->assign("list", $list);
        $this->assign("cat_id", $filter['cat_id']);

		$this->assign('cat_select',  article_cat_list($prefix,0,$filter['cat_id']));

		//判断单页面或是列表页
		$needarr = array(8,9,10,12,22,27,28,35,30);

        $flg = in_array($filter['cat_id'], $needarr);

        $comcat = M()->table($prefix.'comcat')->select();
        //处理公共分类数组
        foreach($comcat as $k=>$v)
        {

        		$comcat_data[$v['com_id']] =$v;
        }
        $this->assign("comcat_data", $comcat_data);

        //楼盘
        /*
        $hourse = M()->table($prefix.'article')->where("cat_id=19")->select();
        foreach($hourse as $k=>$v)
        {
             $hourse_data[$v['article_id']] = $v;
        }
        $this->assign("hourse_data", $hourse_data);*/

        if($flg)
        {
        	$catinfo = M()->table($prefix.'articlecat')->where("cat_id=".$filter['cat_id'])->find();
        	$this->assign("catinfo", $catinfo);
        	//单页面的数据
        	$info 			= M()->table($prefix."article")->where('cat_id='.$filter['cat_id'])->find();
        	$this->assign("catinfo", $catinfo);
			$this->assign("info", $info);

        	$this->display('page');

        }else
        {
        	//列表页中判断度不同的页面
        	switch ($filter['cat_id']) {
        		
        		case '15':
        			$this->display('cup'); //金马克杯
        			break;
        	    case '16':
        	            	        //读取楼盘
        	    //$this->hourse_list = $this->changdata(19);
        	    //读取设计师
        	   // $this->design_list = $this->changdata(23);
                 
        			//$this->display('case'); //精品案列
        			 if($filter['res']==2)
                     {
                     	$this->display('case_res');//精品案列
                     	exit;
                     }else
                     {
                     	$this->display('case'); //精品案列
                     	exit;
                     }

        			break;

        		case '18':  //VR实景
					$this->display('vr'); 
        			break;
        		case '19':  //热装楼盘
					$this->display('hourse'); 

        			break;

        		case '20':  //在建工地

					$this->display('work'); 
					break;

				case '23':  //设计团队
                     $this->special_style_data = D('article')->list_special_style_data($list);
                     if($filter['res']==2)
                     {

                     	$this->display('design_res');
                     	exit;
                     }else
                     {
                     	$this->display('design'); 
                     	exit;
                     }
                  case '11':  //企业动态

					if($filter['res']==2)
                     {

                     	$this->display('index_res');
                     	exit;
                     }else
                     {
                     	$this->display(); 
                     	exit;
                     }
					break;
					

					break;
        		default:
        			$this->display();
        			break;
        	}
           

        }

        
    }

    /**
      +----------------------------------------------------------
     * 单页面
      +----------------------------------------------------------
     */
	public function page(){
		/* 权限判断 */
		$cat_id=empty($_REQUEST['cat_id'])?0:intval($_REQUEST['cat_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		//所属的分类
		$catinfo = M()->table($prefix.'articlecat')->where("cat_id=".$cat_id)->find();
        $this->assign("catinfo", $catinfo);

		$M_Article 		= M()->table($prefix."article");
		$info 			= $M_Article->where('cat_id='.$cat_id)->find();
		if($info)
		{
		
			//进行更新操作
			$data = M()->table($prefix.'article')->create();
	       
			$data['content']    = stripslashes(htmlspecialchars_decode($_POST['content']));
			$data['add_time']   = $_POST['add_time']? strtotime($_POST['add_time']) : time();
			$data['title']      = $_POST['title'];
			$data['cat_id']     = $cat_id;

			$updateId=M()->table($prefix."article")->where(array('article_id'=>$info['article_id']))->save($data);
			if($updateId){
			//添加相册

			$this->success('更新成功！！',U('Article/index/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
			}else{
				$this->error('更新失败！！',U('Article/index/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
			}	


		}else
		{
				//进行插入操作
			$data = M()->table($prefix.'article')->create();
	       
			$data['content']    = stripslashes(htmlspecialchars_decode($_POST['content']));
			$data['add_time']   = $_POST['add_time']? strtotime($_POST['add_time']) : time();
			$data['title']      = $_POST['title'];
			$data['cat_id']     = $cat_id;
			$insertId=M()->table($prefix.'article')->data($data)->add();//插入数据库

		   if($insertId){
			//添加相册

			$this->success('添加成功！！',U('Article/index/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
			}else{
				$this->error('添加失败！！',U('Article/index/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
			}	

		}
        $this->assign('info', $info);
		$this->assign('catinfo', $catinfo);
		$this->assign('prefix', $prefix);
		$this->assign('cat_id', $cat_id);
        // echo $prefix;
		$this->parent_id = M()->table($prefix.'articlecat')->where("cat_id=$cat_id")->getField('parent_id');
		$this->attr_list = $attr_list;
		$this->assign("cat_select", article_cat_list($prefix,0,$cat_id));
	}

	
	/**
      +----------------------------------------------------------
     * 添加文章页面
      +----------------------------------------------------------
     */
	public function add(){

		/* 权限判断 */
		$cat_id=empty($_GET['cat_id'])?0:intval($_GET['cat_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$this->assign('prefix', $prefix);
		$this->assign('cat_id', $cat_id);
		$this->new_cat_id=$cat_id;
        // echo $prefix;
		$this->parent_id = M()->table($prefix.'articlecat')->where("cat_id=$cat_id")->getField('parent_id');
		$this->attr_list = $attr_list;

	    $M_Articlecat = M()->table($prefix."articlecat");

		$article_cat = $M_Articlecat->where("cat_id=".$cat_id)->find();

		$this->assign("article_cat", $article_cat);

		$this->assign("cat_select", article_cat_list($prefix,0,$cat_id));

		//如果是超级会员，添加的状态默认为已通过
		if($this->admin_info['action_list']=='all') $this->is_show=1; 
	   
       if($this->admin_info['action_list']!='all' && $this->admin_info['company_id']!='') {
        

	         $this->admin_city_list=$this->citysublist($this->admin_info['c_province'],2);
	         $this->admin_company_list=$this->getcompanylist($this->admin_info['c_city']);


	            //所属的设计师

		   	// $this->be_design_info = $this->admin_info['company_id'];
		   	// print_R($this->be_design_info);

		    $this->design_companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
				         	    
			//设计城市
			if($this->design_companyinfo['province_id']){
					$this->design_city_list=$this->citysublist($this->design_companyinfo['province_id'],2);

			}
			//设计公司

			$this->design_company_list=$this->getcompanylist($this->design_companyinfo['city_id']);

			//对应设计团队
			$this->design_new = M()->table($prefix.'article')->alias('a')->join('tp_company as b on a.company_id=b.c_id ')->where("cat_id=23 and is_show=1 and company_id=".$this->admin_info['company_id'])->select();

		//所属的楼盘
          $be_hourse_info =$this->admin_info;
          
          $be_hourse_info['province_id']=$be_hourse_info['c_province'];
          $be_hourse_info['city_id']=$be_hourse_info['c_city'];
          $this->be_hourse_info = $be_hourse_info;


	    //楼盘城市
		if($this->be_hourse_info['province_id']){
			$this->hourse_city_list=$this->citysublist($this->be_hourse_info['province_id'],2);


		}

	     //楼盘地区
		  if($this->be_hourse_info['city_id']){
			$this->hourse_district_list=$this->citysublist($this->be_hourse_info['city_id'],3);

		 }
         //案例中的设计师和楼盘的不能显示
         $this->disabled = ' disabled="disabled"';
		

		

        }

		

	    //风格
	     $this->style = M()->table($prefix.'comcat')->where("type_filed='style'")->select();
	    //户型
		$this->layout = M()->table($prefix.'comcat')->where("type_filed='layout'")->select();
	    //面积
		$this->acreage = M()->table($prefix.'comcat')->where("type_filed='acreage'")->select();

		  //施工
		$work = M()->table($prefix.'comcat')->where("type_filed='work'")->select();
		$work_json = json_encode($work); //方便js调用
	    $this->assign('work', $work);
		$this->assign('work_json', $work_json);
         /*
		 //楼盘
		$this->hourse_adde = M()->table($prefix.'article')->where("cat_id=19")->select();

		//设计团队
		$this->design = M()->table($prefix.'article')->where("cat_id=23")->select();*/

        //擅长风格
        $this->special_style = M()->table($prefix.'comcat')->where("type_filed='special_style'")->select();

        //从业经验
        $this->obtain = M()->table($prefix.'comcat')->where("type_filed='obtain'")->select();
          //级别
        $this->grade= M()->table($prefix.'comcat')->where("type_filed='grade'")->select();
        
		//空间
		$space = M()->table($prefix.'comcat')->where("type_filed='space'")->select();
		$space_json = json_encode($space); //方便js调用
		$this->assign('space', $space);
		$this->assign('space_json', $space_json);

		switch ($cat_id) {
        		
        		case '13':
        			$this->display('video_add'); //品牌视频
        			break;

        	    case '15':
        			$this->display('cup_add'); //金马克杯
        			break;

        		case '16':
        		//读取精品案例相关数据
	        	

	        		$this->display('case_add'); //精品案例
	        		break;

	        		case '23':
        		//设计
	        		$this->display('design_add'); //设计师
	        		break;

        		case '18':  //VR实景
					$this->display('vr_add'); 
        			break;
        	    case '19':  //热装楼盘
        	             /*****所属地区***********/
         		$this->province_id = 0;
				$this->city_id =0;
		
					$this->display('hourse_add'); 
        			break;

        		case '20':  //在建工地
					$this->display('work_add'); 
        		break;
 
        		default:
        			$this->display();
        			break;
        }
	}
	
	
	/**
      +----------------------------------------------------------
     * 修改文章页面
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */
		//print_r($_POST);exit;
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$article_id 	= empty($_GET['id'])?0:intval($_GET['id']);
		$M_Article 		= M()->table($prefix."article");
		$info 			= $M_Article->where('article_id='.$article_id )->find();
		$info['construct_data'] = unserialize($info['construct_data']); //在建工地序列化
		$info['special_style'] = json_decode($info['special_style'],true); //擅长风格数据
		$res     = empty($_REQUEST['res']) ? 0 : intval($_REQUEST['res']);
        // echo  $M_Article->_sql();die;
		$this->parent_id =  M()->table($prefix.'articlecat')->where("cat_id=".$info['cat_id'])->getField('parent_id');

		$M_Articlecat = M()->table($prefix."articlecat");

		$article_cat = $M_Articlecat->where("cat_id=".$info['cat_id'])->find();

		$this->assign("article_cat", $article_cat);

		$this->assign("cat_select", article_cat_list($prefix,0,$info['cat_id']));
		$this->assign("info", 	$info);
		$this->assign('cat_id', $info['cat_id']);
		$this->new_cat_id=$info['cat_id'];
		$this->assign('prefix',$prefix);
		$this->album_list = M()->table($prefix.'album')->where("type='article' and id_value=$article_id")->order('sort_order asc')->select();

		//如果是超级会员，添加的状态默认为已通过
		if($this->admin_info['action_list']=='all') $this->is_show=1; 
		if($this->admin_info['action_list']!='all' && $this->admin_info['company_id']!='') $this->disabled = ' disabled="disabled"';
		

         //权限分公司
        if($info['company_id']){
        	 

         	     $companyinfo = $this->getcompanyinfo($info['company_id']);//获取用户城市的id

         	        //如果导入数据，要重新定义所属分公司的地区
        	    if(empty($info['admin_province_id'])) 
        	    {
        	    	
                   $info['admin_province_id'] = $companyinfo['province_id'];
                   $info['admin_city_id'] = $companyinfo['city_id'];
                   	$this->assign("info", 	$info);
        	    }

         	    //权限城市
				if($companyinfo['province_id']){
					$this->admin_city_list=$this->citysublist($companyinfo['province_id'],2);

				}
				//权限公司

				$this->admin_company_list=$this->getcompanylist($companyinfo['city_id']);

          }

            //所属的楼盘
	    if($info['be_hourse'])
	    {
			 $this->be_hourse_info = M()->table($prefix.'article')->where("article_id=".$info['be_hourse'])->find();
			 // $this->hourse_companyinfo = $this->getcompanyinfo($this->be_hourse_info['company_id']);//获取用户城市的id
		}else
		{
			  if($this->admin_info['action_list']!='all'){
	   	        	      $be_hourse_info =$this->admin_info;
         				  $be_hourse_info['province_id']=$be_hourse_info['c_province'];
          				  $be_hourse_info['city_id']=$be_hourse_info['c_city'];
          				  $this->be_hourse_info = $be_hourse_info;

	   	        }

		}


	    //楼盘城市
		if($this->be_hourse_info['province_id']){
			$this->hourse_city_list=$this->citysublist($this->be_hourse_info['province_id'],2);

		}

	     //楼盘地区
		if($this->be_hourse_info['city_id']){
			$this->hourse_district_list=$this->citysublist($this->be_hourse_info['city_id'],3);

		}
        if($this->be_hourse_info['district_id']){
		 //对应楼盘
			$this->hourse_new = M()->table($prefix.'article')->where("cat_id=19 and is_show=1 and district_id=".$this->be_hourse_info['district_id'])->select();
		}

       //所属的设计师
	   if($info['be_design'])
	   {
	   	
			$this->be_design_info = M()->table($prefix.'article')->where("article_id=".$info['be_design'])->find();
					
	   }else
	   {
	   	        if($this->admin_info['action_list']!='all'){
	   	        	$this->be_design_info = $this->admin_info['company_id'];

	   	        }

	   			
	   }

	    $this->design_companyinfo = $this->getcompanyinfo($this->be_design_info['company_id']);//获取用户城市的id
			         	    
		//设计城市
		if($this->design_companyinfo['province_id']){
							$this->design_city_list=$this->citysublist($this->design_companyinfo['province_id'],2);

		}
		//设计公司

		$this->design_company_list=$this->getcompanylist($this->design_companyinfo['city_id']);

		//对应设计团队
		$this->design_new = M()->table($prefix.'article')->alias('a')->join('tp_company as b on a.company_id=b.c_id ')->where("cat_id=23 and company_id=".$this->be_design_info['company_id'])->select();

		
         	            
			//风格
	    $this->style = M()->table($prefix.'comcat')->where("type_filed='style'")->select();
	        //户型
	    $this->layout = M()->table($prefix.'comcat')->where("type_filed='layout'")->select();
	       //面积
		$this->acreage = M()->table($prefix.'comcat')->where("type_filed='acreage'")->select();
		 //施工
		$work = M()->table($prefix.'comcat')->where("type_filed='work'")->select();
		$work_json = json_encode($work); //方便js调用
	    $this->assign('work', $work);
		$this->assign('work_json', $work_json);
        /*
		 //楼盘
		$this->hourse = M()->table($prefix.'article')->where("cat_id=19")->select();

		//设计团队
		$this->design = M()->table($prefix.'article')->where("cat_id=23")->select();*/


        //擅长风格
        $this->special_style = M()->table($prefix.'comcat')->where("type_filed='special_style'")->select();

        //从业经验
        $this->obtain = M()->table($prefix.'comcat')->where("type_filed='obtain'")->select();
        //级别
        $this->grade= M()->table($prefix.'comcat')->where("type_filed='grade'")->select();
		//空间
		$space = M()->table($prefix.'comcat')->where("type_filed='space'")->select();
		$space_json = json_encode($space); //方便js调用
	    $this->assign('space', $space);
		$this->assign('space_json', $space_json);
		$this->assign('res', $res);
		

		switch ($info['cat_id']) {
        		
        		case '13':   //品牌视频
        			$this->display('video_edit'); 
        			break;

        	    case '15':  //金马克杯
        			$this->display('cup_edit'); 
        			break;
        	    case '16':   //精品案例

        	      

	        		$this->display('case_edit'); 
        			break;

        		case '18':  //VR实景
					$this->display('vr_edit'); 
        			break;
        		case '19':  //热装楼盘
        	    /*****所属地区***********/
		        //地址城市
				if($info['province_id']){
					$this->city_list=$this->citysublist($info['province_id'],2);

				}
				//地址地区
				if($info['city_id']){
					$this->district_list=$this->citysublist($info['city_id'],3);

				}

         		$this->province_id = $info['province_id'];
				$this->city_id =$info['city_id'];
				$this->district_id =$info['district_id'];
				$this->display('hourse_edit'); 

        			break;
        		case '20':  //在建工地


					$this->display('work_edit'); 

        			break;
        		case '23':  //设计团队

					$this->display('design_edit'); 
					break;
        		
        		default:
        			$this->display();
        			break;
        }
	}
	
	/**
      +----------------------------------------------------------
     * 添加文章
      +----------------------------------------------------------
     */
	public function insert(){ 

		/* 权限判断 */
		// $prefix = $this->_request('prefix', 'trim', 'tp_');
		$prefix =$_POST['prefix']?$_POST['prefix']:'tp_';
		$data = M()->table($prefix.'article')->create();
		$imgcode = !empty($_REQUEST['imgcode'])?$_REQUEST['imgcode']:0;
		   $cat_id     = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
       
		$data['content']    = stripslashes(htmlspecialchars_decode($_POST['content']));
		$data['newurl']    = stripslashes(htmlspecialchars_decode($_POST['newurl']));
		$data['add_time']   = $_POST['add_time']? strtotime($_POST['add_time']) : time();
		// $data['attr']		= serialize($data['attr']);//属性
	
		
		if($_FILES['article_img']['error']===0){
			$originalPath='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['article_img']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['article_img']['tmp_name'], $originalPath);
			$data['original_img']  = $originalPath;
		}

		if($_FILES['article_img_pc']['error']===0){
			$originalPath_pc='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['article_img_pc']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['article_img_pc']['tmp_name'], $originalPath_pc);
			$data['original_img_pc']  = $originalPath_pc;
		}

		if($_FILES['article_img_recom']['error']===0){
			$originalPath_recom='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['article_img_recom']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['article_img_recom']['tmp_name'], $originalPath_recom);
			$data['original_img_recom']  = $originalPath_recom;
		}

		if(!empty($_FILES['file_url']['tmp_name'])){
			//$filename = 'Uploads/download/'.$_FILES['file_url']['name'];
			$filename='Uploads/download/'.time().'.'.pathinfo($_FILES['file_url']['name'],PATHINFO_EXTENSION);
			$file_url = iconv('utf-8','gbk',$filename);
			move_uploaded_file($_FILES['file_url']['tmp_name'], $file_url);
			$data['file_url'] = $filename;
		}


        /*
		if($_FILES['file_url']['error']===0){
			$filename = 'Uploads/download/'.$_FILES['file_url']['name'];
			$file_url = iconv('utf-8','gbk',$filename);
			move_uploaded_file($_FILES['file_url']['tmp_name'], $file_url);
			$data['file_url'] = $filename;
		}*/

		
 		$message_success ='添加成功！';//添加成功信息提示
 		$data['title']    = $_POST['title'];
 		$data['is_jt']    = $_POST['is_jt'];
 		$data['is_homelf']    = $_POST['is_homelf'];
 		$data['is_homelz']    = $_POST['is_homelz'];
 		/**********集团，分站权限**************/
         if($this->admin_info['action_list']=='all')
         {
              if($_POST['company_id']) $data['company_id'] = $_POST['company_id'];//选择所属公司
              if($_POST['is_show']) $data['is_show'] = $_POST['is_show']; //审核状态
         }else
         {
         	 

         	  $data['company_id'] = $this->admin_info['company_id'];
         	  $companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
         	  
         	  //分公司的免审核权限
         	  if($companyinfo['c_status']==2 || $this->admin_info['company_id']=='')
         	  {
         	  	$data['is_show'] =1;
         	  }else
         	  {
         	  	$message_success = '提交成功需要管理员审核';// 需要审核分公司的信息提示

         	  }
         	  $data['admin_province_id'] = $companyinfo['province_id'];
         	  $data['admin_city_id'] = $companyinfo['city_id'];
         	  
         }
         /*****所属地区***********/
        $data['province_id']= $this->_post("province_id","","");
        $data['city_id']= $this->_post("city_id","","");
        $data['district_id']= $this->_post("district_id","","");

         /*****施工***********/
         if(!empty($_POST['construct_data']))
         {
         	 $data['construct_data']= serialize($_POST['construct_data']);
         }

          /*****擅长风格已json字段存储***********/
         if(!empty($_POST['special_style']))
         {
         	 $data['special_style']= json_encode($_POST['special_style']);
         }


		// $data['zuowei']    = $_POST['zuowei'];
		// $data['jiage']    = $_POST['jiage'];
		// $data['feixingshijian']    = $_POST['feixingshijian'];
		// $data['hangcheng']    = $_POST['hangcheng'];
		//print_r($data);exit();
   
		$M_Article =  M()->table($prefix.'article');
		$insertId=M()->table($prefix.'article')->data($data)->add();
         //echo $M_Article->_sql(); die;
		 //exit();
		
		if($insertId){
			//添加相册
	        if(is_array($_POST['ori_img'])){
	            foreach($_POST['ori_img'] as $key=>$value){
	                $album = array();
	                $album['original_img']  = $value;
	                $album['thumb_img']     = $_POST['thumb_img'][$key];
	                $album['sort_order']    = $_POST['img_sort'][$key];
	                $album['description']   = $_POST['img_description'][$key];
	                $album['id_value']      = $insertId;
	                $album['type']     		= 'article';

	                M()->table($prefix.'album')->add($album);
	            }
	        }
	        	//空间
		    $space = M()->table($prefix.'comcat')->where("type_filed='space'")->select();
	        //插入picimg 表
	        /*
	        if(!empty($imgcode))
	        {
                 foreach($imgcode as $key=>$val)
                 {
                 	 //查询是否有数据
					$result = M()->table($prefix."picimg")->where(array('imgcode'=>$val))->find();
					if($result){
						$updata['in_insert']= 1;
						$update['p_articleid'] =$insertId;
						$update['imgcode'] ='0';
                      $updateId=M()->table($prefix."picimg")->where(array('imgcode'=>$val))->save($update);
					}
                 }

	        }*/
	        //插入picimg 表
	        $com_arr = $_POST['com_id'];
	        if($com_arr)
	        {
	        	foreach($com_arr as $k=>$v)
	        	{

	        		$ori_img_arr = $_POST['ori_img_'.$v];
	        		foreach($ori_img_arr as $key=>$val)
	        		{


							$picdata['is_insert']= 1;
							$picdata['p_articleid'] =$insertId;
						    $picdata['p_articlecatid'] =$cat_id ;
							$picdata['p_comid'] = $v;
							$picdata['p_path']  = $val;
							$picdata['p_sort']= $_POST['img_sort_'.$v][$key];

	                        $insertIds=M()->table('tp_picimg')->data($picdata)->add();

						
	        		}
	        	}
	        }

         
			$this->success($message_success,U('Article/add/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
		}else{
			$this->error('添加失败！！',U('Article/add/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 更新文章
      +----------------------------------------------------------
     */
	public function update(){
		/* 权限判断 */
		
		// $prefix = $this->_request('prefix', 'trim', 'tp_');
		$prefix=$_POST['prefix']?$_POST['prefix']:'tp_';
		
		$M_Article = M()->table($prefix."article");
		$article_id         = intval($_POST['id']);
	    $cat_id     = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);

		
		$data = M()->table($prefix."article")->create();

		$data['content']    = $_POST['content'];
		$data['is_jt']    = $_POST['is_jt'];
		$data['is_homelf']    = $_POST['is_homelf'];
 		$data['is_homelz']    = $_POST['is_homelz'];
		$_POST['add_time']? $data['add_time'] = strtotime($_POST['add_time']) : '';
		// $data['attr']		= serialize($data['attr']);//属性
			
		$oldRow=$M_Article->where(array('article_id'=>$article_id))->find();
		if(!empty($_FILES['article_img']['tmp_name'])){
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);
			$originalPath='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['article_img']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['article_img']['tmp_name'], $originalPath);
			$data['original_img']  = $originalPath;
		}


	    $oldRow=$M_Article->where(array('article_id'=>$article_id))->find();
		if(!empty($_FILES['article_img_pc']['tmp_name'])){
			@unlink($oldRow['thumb_img_pc']);
			@unlink($oldRow['original_img_pc']);
			$originalPath_pc='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['article_img_pc']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['article_img_pc']['tmp_name'], $originalPath_pc);
			$data['original_img_pc']  = $originalPath_pc;
		}

		    $oldRow=$M_Article->where(array('article_id'=>$article_id))->find();
		if(!empty($_FILES['article_img_recom']['tmp_name'])){
			@unlink($oldRow['thumb_img_pc']);
			@unlink($oldRow['original_img_pc']);
			$originalPath_recom='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['article_img_recom']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['article_img_recom']['tmp_name'], $originalPath_recom);
			$data['original_img_recom']  = $originalPath_recom;
		}




		if(!empty($_FILES['file_url']['tmp_name'])){
			//$filename = 'Uploads/download/'.$_FILES['file_url']['name'];
			$filename='Uploads/download/'.time().'.'.pathinfo($_FILES['file_url']['name'],PATHINFO_EXTENSION);

			$file_url = iconv('utf-8','gbk',$filename);
			move_uploaded_file($_FILES['file_url']['tmp_name'], $file_url);
			$data['file_url'] = $filename;

			@unlink($oldRow['file_url']);
		}

		/**********集团，分站权限**************/
         if($this->admin_info['action_list']=='all')
         {
              if($_POST['company_id']) $data['company_id'] = $_POST['company_id'];//选择所属公司
              if($_POST['is_show']) $data['is_show'] = $_POST['is_show']; //审核状态
         }else
         {
         	  $data['company_id'] = $this->admin_info['company_id'];
         	  $companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
         	  //分公司的免审核权限
         	  /*
         	  if($companyinfo['c_status']==2)
         	  {
         	  	$data['is_show'] =1;//默认通过
         	  }*/
         }
             /*****所属地区***********/
        $data['province_id']= $this->_post("province_id","","");
        $data['city_id']= $this->_post("city_id","","");
        $data['district_id']= $this->_post("district_id","","");

        /*****分公司审核没通过的改回未审核的状态***********/
        if($this->admin_info['action_list']!='all'){
        $article_info = M()->table($prefix."article")->where(array('article_id'=>$article_id))->find();
        if($article_info['is_show']==2)
        {
           $data['is_show'] = 0; 
        }
        }

            /*****施工***********/
         if(!empty($_POST['construct_data']))
         {
         	 $data['construct_data']= serialize($_POST['construct_data']);
         }


          /*****擅长风格已json字段存储***********/
         if(!empty($_POST['special_style']))
         {
         	 $data['special_style']= json_encode($_POST['special_style']);
         }



		/*
		if($_FILES['file_url']['error']==0){
			$filename = 'Uploads/download/'.$_FILES['file_url']['name'];
			$file_url = iconv('utf-8','gbk',$filename);
			move_uploaded_file($_FILES['file_url']['tmp_name'], $file_url);
			$data['file_url'] = $filename;

			@unlink($oldRow['file_url']);
		}*/


		//更新相册
        $new_img_sort = $_POST['new_img_sort'];
        if(is_array($new_img_sort)){
            $old_img_id   = $_POST['old_img_id'];
            foreach($new_img_sort as $k=>$v){
                $data = array();
                $data['sort_order']    = $v;
                $data['description']   = $_POST['new_img_description'][$k];
               M()->table($prefix.'album')->where('id='.$old_img_id[$k])->save($data);
            }
        }

        //添加相册
        if(is_array($_POST['ori_img'])){
            foreach($_POST['ori_img'] as $key=>$value){
                $album = array();
                $album['original_img']  = $value;
                $album['thumb_img']     = $_POST['thumb_img'][$key];
                $album['sort_order']    = $_POST['img_sort'][$key];
                $album['description']   = $_POST['img_description'][$key];
                $album['id_value']      = $article_id;
                $album['type']     		= 'article';

               M()->table($prefix.'album')->add($album);
            }
        }

           //插入picimg 表
	        $com_arr = $_POST['com_id'];
	        if($com_arr)
	        {
	        	foreach($com_arr as $k=>$v)
	        	{

	        		$ori_img_arr = $_POST['ori_img_'.$v];
	        		foreach($ori_img_arr as $key=>$val)
	        		{
							$picdata['is_insert']= 1;
							$picdata['p_articleid'] =$article_id ;
							$picdata['p_articlecatid'] =$cat_id ;
							$picdata['p_comid'] = $v;
							$picdata['p_path']  = $val;
							$picdata['p_sort']= $_POST['img_sort_'.$v][$key];

	                        $insertIds=M()->table('tp_picimg')->data($picdata)->add();

						
	        		}
	        	}
	        }
	         $com_arr_update = $_POST['com_update_id'];
	        if($com_arr_update)
	        {
	        	foreach($com_arr_update as $k=>$v)
	        	{
	        		$old_img_arr = $_POST['old_img_id_'.$v];
	        		foreach($old_img_arr as $key=>$val)
	        		{

                 	 //查询是否有数据
						$result = M()->table($prefix."picimg")->where(array('p_id'=>$val))->find();
						if($result){
						  $picupdata['p_sort']= $_POST['new_img_sort_'.$v][$key];
	                      $updateId=M()->table($prefix."picimg")->where(array('p_id'=>$val))->save($picupdata);
						}
	                 

						
	        		}
	        	}
	        }
	        //更新picimg 表

		 	// 	$data['jixing']    = $_POST['jixing'];
		 	// 	$data['title']    = $_POST['title'];
				// $data['zuowei']    = $_POST['zuowei'];
				// $data['jiage']    = $_POST['jiage'];
				// $data['feixingshijian']    = $_POST['feixingshijian'];
				// $data['hangcheng']    = $_POST['hangcheng'];
				//print_r($data);exit();
		$updateId=M()->table($prefix."article")->where(array('article_id'=>$article_id))->save($data);
		// echo  M()->table($prefix."Article")->_sql();die;
		if($updateId){
			parent::admin_log($_POST['title'],'edit','article');
			$this->success('修改成功！！',U('Article/index/',array('action'=>'edit','cat_id'=>$_POST['cat_id'],'prefix'=>$prefix,'res'=>$_POST['res'])));
		}else{
			$this->error('修改失败！！',U('Article/index/',array('action'=>'edit','cat_id'=>$_POST['cat_id'],'prefix'=>$prefix,'res'=>$_POST['res'])));
		}
		exit();
		
		$this->success('修改成功！！');
	}
	/*
	public function updatepimgnew()
	{
          // echo 1;exit;

		$result = M()->table("tp_picimg")->alias('p')->join('tp_article a ON a.article_id=p.p_articleid')->field("article_id,cat_id")->order("p_id desc")->limit(150000,5000)->select();
		//print_R($result);exit;
		foreach($result as $k=>$v)
		{
			  $picupdata['p_articlecatid'] = $v['cat_id'];
              $updateId=M()->table("tp_picimg")->where(array('p_articleid'=>$v['article_id']))->save($picupdata);

              echo '更新'.$k.'行';

		}

	}*/
	/**
      +----------------------------------------------------------
     * 删除文章
      +----------------------------------------------------------
     */
	public function del() {
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$M_Article = M()->table($prefix."article");
		$article_id= intval($_GET['article_id']);
		$row = $M_Article->where("article_id=" . $article_id)->find();
		$del=M()->table($prefix."article")->where("article_id=" . $article_id)->delete();
		//删除文章内容图片
		if ($del) {
			parent::admin_log(addslashes($row['title']),'remove','article');
			@unlink($row['original_img']);
			@unlink($row['thumb_img']);
			@unlink($row['file_url']);

			remove_content_img($row['content']);
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }

    /**
      +----------------------------------------------------------
     * 删除发布的信息
      +----------------------------------------------------------
     */
	public function f_del($id) {
	   $row     = M('formdata')->find($id);
       $content = $row['content0'] . $row['content1'] . $row['content2'] . $row['content3'] . $row['content4'];
       
       //删除内容图片
       remove_content_img($content); 

       //删除相册
       $album_list   = M('album')->where('id_value='.$row['id'])->select();
       foreach($album_list as $key=>$value){
            @unlink($value['original_img']);
            @unlink($value['thumb_img']);
       }

       //删除属性
       M('form_attr')->where("fid=".$row['id'])->delete();

       //最后删除记录
       M('formdata')->where("id=$id")->delete();
	

	   $this->success('批量操作成功！');
    }

      /**
      +----------------------------------------------------------
     * 数组自定义
      +----------------------------------------------------------
     */

    public function arr()
	{

	    $arr['cup']=array(
	    	    'life'=>array(
		            '1'=>'第一届',
		            '2'=>'第二届',
		            '3'=>'第三届',
		            '4'=>'第四届',
	            ),
	            'case'=>array(

                   '1'=>'实景类',
		           '2'=>'手绘类',
	            ),
	            'winning'=>array(
	            	'1'=>'金奖',
		            '2'=>'银奖',
		            '3'=>'铜奖',
		            '4'=>'优秀奖',
	           )


	        );
	
	    return $arr;
	}
	
	
	/**
      +----------------------------------------------------------
     * 文章批量操作
      +----------------------------------------------------------
     */

	function batch(){
		$M_Article = M("article");
		/* 批量删除 */
		if (isset($_POST['type']))
		{
			$in_article_ids = 'article_id '.db_create_in(join(',', $_POST['checkboxes']));

			if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']))
			{
				$this->error('请选择文章！');exit;
			}

			if ($_POST['type'] == 'button_remove')
			{
				$article_list = M('article')->where($in_article_ids)->select();

				M('article')->where($in_article_ids)->delete();

				foreach($article_list as $value){
					@unlink($value['original_img']);
					@unlink($value['thumb_img']);
					@unlink($value['file_url']);
					remove_content_img($value['content']);
				}
			}

			/* 批量隐藏 */
			if ($_POST['type'] == 'button_hide')
			{
				 $M_Article->where($in_article_ids)->save(array('is_open'=>0));
			}

			/* 批量显示 */
			if ($_POST['type'] == 'button_show')
			{
				$M_Article->where($in_article_ids)->save(array('is_open'=>1));
			}

			//批量推荐
			if($_POST['type'] == 'button_recommend_yes'){
				M('article')->where($in_article_ids)->save(array('is_recommend'=>1));
			}

			//取消推荐
			if($_POST['type'] == 'button_recommend_no'){
				M('article')->where($in_article_ids)->save(array('is_recommend'=>0));
			}

			/* 批量移动分类 */
			if ($_POST['type'] == 'move_to')
			{
				if(!$_POST['target_cat'])
				{
					$this->error('请选择要转移的分类！');
				}
				
				foreach ($_POST['checkboxes'] AS $key => $id)
				{
				  $M_Article->where($in_article_ids)->save(array('cat_id'=>$_POST['target_cat']));
				}
			}
		}

		/* 清除缓存 */
		$this->success('批量操作成功！');
	}


	/**
	 * 信息批量操作
	 */
	 function f_batch(){
		/* 批量删除 */
		if (isset($_POST['type']))
		{
			$ids = "id in (". implode(',', $_POST['checkboxes']) .")";

			if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes']))
			{
				$this->error('请选择至少一条记录！');exit;
			}

			if ($_POST['type'] == 'button_remove')
			{
				$list = M('formdata')->where($ids)->select();

				foreach($list as $value){
					@unlink($value['original_img']);
					@unlink($value['thumb_img']);
					remove_content_img($value['content0'].$value['content1'].$value['content2'].$value['content3'].$value['content4']);
				}


				//删除相册
				$album_list   = M('album')->where("id_value in ($ids)")->select();
				M('album')->where("id_value in ($ids)")->delete();
				foreach($album_list as $key=>$value){
					@unlink($value['original_img']);
					@unlink($value['thumb_img']);
				}

				//删除属性
				M('form_attr')->where("fid in ($ids)")->delete();

				M('formdata')->where($ids)->delete();
			}

			/* 批量审核通过 */
			if ($_POST['type'] == 'button_pass_yes')
			{
				 M('formdata')->where($ids)->save(array('state'=>3));
			}

			/* 批量审核不通过 */
			if ($_POST['type'] == 'button_pass_no')
			{
				M('formdata')->where($ids)->save(array('state'=>1));
			}

			//批量推广
			if($_POST['type'] == 'button_recommend_yes'){
				M('formdata')->where($ids)->save(array('is_recommend'=>2,'recommend_time'=>time()));
			}

			//取消推广
			if($_POST['type'] == 'button_recommend_no'){
				M('formdata')->where($ids)->save(array('is_recommend'=>0));
			}
		}

		/* 清除缓存 */
		$this->success('批量操作成功！');
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

	//获取信息化数据
	/*
	public function save_data($save_for='',$page=1){
		$save_type=!empty($_REQUEST['save_type'])?intval($_REQUEST['save_type']):1;
		if($save_for)
		{
			$save_type =$save_for;
		}
		if($save_type==1)
		{
		$url="https://wx.hxdec.com/oapi/designer/cases";//案列
		$totalnums = 3050;
	     }
		if($save_type==2)
		{
			$url="https://wx.hxdec.com/oapi/designer/designers";//设计师
			$totalnums = 835;
		}
		if($save_type==3)
		{
			$url='https://wx.hxdec.com/oapi/article/lists';//资讯
			$totalnums = 800;
		}
		// 翻页数  
    
		//echo $url;exit;
	    $pagesize=500;

		$pagenum = ceil($totalnums / $pagesize);  
		//echo $pagenum;exit;

		//$data['sign']=strtoupper($appSecret_md5);
		//print_R($data);exit;

		
	     //$this->save_db($new_data,$save_type);

			for($i=1;$i<=$pagenum;$i++){
             $data=array();
             $appSecret="fen6a3irstvpz6pyru8zn3r1dbqmi65m";
		     $data['appId']="6847c076415843cf9ef3fa1fba15f545";
		     $data['timestamp'] = time();
	          //$data['searchName'] ='案例';
		     $data['currentPage'] =$i;
		     $data['pageSize']=$pagesize;
		     $sign = $this->getSignature($data,'md5',$appSecret);

		     $data['sign'] = $sign;
		 
			 $new_data = $this->CurlPost($url,$data);
	         $new_data =json_decode($new_data);

	        $flg = $this->save_db($new_data,$save_type);

			//$this->save_data(2,2);
	          $result[]=$new_data;
	     	}
	     

	     	if($flg)
	     	{
	     		echo "更新数据成功";
	     	}else
	     	{
	     	    echo "没有数据更新";
	     	}
		
	}*/
	/*
	public function update_db()
	{
		$list= M('article')->where('cat_id=16 and is_res=2')->select();
		foreach($list as $k=>$v)
		{
			    $data['acreage'] = '';
				$updateId=M()->table("tp_article")->where(array('article_id'=>$v['article_id']))->save($data);
		}
		if($updateId)
		{
			echo '更新成功';
		}
	}*/
	//导入信息化信息
	/*public function save_db($new_data,$save_type)
	{
	   switch ($save_type) {
	   	case '2':
	   		$cat_id = 23; 
	   		break;
	   	case '1':
	   		$cat_id = 16; 
	   		break;
	   	case '3':
	   		$cat_id = 11; 
	   		break;
	   	
	   }
      if($new_data)
      {
        
        
        $new_data = (array)$new_data; 
        //var_dump($new_data['data']);exit;
        $comcat_arr  = M()->table('tp_comcat')->getField('com_id,com_name');//分类数据

       // $arr_company = M()->table('tp_company')->getField('c_id,c_name');//公司数据
         
        //初始化数据
        $addnum =0;
        $sum =$new_data['count'];
        //$sum =800;
        //$sum =10;
        $count =M('article')->where('cat_id='.$cat_id.' and is_res=2')->count();
        $num = $sum-$count;
        if($save_type==2) //循环设计师数据
        {

        if($num>0)
        {
           for($i=0;$i<$sum;$i++) 
      	   {
      		$object = $new_data['data'][$i];
            if($object->name)
            {
	      		$article_data['cat_id'] =$cat_id;
	      		$article_data['title'] =$object->name;
	      		
	      		$article_data['original_img'] =$object->avatar;
	      		$key_grade= array_search($object->position,$comcat_arr);
	      		$article_data['grade'] = $key_grade;
	      		$article_data['add_time'] = strtotime($object->entryDate);
	      		$article_data['short'] = $object->signature;
	      		//$key_company = array_search($object->companyName,$arr_company);
	            $company_id = M()->table('tp_company')->where('c_name LIKE "%'.$object->companyName.'%"')->getField('c_id');

	      		$article_data['company_id'] = $company_id;
	      		$article_data['is_res']     = 2;
	      		 //
	      		//$article_data['po'] =$comcat_id;

	      		$insertIds=M()->table('tp_article')->data($article_data)->add();
	    
	      		$addnum++;
      		}
      		}
      		return true;

      	  }
      	   //echo "已插入".$addnum."条数据";
      	   return false;
        }elseif($save_type==1) //循环案例数据
        {
           $design_arr  = M()->table('tp_article')->getField('article_id,title');//设计师数据
            if($num>0)
        {
            for($i=0;$i<$sum;$i++) 
      	   {
      		$object = $new_data['data'][$i];

      		$article_data['cat_id'] =$cat_id;
      		$article_data['title'] =$object->title;
      		$drawings = $object->drawings;
      		$drawings_data = $drawings[0];
      		//print_R($drawings_data->img);exit;
      		$article_data['original_img'] =$drawings_data->img;

      		$key_design= array_search($object->designerName,$design_arr);//所属的设计师
      		$article_data['be_design'] = $key_design;

      		$key_style= array_search($object->styleTag,$comcat_arr);//所属的风格
      		$article_data['style'] = $key_style;

      		$key_acreage= array_search($object->houseTag,$comcat_arr);//所属的面积
      		$article_data['acreage'] = $key_acreage;

      		$article_data['add_time']= $object->createdTime;
      		$article_data['short'] = $object->desc;

            $company_id = M()->table('tp_company')->where('c_name LIKE "%'.$object->companyName.'%"')->getField('c_id');
      		$article_data['company_id'] = $company_id;
      		$article_data['is_res']     = 2;
      		 //
      		//$article_data['po'] =$comcat_id;

      		$insertIds=M()->table('tp_article')->data($article_data)->add();
      		   //插入picimg 表
	            $com_arr = $_POST['com_id'];
	           if($drawings)
	           {
	        	
	        		foreach($drawings as $key=>$val)
	        		{

							$picdata['is_insert']= 1;
							$picdata['p_articleid'] =$insertIds;
							$key_space= array_search($val->spaceTag,$comcat_arr);//所属的风格
							$picdata['p_comid'] = $key_space;
							$picdata['p_path']  = $val->img;
							//$picdata['p_sort']= $_POST['img_sort_'.$v][$key];
                             //var_dump($picdata);
	                        M()->table('tp_picimg')->data($picdata)->add();

						
	        		}
	    
	           }
      		$addnum++;

      	   }
      	     return true;
      	 }else
      	 {
             return false;
      	 }
      	   

        }
        elseif($save_type==3) //循环咨询的数据
        {
           if($num>0)
          {
            for($i=0;$i<$sum;$i++) 
      	   {
      		$object = $new_data['data'][$i];

      		$article_data['cat_id'] =$cat_id;
      		$article_data['title'] =$object->title;
      		
      		$article_data['original_img'] =$object->book;
      		$article_data['add_time'] = strtotime($object->createdAt);
      		$article_data['counts'] = $object->views;
      		$article_data['content'] = $object->content;

            $company_id = M()->table('tp_company')->where('c_name LIKE "%'.$object->independentOrgName.'%"')->getField('c_id');

      		$article_data['company_id'] = $company_id;
      		$article_data['is_res']     = 2;
      		 //
      		//$article_data['po'] =$comcat_id;

      		$insertIds=M()->table('tp_article')->data($article_data)->add();
      		$addnum++;

      	   }
      	   return true;
      	  }
      	  return false;

        }
        
      	
      }
       
	}*/

	public function getSignature($arrdata, $method = "md5",$appSecret) {
    if (!function_exists($method)) {
        return false;
    }
    ksort($arrdata);
    $params = array();
    foreach ($arrdata as $key => $value) {
        $params[] = "{$key}={$value}";
    }
    return strtoupper($method(join('&', $params) . $appSecret));
    }




}