<?php

class QufenAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 地区列表
      +----------------------------------------------------------
     */
    public function index() {
		$c_id=empty($_REQUEST['c_id'])?0:intval($_REQUEST['c_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$qufen = M()->table($prefix.'tgqf')->where("cid=".$c_id)->select();
		
		$this->assign("c_id", $c_id);
		$this->assign("qufen", $qufen);
        $this->display();
    }

	public function addkf(){
			/* 权限判断 */
			
		$c_id=empty($_REQUEST['c_id'])?0:intval($_REQUEST['c_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');

		$info = M()->table($prefix.'company')->where("c_id=".$c_id)->find(); //公司的详情
		$this->assign("prefix", $prefix);
		$this->assign("info", $info);
		$this->display();
	}
	
	public function edit(){
		/* 权限判断 */
		$id=empty($_REQUEST['id'])?0:intval($_REQUEST['id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$info = M()->table($prefix.'tgqf')->where("id=".$id)->find(); //公司的详情
		//dump($info);die;
		$this->assign("prefix", $prefix);
		$this->assign("info", $info);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 添加
      +----------------------------------------------------------
     */
	public function insert(){
		/* 权限判断 */
		$cid=empty($_REQUEST['cid'])?0:intval($_REQUEST['cid']);
		$prefix = $this->_request('tp_');
		$data['id']       = '';
		$data['cid']       = $cid;
		$data['shibie'] = $this->_post("shibie","","");
		$data['tel'] = $this->_post("tel","","");
		$data['kefupc'] = $this->_post("kefupc","","");
		$data['kefuwap'] = $this->_post("kefuwap","","");	
		
		$insertId = M( $prefix.'tgqf')->data($data)->add();
		//$insertId = M($prefix.'tgqf')->getLastSql();
		//dump(M( $prefix.'tgqf'));die();
		if($insertId){
			//parent::admin_log($_POST['cid'],'add','Qufen');
			$this->success('添加成功！！',U('Qufen/index/',array('prefix'=>$prefix,'c_id'=>$cid)));
		}else{
			$this->error('添加失败！！',U('Qufen/addkf/',array('prefix'=>$prefix,'cid'=>$cid)));
		}
		exit();
	}
	
	public function update(){
		/* 权限判断 */
		$id=empty($_REQUEST['id'])?0:intval($_REQUEST['id']);
		$cid=empty($_REQUEST['cid'])?0:intval($_REQUEST['cid']);
		$prefix = $this->_request('tp_');
		$data['shibie'] = $this->_post("shibie","","");
		$data['tel'] = $this->_post("tel","","");
		$data['kefupc'] = $this->_post("kefupc","","");
		$data['kefuwap'] = $this->_post("kefuwap","","");	
		
		//$insertId = M($prefix.'tgqf')->data($data)->add();
		$updateId=M($prefix.'tgqf')->where(array('id'=>$id))->save($data);
		if($updateId){
			$this->success('修改成功！！',U('Qufen/index/',array('prefix'=>$prefix,'c_id'=>$cid)));
		}else{
			$this->error('修改失败！！',U('Qufen/edit/',array('prefix'=>$prefix,'cid'=>$cid,'id'=>$id)));
		}
		exit();
	}
	
	public function del() {
		/* 权限判断 */
	    $prefix = $this->_request('tp_');
		$id=empty($_REQUEST['id'])?0:intval($_REQUEST['id']);
		$delid = M($prefix.'tgqf')->where("id=" . $id)->delete();
		
		if($delid) {
			$this->success("成功删除");
		} else {
			$this->error("删除失败，可能是不存在该ID的记录");
		} 
    }
	

}