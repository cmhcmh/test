<?php
class MessageAction extends CommonAction {
  public function _initialize() {
    parent::_initialize();  
  }
  /**
      +----------------------------------------------------------
     * 招聘列表
      +----------------------------------------------------------
     */
    public function index() {
        $type=empty($_REQUEST['type'])?0:intval($_REQUEST['type']);
        $tel=empty($_REQUEST['tel'])?0:intval($_REQUEST['tel']);
        $prefix = $this->_request('prefix', 'trim', 'tp_');
        $company_id = !empty($_REQUEST['company_id'])?$_REQUEST['company_id']:'';
        $M_Guestbook  = M()->table($prefix."message");
        if($this->admin_info['action_list']!='all' || ($this->admin_info['company_id']!='' or $this->admin_info['company_id']!=0 ))
       {
		   if($this->admin_info['company_id']==9 || $this->admin_info['company_id']==147 || $this->admin_info['company_id']==152 || $this->admin_info['company_id']==161 || $this->admin_info['company_id']==159 || $this->admin_info['company_id']==167 || $this->admin_info['company_id']==158|| $this->admin_info['company_id']==164 || $this->admin_info['company_id']==172 || $this->admin_info['company_id']==155 || $this->admin_info['company_id']==153 || $this->admin_info['company_id']==162 || $this->admin_info['company_id']==156 || $this->admin_info['company_id']==166 || $this->admin_info['company_id']==160 || $this->admin_info['company_id']==163 || $this->admin_info['company_id']==165 || $this->admin_info['company_id']==154 || $this->admin_info['company_id']==174 || $this->admin_info['company_id']==175 || $this->admin_info['company_id']==168 || $this->admin_info['company_id']==169 || $this->admin_info['company_id']==170 || $this->admin_info['company_id']==171 || $this->admin_info['company_id']==173 || $this->admin_info['company_id']==145 || $this->admin_info['company_id']==181|| $this->admin_info['company_id']==242 || $this->admin_info['company_id']==265 || $this->admin_info['company_id']==235 || $this->admin_info['company_id']==91  || $this->admin_info['company_id']==196  || $this->admin_info['company_id']==180  || $this->admin_info['company_id']==114 || $this->admin_info['company_id']==125 || $this->admin_info['company_id']==185 || $this->admin_info['company_id']==198 || $this->admin_info['company_id']==273 || $this->admin_info['company_id']==97){
          $where=' AND company_id='.$this->admin_info['company_id'].'';
		   }else{
			$where=' AND company_id='.$this->admin_info['company_id'].' AND qx= 1';
		   }
        }
		else
        {
          if($company_id)
         {
          $where=' AND company_id='.$company_id;
         }
        }
        if($tel)
        {
          $where.=' AND tel="'.$tel.'"';
        }
          $sql = 'SELECT COUNT(id) AS count FROM ' . C('DB_PREFIX') . 'message AS a '.
               //'LEFT JOIN ' . C('DB_PREFIX') . 'company AS b ON b.c_id=a.company_id '.
               ' where type='.$type.$where;
        $count = $M_Guestbook->query($sql);
        $count = $count[0]['count'];
        //echo $where;exit;
        import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
       // var_dump($showPage);
        $recruitmentList = $M_Guestbook->where('type='.$type.$where)->order("add_time desc,id asc")->limit($page->firstRow,$page->listRows)->select();

        // print_r($recruitmentList);
        foreach ($recruitmentList as $k => $v) {
          //$recruitmentList[$k]['type'] =M('article')->where('article_id='.$v['type'])->getField('title');
          $recruitmentList[$k]['add_time'] = date("Y-m-d H:i:s",$v['add_time']);
          $recruitmentList[$k]['province_name'] =M('area')->where('a_id='.$v['province_id'])->getField('area_name');
          $recruitmentList[$k]['city_name'] =M('area')->where('a_id='.$v['city_id'])->getField('area_name');
          $recruitmentList[$k]['company_name'] =M('company')->where('c_id='.$v['company_id'])->getField('c_name');
          $recruitmentList[$k]['be_company_name'] =M('company')->where('c_id='.$v['be_company_id'])->getField('c_name');
        }

        $this->assign("recruitmentList",$recruitmentList);
        $this->assign("prefix",$prefix);
        $this->assign("type",$type);
        $this->assign("page",$showPage);
        if($type==3)
        {
           $this->display('jianyi');

        }else
        {
           $this->display();

        }
       
    }

  /**
      +----------------------------------------------------------
     * 修改招聘页面
      +----------------------------------------------------------
     */
  public function edit(){
    /* 权限判断 */
    $type=empty($_GET['type'])?0:intval($_GET['type']);
    $recruitment_id=empty($_GET['id'])?0:intval($_GET['id']);
    $prefix = $this->_request('prefix', 'trim', 'tp_');
  
    $M_Guestbook  = M()->table($prefix."message");
    $info = $M_Guestbook->where("id=".$recruitment_id)->find(); 
    //$info['type']=M('article')->where('article_id='.$info['type'])->getField('title');

    $info['province_name'] =M('area')->where('a_id='.$info['province_id'])->getField('area_name');
    $info['city_name'] =M('area')->where('a_id='.$info['city_id'])->getField('area_name');
    $info['company_name'] =M('company')->where('c_id='.$info['company_id'])->getField('c_name');
    $info['add_time'] = date("Y-m-d",$info['add_time']);

        //分派分公司
    if($info['be_company_id']){
               $companyinfo = $this->getcompanyinfo($info['be_company_id']);//获取用户城市的id
              //权限城市
        if($companyinfo['province_id']){
          $this->admin_city_list=$this->citysublist($companyinfo['province_id'],2);

        }
        //权限公司

        $this->admin_company_list=$this->getcompanylist($companyinfo['city_id']);

    }
    // print_r($info);die;
    $this->assign("companyinfo", $companyinfo);
    $this->assign("info", $info);
    $this->assign("prefix",$prefix);
            if($type==3)
        {
           $this->display('jianyi_edit');

        }else
        {
           $this->display();

        }
  }

  public function update(){
    /* 权限判断 */

    $id=empty($_POST['id'])?0:intval($_POST['id']);
    
    $prefix = $_POST['prefix']?$_POST['prefix']:'tp_';
        // var_dump($prefix);die;
    $M_Message  = M()->table($prefix.'message');
    $data['be_company_id']=empty($_POST['company_id'])?0:intval($_POST['company_id']);
    $data['is_handle']=empty($_POST['is_handle'])?0:intval($_POST['is_handle']);
    $data['qx']=empty($_POST['qx'])?0:intval($_POST['qx']);
    $data['content']=$_POST['content'];
    
    //print_r($data);exit;


    
    
    $updateId=M()->table($prefix.'message')->where(array('id'=>$id))->save($data);
 // var_dump(M()->table($prefix.'message'));exit;
    // echo $M_Ads->_sql();die;
    if($updateId){
      parent::admin_log($_POST['description'],'edit','Message');
      $this->success('修改成功！！',U('Message/index/',array('type'=>$_POST['type'],'prefix'=>$prefix)));
    }else{
      $this->error('修改失败！！',U('Message/index/',array('type'=>$_POST['type'],'prefix'=>$prefix)));
    }
    exit();
  }
  
  /**
      +----------------------------------------------------------
     * 删除招聘
      +----------------------------------------------------------
     */
  public function del() {
    /* 权限判断 */
     $prefix = $this->_request('prefix', 'trim', 'tp_');
      
    $M_Guestbook  = M()->table($prefix."message");
    $guestbook_id= intval($_GET['id']);
    $oldRow = $M_Guestbook->where("id=" . $guestbook_id)->find();
   
    if (M()->table($prefix."message")->where("id=" . $guestbook_id)->delete()) {
      parent::admin_log(addslashes($oldRow['description']),'remove','recruitment');
      /* 删除旧图片 */
      $oldRow=$M_Guestbook->where(array('id'=>$guestbook_id))->find();
      if ($oldRow['thumb_img'] != ''){
        @unlink("./".$oldRow['thumb_img']);
        @unlink("./".$oldRow['original_img']);
      }
      $this->success("成功删除");
    } else {
      $this->error("删除失败，可能是不存在该ID的记录");
    } 
    }

    public function join_online(){
      import("ORG.Util.Page");       //载入分页类
        $page = new Page($count, 20);
        $showPage = $page->show();
    
        $this->assign("page", $showPage);
        $this->assign("join_list", M('join_online')->order('add_time desc')->limit($page->firstRow, $page->listRows)->select());

      $this->display('join_index');
    }

    public function join_info($id){
      $this->detail = M('join_online')->where(array('id'=>$id))->find();
      $this->display();
    }

    //报名管理
    public function baoming($type=1){
      $this->list = M('baoming')->where("type=$type")->order('add_time desc')->page(1,20)->select();
      $this->display('baoming_'.$type);
    }

    //删除报名
    public function del_baoming($id){
      if(M('baoming')->where("id=$id")->delete()){
        $this->success('删除成功！');
      }else{
        $this->success('未知错误！');
      }
    }

    //报名详细
    public function baoming_detail($id){
      $this->detail = M('baoming')->find($id);
      $this->display();
    }

    //批量删除报名
    public function batch(){
      $ids = $_POST['ids'];
      if(is_array($ids)) $ids = implode(',', $ids);
      $where = "id in ($ids)";

      $batch_type = $_POST['batch_type'];

      if(!$batch_type) $this->error('请选择操作类型！');

      if($batch_type=='batch_del_baoming') M('baoming')->where($where)->delete();
      if($batch_type=='batch_del_formdata'){
        $rows = M('formdata')->where($where)->select();
        foreach($rows as $value){
          if($value['type']==6){//人才招聘
            @unlink($value['value9']);
          }
        }
        M('formdata')->where($where)->delete();
      }

      $this->success('操作成功！');
    }

    public function exactA($type=1){
      $rows = M('baoming')->field("company_name,role,name,phone,weixin,add_time")->where('type='.$type)->select();
      $fields = array('机构名称','职务','姓名','联系电话','微信妮称','添加时间');
      foreach($rows as $key=>$value){
        $value['add_time'] = date('Y-m-d H:i',$value['add_time']);
        $rows[$key] = array_values($value);
      }
      array_unshift($rows, $fields);
      $this->exactCsv($rows,'Cooperation.csv');
    }

    public function exactB($type=2){
      $rows = M('baoming')->field("child_num1,child_num2,name,phone,weixin,role,company_name,referee,add_time")->where('type='.$type)->select();
      $fields = array('家庭中0-3岁的孩子有','家庭中4-6岁的孩子有','姓名','电话','微信昵称','是孩子的','家庭企业名称','推荐人或机构','添加时间');
      foreach($rows as $key=>$value){
        $value['add_time'] = date('Y-m-d H:i',$value['add_time']);
        $rows[$key] = array_values($value);
      }
      array_unshift($rows, $fields);
      $this->exactCsv($rows,'Parent.csv');
    }

    //导出CSV
    public function exactCsv($arr,$filename='abcd.csv'){
      $fh = fopen($filename,'w+');
      foreach($arr as $value){
        fputcsv($fh, $value);
      }
      fclose($fh);

      $fh = fopen($filename,'r');
      Header("Content-type: application/octet-stream");
      Header("Accept-Ranges: bytes");
      Header("Accept-Length: ".filesize($filename));
      Header("Content-Disposition: attachment; filename=" . $filename);
      // 输出文件内容
      echo fread($fh,filesize($filename));
      fclose($fh);

      unlink($filename);
      exit;
    }

    //通用表单数据
    public function formdata($type=1){
      //type 1：公开日报名  2：报读狮子公学  3：活动合作
      $this->list = M('formdata')->where("type=$type")->select();
      $this->type = $type;
      $this->display();
    }


    //表单详细
    public function formdata_detail($id){
      $this->detail = M('formdata')->find($id);
      $this->type = $this->detail['type'];
      $this->display();
    }

    //删除表单
    public function del_formdata($id){
      $oldrow = M('formdata')->where("id=$id")->delete();
      if($oldrow['type']==6){//人才招聘
        @unlink($oldrow['value9']);
      }
      M('formdata')->where("id=$id")->delete();
      $this->success('操作成功！');
    }
}
?>