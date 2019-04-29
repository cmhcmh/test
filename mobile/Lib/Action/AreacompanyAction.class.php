<?php

class AreacompanyAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

	/**
      +----------------------------------------------------------
     * 文章列表
      +----------------------------------------------------------
     */
    public function index($cat_id=0) {
		// 筛选条件及排序
		$filter = array();
	   // $listObj = M('region');
		$prefix = $this->_request('prefix', 'trim', 'tp_');
	    $listObj = M()->table($prefix.'area');
		$whereprovince['a_parentid'] = 0;
		$listprovince = $listObj->where($whereprovince)->select();
		$this->assign("province_list",$listprovince);
		
        $this->display();
        $this->display();
    }

    //获取地级市
	public function get_citys(){
		$province_id=empty($_GET['province_id'])?0:intval($_GET['province_id']);
		$listObj = M('area');
		$where['a_parentid'] = $province_id;
		$where['level'] = 2;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'city'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

	//获取公司
	public function get_company(){
		$city_id=empty($_GET['city_id'])?0:intval($_GET['city_id']);
		$listObj = M('company');
		//$where['c_city'] = $city_id;
		$where='c_city='.$city_id.' and c_domain!=""';
		$list = $listObj->where($where)->select();
		$citys = $this->getareainfo($city_id);
		$city_name = $citys['area_name'];
		$data=array('status'=>0,'company'=>$list,'city_name'=>$city_name);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

		//获取地级县
	public function get_district(){
		$city_id=empty($_GET['city_id'])?0:intval($_GET['city_id']);
		$listObj = M('area');
		$where['parent_id'] = $city_id;
		$where['level'] = 3;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'district'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

}