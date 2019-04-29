<?php

class ComcatAction extends CommonAction {
	public function _initialize() {

		$cat_id   = empty($_REQUEST['cat_id']) ? '' :$_REQUEST['cat_id'];
		$catinfo = M()->table('tp_articlecat')->where("cat_id=".$cat_id)->find();
        $this->assign("catinfo", $catinfo);
		$arr = $this->arr();
		$this->assign("arr", $arr);
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 属性列表
      +----------------------------------------------------------
     */
    public function index() {
		

		// 筛选条件及排序
		$filter = array();
		$prefix = $this->_request('prefix', 'trim', 'tp_');
        $filter['com_name']    = empty($_REQUEST['com_name']) ? '' :$_REQUEST['com_name'];
        $filter['type']    = empty($_REQUEST['type']) ? '' :$_REQUEST['type'];
        $filter['cat_id']    = empty($_REQUEST['cat_id']) ? '' :$_REQUEST['cat_id'];
		$where = '';//地区等级

		$filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'a.com_id' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'desc' : trim($_REQUEST['sort_order']);
		if (!empty($filter['com_name']))
		{
			$where.= " AND a.com_name LIKE '%" . mysql_like_quote($filter['com_name']) . "%'";
		}

		if (!empty($filter['type']))
		{
			$where.= " AND a.type_filed ='".$filter['type']."'";
		}

		if (!empty($filter['cat_id']))
		{
			$where.= " AND a.articlecat_id ='".$filter['cat_id']."'";
		}


		$this->assign('prefix',$prefix);
		$M_comcat = M()->table($prefix."comcat");
		
		$sql = 'SELECT COUNT(com_id) AS count FROM ' . C('DB_PREFIX') . 'comcat AS a '.
              // 'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 '.$where;
        $count = $M_comcat->query($sql);
        $count = $count[0]['count'];
		// print_r($count);die;
		import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
        $sql = 'SELECT a.com_id,a.articlecat_id,a.type_filed,a.com_name,a.parent_id,a.com_img,a.is_top,a.sort_order '.
			   'FROM ' . C('DB_PREFIX') . 'comcat AS a '.
			   //'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
			   'WHERE 1'.$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'] . 
			   ' LIMIT '.$page->firstRow.','.$page->listRows;

	    $result = $M_comcat->query($sql);//地区列表
		$this->assign("filter", $filter);
        $this->assign("page", $showPage);
        $this->assign("list", $result); 

        $this->display();
    }
	

	
	/**
      +----------------------------------------------------------
     * 添加属性
      +----------------------------------------------------------
     */
	public function add(){
		/* 权限判断 */
		$type=empty($_GET['type'])?0:$_GET['type'];
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$this->assign("type",$type);
		$this->assign("prefix",$prefix);
		$this->display();
	}
	
	
	/**
      +----------------------------------------------------------
     * 修改属性
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */
		$com_id=empty($_GET['id'])?0:intval($_GET['id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_comcat  = M()->table($prefix.'comcat');
		$info = $M_comcat->where("com_id=".$com_id)->find();
		
		$this->assign("prefix", $prefix);
		$this->assign("info", $info);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 添加属性
      +----------------------------------------------------------
     */
	public function insert(){
		/* 权限判断 */
		
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_comcat  = M()->table($prefix.'comcat');
		
		$data['com_name']       = $this->_post("com_name","","");
		$data['sort_order']= $this->_post("sort_order","","");
		$data['articlecat_id']= $this->_post("cat_id","","");
		$data['type_filed']= $this->_post("type","","");
		$data['is_top']   = empty($_REQUEST['is_top']) ? 0 :$_REQUEST['is_top'];
		if($_FILES['com_img']['error']===0){
			$originalPath='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['com_img']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['com_img']['tmp_name'], $originalPath);
			$data['com_img']  = $originalPath;
		}
		

		
		$insertId=$M_comcat->data($data)->add();
		if($insertId){
			parent::admin_log($_POST['com_name'],'add','comcat');
			$this->success('添加成功！！',U('Comcat/add/',array('prefix'=>$prefix,'type'=>$_POST['type'],'cat_id'=>$_POST['cat_id'])));
		}else{
			$this->error('添加失败！！',U('Comcat/add/',array('prefix'=>$prefix,'type'=>$_POST['type'],'cat_id'=>$_POST['cat_id'])));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 更新属性
      +----------------------------------------------------------
     */
	public function update(){
		/* 权限判断 */
		
	    $prefix = $_POST['prefix']?$_POST['prefix']:'tp_';
        // var_dump($prefix);die;
		$M_comcat  = M()->table($prefix.'comcat');
		$com_id         	= $this->_post("com_id","intval",0);
	    $data['com_name']       = $this->_post("com_name","","");
		$data['sort_order']= $this->_post("sort_order","","");
		$data['articlecat_id']= $this->_post("cat_id","","");
		$data['type_filed']= $this->_post("type","","");
		$data['is_top']   = empty($_REQUEST['is_top']) ? 0 :$_REQUEST['is_top'];
		$data['is_pctop']   = empty($_REQUEST['is_pctop']) ? 0 :$_REQUEST['is_pctop'];
		if($_FILES['com_img']['error']===0){
			$originalPath='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['com_img']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['com_img']['tmp_name'], $originalPath);
			$data['com_img']  = $originalPath;
		}
		
		$updateId=M()->table($prefix.'comcat')->where(array('com_id'=>$com_id))->save($data);
		// echo $M_Ads->_sql();die;
		if($updateId){
			parent::admin_log($_POST['com_name'],'edit','Comcat');
			$this->success('修改成功！！',U('Comcat/index/',array('prefix'=>$prefix,'type'=>$_POST['type'],'cat_id'=>$_POST['cat_id'])));
		}else{
			$this->error('修改失败！！',U('Comcat/index/',array('prefix'=>$prefix,'type'=>$_POST['type'],'cat_id'=>$_POST['cat_id'])));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 删除属性
      +----------------------------------------------------------
     */
	public function del() {
		/* 权限判断 */
	    $prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_comcat  = M()->table($prefix.'comcat');
		$com_id = $_REQUEST['com_id']+0;
		$oldRow = $M_comcat->where("com_id=" . $com_id)->find();
		if (M()->table($prefix.'comcat')->where("com_id=".$com_id)->delete()) {
			parent::admin_log('删除属性','remove','comcat');
			/* 删除旧图片 */
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }


          /**
      +----------------------------------------------------------
     * 数组自定义
      +----------------------------------------------------------
     */

    public function arr()
	{

	    $arr['name']=array(

		            'style'=>'风格',
		            'layout'=>'户型',
		            'acreage'=>'面积',
		            'space'=>'空间',
		            'work'=>'施工',
		            'special_style'=>'擅长风格',
		            'obtain'=>'从业经验',
		            'grade'=>'级别',

	        );
	
	    return $arr;
	}

}