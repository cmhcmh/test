<?php

class WebinfosnewAction extends CommonAction {
  public function _initialize() {
    parent::_initialize();  
  }
  /**
      +----------------------------------------------------------
     * 站点配置图列表
      +----------------------------------------------------------
     */
    public function index() {
    $company_id = 0;
        //判断会员
    if($this->admin_info['action_list']=='all'){
          //$data['admin_province_id']    = $this->_post("admin_province_id","","");
          //$data['admin_city_id']    = $this->_post("admin_city_id","","");
          $company_id   = 0;
          $this->is_hidden="display:none";
    }else
    {
          $company_id = $this->admin_info['company_id'];
          $this->admin_city_list=$this->citysublist($this->admin_info['c_province'],2);
                 $this->admin_company_list=$this->getcompanylist($this->admin_info['c_city']);
              //$companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
              //$data['admin_province_id'] = $companyinfo['province_id'];
              //$data['admin_city_id'] = $companyinfo['city_id'];
    }

    $prefix = $this->_request('prefix', 'trim', 'tp_');

    $info       = M()->table($prefix."webinfos")->where('w_companyid='.$company_id)->find();
    if(!empty($info['w_data']))
    {
      $info['w_data'] = json_decode($info['w_data'],true);
    }

    $this->assign("prefix",$prefix);
    $this->assign("info",$info);
    $this->assign("company_id",$company_id);
    $this->assign("w_companyid",$info['w_companyid']);
    echo 1;exit;
        $this->display();
    }
  

  
  /**
      +----------------------------------------------------------
     * 添加站点配置图页面
      +----------------------------------------------------------
     */
  public function add(){
    /* 权限判断 */
      
       if($this->admin_info['action_list']!='all') {
        

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
     * 修改站点配置图页面
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
     * 添加站点配置图
      +----------------------------------------------------------
     */
  public function page(){
    /* 权限判断 */
    //$company_id=empty($_REQUEST['company_id'])?0:intval($_REQUEST['company_id']);
      //判断会员
    if($this->admin_info['action_list']=='all'){
          //$data['admin_province_id']    = $this->_post("admin_province_id","","");
          //$data['admin_city_id']    = $this->_post("admin_city_id","","");
          $company_id   = 0;
    }else
    {
          $company_id = $this->admin_info['company_id'];
              //$companyinfo = $this->getcompanyinfo($this->admin_info['company_id']);//获取用户城市的id
              //$data['admin_province_id'] = $companyinfo['province_id'];
              //$data['admin_city_id'] = $companyinfo['city_id'];
    }
    $prefix = $this->_request('prefix', 'trim', 'tp_');

    $info       = M()->table($prefix."webinfos")->where('w_companyid='.$company_id)->find();

    $M_webinfos  = M()->table($prefix.'webinfos');
    
    $data['w_companyid']       = $company_id;
    $data['w_data']= json_encode($_POST['data']);
    $data['w_addtime']   = time();
         if($info)
    {
      $updateId=M()->table($prefix."webinfos")->where(array('w_companyid'=>$info['w_companyid']))->save($data);
      if($updateId){

      $this->success('更新成功！！',U('Webinfos/index/',array('w_companyid'=>$data['w_companyid'],'prefix'=>$prefix)));
      }else{
        $this->error('更新失败！！',U('Webinfos/index/',array('w_companyid'=>$data['w_companyid'],'prefix'=>$prefix)));
      } 
    
    }else
    {


      $insertId=$M_webinfos->data($data)->add();
      if($insertId){
        parent::admin_log($_POST['description'],'add','ads');
        $this->success('添加成功！！',U('Webinfos/index/',array('w_companyid'=>$company_id,'prefix'=>$prefix)));
      }else{
        $this->error('添加失败！！',U('Webinfos/index/',array('w_companyid'=>$company_id,'prefix'=>$prefix)));
      }

    }
    exit();
  }
  /**
      +----------------------------------------------------------
     * 更新站点配置图
      +----------------------------------------------------------
     */
  public function update(){
    /* 权限判断 */
    
      $prefix = $_POST['prefix']?$_POST['prefix']:'tp_';
        // var_dump($prefix);die;
    $M_Ads  = M()->table($prefix.'ads');
    $ads_id           = $this->_post("ads_id","intval",0);
    $data['link']       = $this->_post("link","","");
    $data['description']= $this->_post("description","","");
    $data['title']    = $this->_post("title","","");
    $data['cat_id']     = $this->_post("cat_id","intval",0);
    $data['sort_order'] = $this->_post("sort_order","intval",0);
    $data['is_open']    = $this->_post("is_open","intval",1);
    $data['img_size']   = $this->_post('img_size','trim','');
    //print_r($data);exit;

      //判断会员
    if($this->admin_info['action_list']=='all'){
        $data['admin_province_id']    = $this->_post("admin_province_id","","");
        $data['admin_city_id']    = $this->_post("admin_city_id","","");
        $data['company_id']   = $this->_post("company_id","","");
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
    // echo $M_Ads->_sql();die;
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
     * 删除站点配置图
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