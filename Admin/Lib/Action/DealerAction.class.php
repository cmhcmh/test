<?php

class DealerAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 产品信息列表
      +----------------------------------------------------------
     */
    public function index() {
		
		// 筛选条件及排序

		$filter = array();
		$prefix = $this->_request('prefix', 'trim', 'tp_');
        $filter['CompanyID']    = empty($_REQUEST['CompanyID']) ? '' :$_REQUEST['CompanyID'];
        $filter['CompanyName']    = empty($_REQUEST['CompanyName']) ? '' :$_REQUEST['CompanyName'];
         $filter['ProvinceDesc']    = $_REQUEST['ProvinceDesc']=='省份' ? '' :$_REQUEST['ProvinceDesc'];
          $filter['CityDesc']    = $_REQUEST['CityDesc']=='地级市'? '' :$_REQUEST['CityDesc'];
           $filter['AreaDesc']    = $_REQUEST['AreaDesc']=='市、县级市' ? '' :$_REQUEST['AreaDesc'];
		$where = '';
		/*
		if($filter['cat_id']==0){
	        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.article_id' : trim($_REQUEST['sort_by']);
	        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
		}else{
	        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.sort_order' : trim($_REQUEST['sort_by']);
	        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'asc' : trim($_REQUEST['sort_order']);
		}*/
		$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.De_id' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'desc' : trim($_REQUEST['sort_order']);
		if (!empty($filter['CompanyID']))
		{
			$where.= " AND a.CompanyID =".$filter['CompanyID'];
		}
		if (!empty($filter['CompanyName']))
		{
			$where.= " AND a.CompanyName LIKE '%" . mysql_like_quote($filter['CompanyName']) . "%'";
		}
		if (!empty($filter['ProvinceDesc']))
		{
			$where.= " AND a.ProvinceDesc ='".$filter['ProvinceDesc']."'";
		}
			if (!empty($filter['CityDesc']))
		{
			$where.= " AND a.CityDesc ='".$filter['CityDesc']."'";
		}
			if (!empty($filter['AreaDesc']))
		{
			$where.= " AND a.AreaDesc ='".$filter['AreaDesc']."'";
		}


		$this->assign('prefix',$prefix);
		$M_dealer = M()->table($prefix.'dealer');
		
		$sql = 'SELECT COUNT(De_id) AS num FROM ' . C('DB_PREFIX') . 'dealer AS a '.
               //'LEFT JOIN ' . C('DB_PREFIX') . 'drug AS b ON b.y_number = a.b_y_number '.
               'WHERE 1 '.$where;
        $count = $M_dealer->query($sql);
        $count = $count[0]['num'];
		// print_r($count);die;
		import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $sql = 'SELECT a.De_id,a.CompanyID,a.CompanyName,a.ProvinceDesc,a.CityDesc,a.AreaDesc,a.Address,a.de_filed '.
			   'FROM ' . C('DB_PREFIX') . 'dealer AS a '.
			  //   'LEFT JOIN ' . C('DB_PREFIX') . 'drug AS b ON b.y_number = a.b_y_number '.
			   'WHERE 1 '.$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'] . 
			   ' LIMIT '.$page->firstRow.','.$page->listRows;
	    $result = $M_dealer->query($sql);

        $this->assign("b_del", $b_del);
		$this->assign("filter", $filter);
        $this->assign("page", $showPage);
        $this->assign("list", $result);
		//$this->assign('cat_select',  article_cat_list($prefix,0,$filter['cat_id']));
        $this->display();
    }
	

	
	/**
      +----------------------------------------------------------
     * 添加广告图页面
      +----------------------------------------------------------
     */
	public function add(){
		/* 权限判断 */
	
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$this->assign("prefix",$prefix);
		 $M_drug  = M()->table($prefix.'drug');
        $this->drug=$M_drug->order('y_id desc')->select();
		$this->display();
	}
	
	
	/**
      +----------------------------------------------------------
     * 修改广告图页面
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */
		$P_id=empty($_GET['id'])?0:intval($_GET['id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$M_dealer  = M()->table($prefix.'dealer');

		$this->info =$M_dealer->alias('a')->where('a.P_id='.$P_id)->find();
		
		$this->assign("prefix", $prefix);
		//$this->assign("cat_id", $info['cat_id']);
		$this->display();
	}
	

	/**
      +----------------------------------------------------------
     * 更新广告图
      +----------------------------------------------------------
     */
	public function update(){
		/* 权限判断 */
		$P_id=empty($_POST['id'])?0:intval($_POST['id']);
	  	$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_dealer  = M()->table($prefix.'dealer');
		
		$data['Usage']       = $this->_post("Usage","","");
		//$data['b_number']     = $this->_post("b_number","","");

		if(!empty($_FILES['P_img']['tmp_name'])){
			//$thumbPath='Uploads/drug/thumb_img/';
			$originalPath='Uploads/drug/original_img/';
			//$thumbPrefix='ads_';
			$upfile=parent::upload(array('jpg', 'gif', 'png', 'jpeg'),$originalPath,'time',false);
			$data['P_img']  = $upfile[0]['savepath'].$upfile[0]['savename'];
			
			/* 删除旧图片 */
			$oldRow=$M_dealer->where(array('P_id'=>$P_id))->find();
			if ($oldRow['original_img'] != ''){
				@unlink("./".$oldRow['thumb_img']);
				@unlink("./".$oldRow['original_img']);
			}
		}


		
		$updateId=M()->table($prefix.'dealer')->where(array('P_id'=>$P_id))->save($data);
		// echo $M_Ads->_sql();die;
		if($updateId){
			parent::admin_log('修改产品','edit','dealer');
			$this->success('修改成功！！',U('dealer/index/',array('prefix'=>$prefix)));
		}else{
			$this->error('修改失败！！',U('dealer/index/',array('prefix'=>$prefix)));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 还原
      +----------------------------------------------------------
     */
	public function recovery()
	{
		/* 权限判断 */
	    $prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_dealer  = M()->table($prefix.'dealer');
		$b_id = $_REQUEST['id']+0;
		$updateId=M()->table($prefix.'dealer')->where(array('dealer_id'=>$b_id))->save(array('b_del'=>0));
		$oldRow = $M_dealer->where("b_id=".$b_id)->find();
		if ($updateId) {
			parent::admin_log('还基地成功','recovery','dealer');
			/* 删除旧图片 */
			/*
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);*/
			$this->success("还原成功");
		} else {
			$this->error("还原失败，可能是不存在该ID的记录");
		} 
	}
	/**
      +----------------------------------------------------------
     * 删除广告图
      +----------------------------------------------------------
     */
	public function del() {
		/* 权限判断 */
	    $prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_dealer  = M()->table($prefix.'dealer');
		$b_id = $_REQUEST['b_id']+0;
		$updateId=M()->table($prefix.'dealer')->where(array('dealer_id'=>$b_id))->save(array('b_del'=>1));
		$oldRow = $M_dealer->where("dealer_id=" . $b_id)->find();
		if ($updateId) {
			parent::admin_log(addslashes($oldRow['description']),'remove','dealer');
			/* 删除旧图片 */
			/*
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);*/
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }

}