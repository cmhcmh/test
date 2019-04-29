<?php

class CompanyAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 地区列表
      +----------------------------------------------------------
     */
    public function index() {
	

		// 筛选条件及排序
		$filter = array();
		$prefix = $this->_request('prefix', 'trim', 'tp_');
        $filter['area_name']    = empty($_REQUEST['area_name']) ? '' :$_REQUEST['area_name'];
		$where = ' AND level=2';//地区等级

		$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.a_id' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'desc' : trim($_REQUEST['sort_order']);
		if (!empty($filter['area_name']))
		{
			$where.= " AND a.area_name LIKE '%" . mysql_like_quote($filter['area_name']) . "%'";
		}

		$this->assign('prefix',$prefix);
		$M_Area = M()->table($prefix."area");
		
		$sql = 'SELECT COUNT(a_id) AS count FROM ' . C('DB_PREFIX') . 'area AS a '.
              // 'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 '.$where;
        $count = $M_Area->query($sql);
        $count = $count[0]['count'];
		// print_r($count);die;
		import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $sql = 'SELECT a.a_id,a.area_name,a.area_sort,a.a_parentid,a.level '.
			   'FROM ' . C('DB_PREFIX') . 'area AS a '.
			   //'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
			   'WHERE 1'.$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'] . 
			   ' LIMIT '.$page->firstRow.','.$page->listRows;

	    $result = $M_Area->query($sql);//地区列表

		$this->assign("filter", $filter);
        $this->assign("page", $showPage);
        $this->assign("list", $result); 
        $this->display();
    }

    /**
      +----------------------------------------------------------
     * 分公司列表
      +----------------------------------------------------------
     */
    public function company() {
	

		// 筛选条件及排序
		$filter = array();
		$prefix = $this->_request('prefix', 'trim', 'tp_');
        $filter['c_name']    = empty($_REQUEST['c_name']) ? '' :$_REQUEST['c_name'];
        $filter['a_id']    = empty($_REQUEST['a_id']) ? '0' :$_REQUEST['a_id'];
         $filter['company_id']    = empty($_REQUEST['company_id']) ? '0' :$_REQUEST['company_id'];
		//$where = ' AND c_city='.$filter['a_id'];//地区等级
		$where = ' ';//地区等级

		$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.c_id' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'desc' : trim($_REQUEST['sort_order']);
		if (!empty($filter['c_name']))
		{
			$where.= " AND a.c_name LIKE '%" . mysql_like_quote($filter['c_name']) . "%'";
		}
		if (!empty($filter['company_id']))
		{
			$where.= " AND a.company_id=".$filter['company_id'];
		}
		$this->assign('prefix',$prefix);
		$M_company = M()->table($prefix."company");
		
		$sql = 'SELECT COUNT(c_id) AS count FROM ' . C('DB_PREFIX') . 'company AS a '.
              // 'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 '.$where;
        $count = $M_company->query($sql);
        $count = $count[0]['count'];
		// print_r($count);die;
		import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $sql = 'SELECT a.c_sort,a.c_domain,a.c_img,a.c_id,a.c_name,a.c_mobile,a.c_fx,a.c_address,a.c_start,a.c_status,a.c_province,a.c_city '.
			   'FROM ' . C('DB_PREFIX') . 'company AS a '.
			   //'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
			   'WHERE 1'.$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'] . 
			   ' LIMIT '.$page->firstRow.','.$page->listRows;

	    $result = $M_company->query($sql);//公司列表

	     foreach($result as $k=>$v)
	    {
	    	$city = M()->table($prefix.'area')->where("a_id=".$v['c_city'])->find();
	    	$result[$k]['area_name'] = $city['area_name'];
	    }

		$this->assign("filter", $filter);
        $this->assign("page", $showPage);
        $this->assign("list", $result); 
        $this->display();
    }
	

	
	/**
      +----------------------------------------------------------
     * 添加公司
      +----------------------------------------------------------
     */
	public function add(){
		
		/* 权限判断 */
		$a_id   = empty($_REQUEST['a_id']) ? '0' :$_REQUEST['a_id'];
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$M_Area  = M()->table($prefix.'area');
		$city = M()->table($prefix.'area')->where("a_id=".$a_id)->find();
		$province = M()->table($prefix.'area')->where("a_id=".$city['a_parentid'])->find();
		$this->assign("city",$city);
		$this->assign("province",$province);
		$this->assign("a_id",$a_id);
		$this->assign("prefix",$prefix);
		$this->display();
	}
	
	
	/**
      +----------------------------------------------------------
     * 修改地区
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */
		$c_id=empty($_REQUEST['id'])?0:intval($_REQUEST['id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$info = M()->table($prefix.'company')->where("c_id=".$c_id)->find(); //公司的详情

		$M_Area  = M()->table($prefix.'area');
		$city = M()->table($prefix.'area')->where("a_id=".$info['c_city'])->find();
		$province = M()->table($prefix.'area')->where("a_id=".$info['c_province'])->find();
				//城市
		if($info['c_province']){

			$this->city_list=$this->citysublist($info['c_province'],2);
		}
		//地区
		if($info['c_city']){
			$this->district_list=$this->citysublist($info['c_city'],3);

		}
		$this->assign("city",$city);
		$this->assign("province",$province);

		
		//$this->assign("province_id", $info['c_province']);
		$this->province_id = $info['c_province'];
		$this->city_id =$info['c_city'];
		$this->assign("a_id", $city['a_id']);
		$this->assign("prefix", $prefix);
		$this->assign("info", $info);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 添加公司
      +----------------------------------------------------------
     */
	public function insert(){
		/* 权限判断 */
		$a_id=empty($_REQUEST['a_id'])?0:intval($_REQUEST['a_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		
		$data['c_name']       = $this->_post("c_name","","");
		$data['c_mobile']= $this->_post("c_mobile","","");
		$data['c_fx']= $this->_post("c_fx","","");
		$data['c_address']= $this->_post("c_address","","");
		$data['c_sort']= $this->_post("c_sort","1","");
		$data['c_domain']= $this->_post("c_domain","","");
		$data['c_status']= $this->_post("c_status","1","");
		$data['c_start']= $this->_post("c_start","1","");


		if(!empty($_FILES['c_img']['tmp_name'])){
			$thumbPath='Uploads/Company/thumb_img/';
			$originalPath='Uploads/Company/original_img/';
			$thumbPrefix='ads_';
			$upfile=parent::upload(array('jpg', 'gif', 'png', 'jpeg'),$originalPath,'time',false);
			$data['c_img']  = $upfile[0]['savepath'].$upfile[0]['savename'];
			//$data['thumb_img']     = $thumbPath.$thumbPrefix.$upfile[0]['savename'];
		}

		$city = M()->table($prefix.'area')->where("a_id=".$a_id)->find(); //城市
		$province = M()->table($prefix.'area')->where("a_id=".$city['a_parentid'])->find();//省份
        $data['c_province']= $this->_post("province_id","","");
        $data['c_city']= $this->_post("city_id","","");

	
		
		$insertId=M()->table($prefix.'company')->data($data)->add();
		if($insertId){
			parent::admin_log($_POST['c_name'],'add','Company');
			$this->success('添加成功！！',U('Company/company/',array('prefix'=>$prefix,'a_id'=>$a_id)));
		}else{
			$this->error('添加失败！！',U('Company/add/',array('prefix'=>$prefix,'a_id'=>$a_id)));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 更新地区
      +----------------------------------------------------------
     */
	public function update(){
		/* 权限判断 */
		
	    $prefix = $_POST['prefix']?$_POST['prefix']:'tp_';

        $a_id=empty($_REQUEST['a_id'])?0:intval($_REQUEST['a_id']); //城市id
        $c_id=empty($_REQUEST['id'])?0:intval($_REQUEST['id']); //公司id
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		
		$data['c_name']       = $this->_post("c_name","","");
		$data['c_mobile']= $this->_post("c_mobile","","");
		$data['c_fx']= $this->_post("c_fx","","");
		$data['c_address']= $this->_post("c_address","","");
		$data['c_sort']= $this->_post("c_sort","1","");
		$data['c_domain']= $this->_post("c_domain","","");
		$data['c_status']= $this->_post("c_status","1","");
		$data['c_start']= $this->_post("c_start","1","");

		if(!empty($_FILES['c_img']['tmp_name'])){
			$thumbPath='Uploads/Company/thumb_img/';
			$originalPath='Uploads/Company/original_img/';
			$thumbPrefix='ads_';
			$upfile=parent::upload(array('jpg', 'gif', 'png', 'jpeg'),$originalPath,'time',false);
			$data['c_img']  = $upfile[0]['savepath'].$upfile[0]['savename'];
			//$data['thumb_img']     = $thumbPath.$thumbPrefix.$upfile[0]['savename'];
		}

		$city = M()->table($prefix.'area')->where("a_id=".$a_id)->find(); //城市

		$province = M()->table($prefix.'area')->where("a_id=".$city['a_parentid'])->find();//省份
        $data['c_province']= $this->_post("province_id","","");
        $data['c_city']= $this->_post("city_id","","");
		
		
		$updateId=M()->table($prefix.'company')->where(array('c_id'=>$c_id))->save($data);
		// echo $M_Ads->_sql();die;
		if($updateId){
			parent::admin_log($_POST['area_name'],'edit','Area');
			$this->success('修改成功！！',U('Company/company/',array('prefix'=>$prefix,'a_id'=>$a_id)));
		}else{
			$this->error('修改失败！！',U('Company/company/',array('prefix'=>$prefix,'a_id'=>$a_id)));
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

		$M_company  = M()->table($prefix.'company');
		$c_id = $_REQUEST['c_id']+0;
		$oldRow = $M_company->where("c_id=" . $c_id)->find();
		if (M()->table($prefix.'company')->where("c_id=" . $c_id)->delete()) {
			parent::admin_log('删除分公司','remove','Company');
			/* 删除旧图片 */
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }

}