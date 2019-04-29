<?php

class AdsAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 广告图列表
      +----------------------------------------------------------
     */
    public function index() {
		
		$cat_id = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
		$city_id = empty($_REQUEST['city_id']) ? 0 : intval($_REQUEST['city_id']);
		$province_id = empty($_REQUEST['province_id']) ? 0 : intval($_REQUEST['province_id']);
		$company_id = empty($_REQUEST['company_id']) ? 0 : intval($_REQUEST['company_id']);

		$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.sort_order' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'asc' : trim($_REQUEST['sort_order']);

		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_Ads  = M()->table($prefix.'ads');

		if($this->admin_info['action_list']!='all' || $this->admin_info['company_id'])
		{
			$where=' AND company_id='.$this->admin_info['company_id'];
		}else
		{
		 if($company_id)
		   {
			$where=' AND a.company_id='.$company_id;
		 }
  
		}

	
		if($city_id){

			$this->company_list = M()->table('tp_company')->where('c_city='.$city_id)->select();//权限公司数据

		}

		if($province_id){

			$this->city_list = M()->table($prefix.'area')->where('parent_id='.$province_id.' and level=2')->select();//权限公司数据
		

		}
      // print_R($where);exit;
		$sql = 'SELECT COUNT(ads_id) AS count FROM ' . C('DB_PREFIX') . 'ads AS a '.
               'LEFT JOIN ' . C('DB_PREFIX') . 'company AS b ON b.c_id=a.company_id '.
               'WHERE cat_id = '.$cat_id.$where;

        $count = $M_Ads->query($sql);
        $count = $count[0]['count'];

		import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();

		
		$adsList = M()->table($prefix.'ads')->alias('a')->where('cat_id='.$cat_id.$where)->join('tp_company b on b.c_id=a.company_id')->limit($page->firstRow,$page->listRows)->order('sort_order asc')->select();		
		$counts = count($adsList);
		$this->assign("prefix",$prefix);
		$this->assign("counts",$counts);
		$this->assign("cat_id",$cat_id);
		$this->assign("adsList",$adsList);
		$this->assign("city_id",$city_id);
		$this->assign("province_id",$province_id);
		$this->assign("page",$showPage);
		$this->assign("company_id",$company_id);

        $this->display();
    }
	

	
	/**
      +----------------------------------------------------------
     * 添加广告图页面
      +----------------------------------------------------------
     */
	public function add(){
		/* 权限判断 */
		  
       if($this->admin_info['action_list']!='all' || $this->admin_info['company_id']!='') {
        

        	$this->admin_city_list=$this->citysublist($this->admin_info['c_province'],2);
        	$this->admin_company_list=$this->getcompanylist($this->admin_info['c_city']);
        }
		
		$cat_id=empty($_GET['cat_id'])?0:intval($_GET['cat_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$this->assign("prefix",$prefix);
		$this->assign("cat_id",$cat_id);
		$this->display();
	}
	
	
	/**
      +----------------------------------------------------------
     * 修改广告图页面
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */
		$ads_id=empty($_GET['id'])?0:intval($_GET['id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_Ads  = M()->table($prefix.'ads');
		$info = $M_Ads->where("ads_id=".$ads_id)->find();

		    //权限分公司
        if($info['company_id']){
         	     $companyinfo = $this->getcompanyinfo($info['company_id']);//获取用户城市的id
         	    //权限城市
				if($companyinfo['province_id']){
					$this->admin_city_list=$this->citysublist($companyinfo['province_id'],2);

				}
				//权限公司

				$this->admin_company_list=$this->getcompanylist($companyinfo['city_id']);

          }
          
		
		$this->assign("prefix", $prefix);
		$this->assign("cat_id", $info['cat_id']);
		$this->assign("info", $info);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 添加广告图
      +----------------------------------------------------------
     */
	public function insert(){
		/* 权限判断 */
		
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_Ads  = M()->table($prefix.'ads');
		
		$data['link']       = $this->_post("link","","");
		$data['description']= $this->_post("description","","");
		$data['title']		= $this->_post("title","","");
		$is_whole=empty($_POST['is_whole'])?0:intval($_POST['is_whole']);
		$data['is_whole'] = $is_whole;

		$data['title']		= $this->_post("title","","");
		$data['title']		= $this->_post("title","","");
		$data['title_en']		= $this->_post("title_en","","");
		$data['tddescription']		= $_POST['tddescription'];

		$data['cat_id']     = $this->_post("cat_id","intval",0);
		$data['nums']     = empty($_REQUEST['nums']) ? 0 : intval($_REQUEST['nums']);
		$data['sort_order'] = $this->_post("sort_order","intval",0);
		$data['is_open']    = $this->_post("is_open","intval",1);
		$data['add_time']   = time();
		$data['img_size']   = $this->_post('img_size','trim','');
		$data['up_time']   = $_POST['up_time']? strtotime($_POST['up_time']) : time();
		$data['down_time']   = $_POST['down_time']? strtotime($_POST['down_time']) :'';

		//判断会员
		if($this->admin_info['action_list']=='all'){
				$data['admin_province_id']		= $this->_post("admin_province_id","","");
				$data['admin_city_id']		= $this->_post("admin_city_id","","");
				$data['company_id']		= $this->_post("company_id","","");
		}else
		{
			  $data['company_id'] = $this->admin_info['company_id'];
         	  $companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
         	  $data['admin_province_id'] = $companyinfo['province_id'];
         	  $data['admin_city_id'] = $companyinfo['city_id'];
		}
		
		
		if(!empty($_FILES['ads_img']['tmp_name'])){
			$thumbPath='Uploads/Banner/thumb_img/';
			$originalPath='Uploads/Banner/original_img/';
			$thumbPrefix='ads_';
			$upfile=parent::upload(array('jpg', 'gif', 'png', 'jpeg'),$originalPath,'time',false);
			$data['original_img']  = $upfile[0]['savepath'].$upfile[0]['savename'];
			$data['thumb_img']     = $thumbPath.$thumbPrefix.$upfile[0]['savename'];
		}
		
		
		$insertId=$M_Ads->data($data)->add();

		if($insertId){
			parent::admin_log($_POST['description'],'add','ads');
			$this->success('添加成功！！',U('Ads/add/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
		}else{
			$this->error('添加失败！！',U('Ads/add/',array('cat_id'=>$data['cat_id'],'prefix'=>$prefix)));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 更新广告图
      +----------------------------------------------------------
     */
	public function update(){
		/* 权限判断 */
		
	    $prefix = $_POST['prefix']?$_POST['prefix']:'tp_';
        // var_dump($prefix);die;
		$M_Ads  = M()->table($prefix.'ads');
		$ads_id         	= $this->_post("ads_id","intval",0);
		$data['link']       = $this->_post("link","","");
		$data['description']= $this->_post("description","","");
		$data['tddescription']		= $_POST['tddescription'];
		$data['title']		= $this->_post("title","","");
		$data['title_en']		= $this->_post("title_en","","");
		$data['cat_id']     = $this->_post("cat_id","intval",0);
		$data['nums']     = empty($_REQUEST['nums']) ? 0 : intval($_REQUEST['nums']);
		$data['sort_order'] = $this->_post("sort_order","intval",0);
		$data['is_open']    = $this->_post("is_open","intval",1);
		$data['img_size']   = $this->_post('img_size','trim','');
		$is_whole=empty($_POST['is_whole'])?0:intval($_POST['is_whole']);
		$data['is_whole'] = $is_whole;
		$data['up_time']   = $_POST['up_time']? strtotime($_POST['up_time']) : time();
		$data['down_time']   = $_POST['down_time']? strtotime($_POST['down_time']) :'';
		//print_r($data);exit;

			//判断会员
		if($this->admin_info['action_list']=='all'){
				$data['admin_province_id']		= $this->_post("admin_province_id","","");
				$data['admin_city_id']		= $this->_post("admin_city_id","","");
				$data['company_id']		= $this->_post("company_id","","");
		}else
		{
			  $data['company_id'] = $this->admin_info['company_id'];
         	  $companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
         	  $data['admin_province_id'] = $companyinfo['province_id'];
         	  $data['admin_city_id'] = $companyinfo['city_id'];
		}

		if(!empty($_FILES['ads_img']['tmp_name'])){
			$thumbPath='Uploads/Banner/thumb_img/';
			$originalPath='Uploads/Banner/original_img/';
			$upfile=parent::upload(array('jpg', 'gif', 'png', 'jpeg'),$originalPath,'time',false);
			$data['original_img']  = $upfile[0]['savepath'].$upfile[0]['savename'];
			$data['thumb_img']     = $thumbPath.$thumbPrefix.$upfile[0]['savename'];
			
			/* 删除旧图片 */
			$oldRow=$M_Ads->where(array('ads_id'=>$ads_id))->find();
			if ($oldRow['thumb_img'] != ''){
				@unlink("./".$oldRow['thumb_img']);
				@unlink("./".$oldRow['original_img']);
			}
		}
		
		
		$updateId=M()->table($prefix.'ads')->where(array('ads_id'=>$ads_id))->save($data);
		//echo $M_Ads->_sql();die;
		if($updateId){
			parent::admin_log($_POST['description'],'edit','ads');
			$this->success('修改成功！！',U('Ads/index/',array('cat_id'=>$_POST['cat_id'],'prefix'=>$prefix)));
		}else{
			$this->error('修改失败！！',U('Ads/index/',array('cat_id'=>$_POST['cat_id'],'prefix'=>$prefix)));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 删除广告图
      +----------------------------------------------------------
     */
	public function del() {
		/* 权限判断 */
	    $prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_Ads  = M()->table($prefix.'ads');
		$ads_id = $_REQUEST['ads_id']+0;
		$oldRow = $M_Ads->where("ads_id=" . $ads_id)->find();
		if (M()->table($prefix.'ads')->where("ads_id=" . $ads_id)->delete()) {
			parent::admin_log(addslashes($oldRow['description']),'remove','ads');
			/* 删除旧图片 */
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }

}