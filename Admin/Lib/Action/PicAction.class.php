<?php

class PicAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 地区列表
      +----------------------------------------------------------
     */
    public function index() {
		//获取分类id
		$com_id = empty($_REQUEST['com_id']) ? '0' :$_REQUEST['com_id'];
		$cat_id = empty($_REQUEST['cat_id']) ? '0' :$_REQUEST['cat_id'];
		$article_id = empty($_REQUEST['article_id']) ? '0' :$_REQUEST['article_id'];
		$imgcode = $this->getRandomString(5,6).time().$com_id;
		$type = empty($_REQUEST['type']) ? '0' :$_REQUEST['type'];
        //空间的数据
		$space = M()->table('tp_comcat')->where("type_filed='$type'")->select();
		$this->assign('space', $space);
		$this->assign('imgcode', $imgcode);
        $this->assign('com_id', $com_id);
        $this->assign('article_id', $article_id);

        $this->display();
    }

    // public function album($id_value, $thumb_width, $thumb_height){
    public function album(){
    	$thumb_width = empty($_REQUEST['thumb_width']) ? '600' :$_REQUEST['thumb_width'];
		$thumb_height = empty($_REQUEST['thumb_height']) ? '550' :$_REQUEST['thumb_height'];
        $com_id = empty($_REQUEST['com_id']) ? '0' :$_REQUEST['com_id'];
		$cat_id = empty($_REQUEST['cat_id']) ? '0' :$_REQUEST['cat_id'];
		$article_id = empty($_REQUEST['article_id']) ? '0' :$_REQUEST['article_id'];
		$imgcode = $this->getRandomString(5,6).time().$com_id;
		$type = empty($_REQUEST['type']) ? '0' :$_REQUEST['type'];
        //空间的数据
		$space = M()->table('tp_comcat')->where("type_filed='$type'")->select();
		if($article_id)
		{
			$picarr = M()->table("tp_picimg")->where(array('p_articleid'=>$article_id,'p_comid'=>$com_id))->select();
		}
		$this->assign('picarr', $picarr);
		$this->assign('space', $space);
		$this->assign('imgcode', $imgcode);
        $this->assign('com_id', $com_id);
        $this->assign('article_id', $article_id);
        $this->assign('thumb_width',$thumb_width);
        $this->assign('thumb_height',$thumb_height);

        $this->display();
    }

        //删除数据库的图片
    public function delimg($id){
        $oldrow = M('picimg')->where('p_id='.$id)->find();
        M('picimg')->where('p_id='.$id)->delete();
        @unlink($oldrow['p_path']);
        @unlink($oldrow['thumb_img']);
        exit('1');
    }

    public function fileinit() {

    	$article_id = empty($_REQUEST['article_id']) ? '0' :$_REQUEST['article_id'];
    	$com_id = empty($_REQUEST['com_id']) ? '0' :$_REQUEST['com_id'];

	    $db = M()->table("tp_picimg")->where(array('p_articleid'=>$article_id,'p_comid'=>$com_id))->select();
		$rows = array();
		if($db){

		    foreach($db as $row){
		        if(!empty($row)){
		            $rows[] = array(
		                'name'=>$row['p_path'],
		                'sort'=>$row['p_sort'],
		                'path'=>"/".$row['p_path'],
		                'key'=>$row['p_path'],
		                'size'=>0,
						'id'=>$row['p_id'],
						'p_id'=>$row['p_id'],
		            );
		        }
		    }
		}



		echo json_encode( $rows );


    }
    public function fileupdate()
    {

		echo json_encode( array('code'=>0, 'msg'=>'ok') );

    }

    //删除照片
    public function filedel()
    {

       if( empty($_GET['p_id']) ){
    		echo json_encode( array('code'=>-1, 'msg'=>'error'));
   				 exit;
		}

	  $db = M()->table("tp_picimg")->where(array('p_id'=>$_GET['p_id']))->find();
	  $rows = array();
	  if($db){

 
	       $del=M()->table("tp_picimg")->where("p_id=" . $db['p_id'])->delete();
	  }

		echo json_encode( array('code'=>0, 'msg'=>'ok') );


    }

    public function fileupload()
    {

     if(empty($_FILES)) die(json_encode(array('code'=>-1,'msg'=>'error')));

	 $file = $_FILES['file'];
	 if($file['error']!=0 || $file['size']< 1 ){
	    die(json_encode(array('code'=>-1,'msg'=>'error','id'=>$_POST['id'])));
	 }
     if(!empty($_FILES['file']['tmp_name'])){
			@unlink($oldRow['thumb_img']);
			@unlink($oldRow['original_img']);
			$originalPath='Uploads/article/original_img/'.time().'.'.pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['file']['tmp_name'], $originalPath);
			$data['p_path']  = $originalPath;
	  }
	  $data['p_comid'] = $_REQUEST['com_id'];
	  $data['imgcode'] = $_REQUEST['imgcode'];
	  if($_REQUEST['article_id'])
	  {
	  	$data['p_articleid'] = $_REQUEST['article_id'];
	  }

	  $insertId=M()->table('tp_picimg')->data($data)->add();

	  echo json_encode( array( 'code'=>0, 'msg'=>'ok', 'id'=>$_POST['id'],'imagecode'=>$data['imgcode']) );


    }
	

	
	//生成随机字母跟数字
	public function getRandomString($len_shuzi,$len,$chars=null,$char_shuzi=null)
	{
	    if (is_null($char_shuzi)){
	        $char_shuzi = "0123456789";
	    }  
	    mt_srand(10000000*(double)microtime());
	    for ($j = 0, $str_shuzi = '', $lc = strlen($char_shuzi)-1; $j < $len_shuzi; $j++){
	        $str_shuzi .= $char_shuzi[mt_rand(0, $lc)];  
	    }
	    if (is_null($chars)){
	        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    }  
	    mt_srand(10000000*(double)microtime());
	    for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){
	        $str .= $chars[mt_rand(0, $lc)];  
	    }

	    return $str.$str_shuzi;
	}	

}