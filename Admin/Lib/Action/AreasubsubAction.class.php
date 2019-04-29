<?php

class AreasubsubAction extends CommonAction {
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
        $filter['pp_id']    = empty($_REQUEST['pp_id']) ? 0 :$_REQUEST['pp_id'];
         $filter['p_id']    = empty($_REQUEST['p_id']) ? 0 :$_REQUEST['p_id'];
		$where = ' AND level=3 AND parent_id='.$filter['pp_id'];//地区等级

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
        $sql = 'SELECT a.a_id,a.area_name,a.area_sort,a.a_parentid,a.level,a.area_url '.
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
     * 添加地区
      +----------------------------------------------------------
     */
	public function add(){
		/* 权限判断 */
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$pp_id = empty($_REQUEST['pp_id']) ? 0 :$_REQUEST['pp_id'];
		$p_id = empty($_REQUEST['p_id']) ? 0 :$_REQUEST['p_id'];
		$M_Area  = M()->table($prefix.'area');
		$this->province = $M_Area->where('a_id='.$p_id)->getField('area_name');
		$this->city = M()->table($prefix.'area')->where('a_id='.$pp_id)->getField('area_name');
		$this->assign("prefix",$prefix);
		$this->assign("p_id",$p_id);
			$this->assign("pp_id",$pp_id);
		$this->display();
	}
	
	
	/**
      +----------------------------------------------------------
     * 修改地区
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */
		$a_id=empty($_GET['id'])?0:intval($_GET['id']);

		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_Area  = M()->table($prefix.'area');
		$info = $M_Area->where("a_id=".$a_id)->find();
        $this->province = M()->table($prefix.'area')->where('a_id='.$info['a_parentid'])->getField('area_name');
		$this->city = M()->table($prefix.'area')->where('a_id='.$info['parent_id'])->getField('area_name');
		
		$this->assign("prefix", $prefix);
		$this->assign("info", $info);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 添加地区
      +----------------------------------------------------------
     */
	public function insert(){
		/* 权限判断 */
		
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$M_Area  = M()->table($prefix.'area');
		
		$data['area_name']       = $this->_post("area_name","","");
		$data['area_sort']= $this->_post("area_sort","","");
		$data['area_url']= $this->_post("area_url","","");
		$data['a_parentid']= $this->_post("a_parentid","","");
		$data['parent_id']= $this->_post("parent_id","","");
		$data['level']= 3;
		
		$insertId=$M_Area->data($data)->add();
		if($insertId){
			parent::admin_log($_POST['area_name'],'add','area');
			$this->success('添加成功！！',U('Areasubsub/add/',array('prefix'=>$prefix,'p_id'=>$data['a_parentid'],'pp_id'=>$data['parent_id'])));
		}else{
			$this->error('添加失败！！',U('Areasubsub/add/',array('prefix'=>$prefix,'p_id'=>$data['a_parentid'],'pp_id'=>$data['parent_id'])));
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
        // var_dump($prefix);die;
		$M_Area  = M()->table($prefix.'area');
		$a_id         	= $this->_post("a_id","intval",0);
		$info = $M_Area->where("a_id=".$a_id)->find();
	    $data['area_name']       = $this->_post("area_name","","");
		$data['area_sort']= $this->_post("area_sort","","");
		//$data['a_parentid']= $this->_post("a_parentid","","");
		//$data['parentid_id']= $this->_post("parentid_id","","");
		$data['area_url']= $this->_post("area_url","","");
		$data['level']= 3;
		//print_r($data);exit;
		
		
		$updateId=M()->table($prefix.'area')->where(array('a_id'=>$a_id))->save($data);
		// echo $M_Ads->_sql();die;
		if($updateId){
			parent::admin_log($_POST['area_name'],'edit','Area');
			$this->success('修改成功！！',U('Areasubsub/index/',array('prefix'=>$prefix,'p_id'=>$info['a_parentid'],'pp_id'=>$info['parent_id'])));
		}else{
			$this->success('修改失败！！',U('Areasubsub/index/',array('prefix'=>$prefix,'p_id'=>$info['a_parentid'],'pp_id'=>$info['parent_id'])));
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

		$M_Area  = M()->table($prefix.'area');
		$a_id = $_REQUEST['a_id']+0;
		$oldRow = $M_Area->where("a_id=" . $a_id)->find();
		if (M()->table($prefix.'area')->where("a_id=" . $a_id)->delete()) {
			parent::admin_log('删除省份','remove','Areasub');
			/* 删除旧图片 */
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }

}