<?php

class AreacompanyAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
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

	//获取地级县
	public function get_company(){
		$city_id=empty($_GET['city_id'])?0:intval($_GET['city_id']);
		$listObj = M('company');
		$where['c_city'] = $city_id;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'company'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

	//获取对应的文章
	public function get_article(){
		$company_id=empty($_GET['company_id'])?0:intval($_GET['company_id']);
		$cat_id =empty($_GET['cat_id'])?0:intval($_GET['cat_id']);
		$listObj = M('article');
		$where['company_id'] = $company_id;
		$where['cat_id'] = $cat_id;
		$where['is_show'] = 1;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'article'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

		//获取对应的文章
	public function get_articles(){
		$district_id=empty($_GET['district_id'])?0:intval($_GET['district_id']);
		$cat_id =empty($_GET['cat_id'])?0:intval($_GET['cat_id']);
		$listObj = M('article');
		$where['district_id'] = $district_id;
		$where['cat_id'] = $cat_id;
		$where['is_show'] = 1;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'article'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

}