
<?php

class DistrictAction extends CommonAction {
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
	    $listObj = M()->table($prefix.'region');
		$whereprovince['top_parentid'] = 0;
		$listprovince = $listObj->where($whereprovince)->select();
		$this->assign("province_list",$listprovince);


		//导入数据
		 $result = M()->table($prefix.'region')->select();
		 foreach($result as $k=>$v)
		 {
		 	$data['area_name']  = $v['region_name'];
			$data['a_id']   = $v['region_id'];
			$data['level']      = $v['level'];
			$data['a_parentid']     = $v['top_parentid'];
			$insertId=M()->table($prefix.'area')->data($data)->add();//插入数据库

		 }
		
        $this->display();

    }

    //获取地级市
	public function get_citys(){
		$province_id=empty($_GET['province_id'])?0:intval($_GET['province_id']);
		$listObj = M('region');
		$where['top_parentid'] = $province_id;
		$where['level'] = 2;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'city'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

	//获取地级县
	public function get_district(){
		$city_id=empty($_GET['city_id'])?0:intval($_GET['city_id']);
		$listObj = M('region');
		$where['parent_id'] = $city_id;
		$where['level'] = 3;
		$list = $listObj->where($where)->select();
		$data=array('status'=>0,'district'=>$list);
		header("Content-type: application/json");
		exit(json_encode($data));
	}

}