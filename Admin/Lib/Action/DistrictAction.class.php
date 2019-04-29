<?php

class DistrictAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	
    /********************************************************************************************/

    //地区选择控件
    /*
        JS调用：Create_Position($container, $position)     myScript.js

        非JS可以直接在模版用 include标签引用
        <include file='District:index' province="{$userInfo.province}" city="{$userInfo.city}" district="{$userInfo.district}" is_district="1"/>
        模版文件：Admin/Tpl/District/index
    */
    public function index($cat_id=0) {

		// 筛选条件及排序
		$filter = array();
	   // $listObj = M('region');
		/*
		$province =!empty($_REQUEST['province'])?$_REQUEST['province']:0;
		$city =!empty($_REQUEST['province'])?$_REQUEST['province']:0;
		$district =!empty($_REQUEST['province'])?$_REQUEST['province']:0;
		$is_district =!empty($_REQUEST['is_district'])?$_REQUEST['is_district']:0;*/


		$prefix = $this->_request('prefix', 'trim', 'tp_');
	    $listObj = M()->table($prefix.'area');
		$whereprovince['a_parentid'] = 0;
		$listprovince = $listObj->where($whereprovince)->select();//省份
		$citylist = $listObj->where('level=2')->select();//城市
		$districtlist = $listObj->where('level=3')->select();//地区
		
		$this->assign("is_district",1);
		/*
		$this->assign("province",$province);
		$this->assign("city",$city);
		$this->assign("district",$district);*/
		$this->assign("province_list",$listprovince);
		$this->assign("citylist",$citylist);
		$this->assign("districtlist",$districtlist);
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

}