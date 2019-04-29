<?php

class ArticlecatAction extends CommonAction {
	public function _initialize() {
		parent::_initialize();	
	}
	/**
      +----------------------------------------------------------
     * 文章分类列表
      +----------------------------------------------------------
     */
    public function index($pid=0) {
    	$prefix = $this->_request('prefix', 'trim', 'tp_');
		$this->assign("action",$_GET['action']);
		$this->assign("parent_id",$_GET['parent_id']);
		$cat_id = $_GET['cat_id']+0;

		
		$this->assign("cat_id",$cat_id);
		
		$articlecat=D("Articlecat")->listArticlecat($pid,$prefix);

		/*
		$action_list = $_SESSION['action_list'];
		$action_list_arr = explode(',', $action_list);
		$column = array();
		foreach($action_list_arr as $key=>$value){
			if(strpos($value, 'column_') !== false){
				$column[] = substr($value, 7);
			}
		}

		foreach ($articlecat as $key => $value) {
			if(!in_array($key, $column)){
				unset($articlecat[$key]);
			}
		}
		*/
		
		$html='';
	
		foreach($articlecat as $key=>$value){
			$html.='<li class="closed"><a href="'.U('Articlecat/edit',array('cat_id'=>$value['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value['name'].'</span></a>';
				if($value['cat_id']){
					$html.='<ul>';
					foreach($value['cat_id'] as $key2=>$value2){
						$html.='<li class="closed"><a href="'.U('Articlecat/edit',array('cat_id'=>$value2['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value2['name'].'</span></a>';
							if($value2['cat_id']){
							$html.='<ul>';
								foreach($value2['cat_id'] as $key3=>$value3){
									$html.='<li class="closed"><a href="'.U('Articlecat/edit',array('cat_id'=>$value3['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value3['name'].'</span></a>';
										if($value3['cat_id']){
											$html.='<ul>';
											foreach($value3['cat_id'] as $key4=>$value4){
												$html.='<li class="closed"><a href="'.U('Articlecat/edit',array('cat_id'=>$value4['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value4['name'].'</span></a></li>';
											}
											$html.='</ul>';
										}
									$html.='</li>';
								}
								$html.='</ul>';
							}
						$html.='</li>';
					}
					$html.='</ul>';
				}
			$html.='</li>';
		}
		
		$this->assign("prefix",$prefix);
		$this->assign("html",$html);
		// print_r($html);
		$this->assign("articlecat",$articlecat);
		$this->display();
    }



    public function index2($pid=0){
    	$prefix = $this->_request('prefix', 'trim', 'tp_');
    	$this->assign("action",$_GET['action']);
		$this->assign("parent_id",$_GET['parent_id']);
		$cat_id = $_GET['cat_id']+0;
		$this->assign("cat_id",$cat_id);
		
		$articlecat=D("Articlecat")->listArticlecat($pid,$prefix);
		// print_r($articlecat);die;
		/*
		$action_list = $_SESSION['action_list'];
		$action_list_arr = explode(',', $action_list);
		$column = array();
		foreach($action_list_arr as $key=>$value){
			if(strpos($value, 'article_') !== false){
				$column[] = substr($value, 8);
			}
		}
		
		foreach ($articlecat as $key => $value) {
			if(!in_array($key, $column)){
				unset($articlecat[$key]);
			}
		}
		*/
		
		$html='';
		$cat_arr =array(1,16,3,4,5,6);
		//$role_parent_arr=array(5);
		if($this->admin_info['action_list']!='all')
		{
			$role_parent_arr=array(5);
		}

		$role_arr = array(11,14,16,19,20,23,26,27,28,34);
		foreach($articlecat as $key=>$value){
			
			if(in_array($value['id'],$cat_arr))
			{
			
				$href="javascript:void(0)";

			}else
			{
			   	$href=U('Article/index',array('cat_id'=>$value['id'],'prefix'=>$prefix));
			}

			if(in_array($value['id'],$role_parent_arr))
			{
			   
				$display="style='display:none'";
				//echo 1;exit;

			}else
			{
				$display="style=''";
			}
			$html.='<li class="" '.$display.'><a href="'.$href.'" target="container"><span class="folder">'.$value['name'].'</span></a>';
				if($value['cat_id']){
					$html.='<ul>';
					foreach($value['cat_id'] as $key2=>$value2){
						if($this->admin_info['action_list']!='all'){
						if(in_array($value2['id'],$role_arr))
						{
						$html.='<li class="closed"><a href="'.U('Article/index',array('cat_id'=>$value2['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value2['name'].'</span></a>';
							if($value2['cat_id']){
							$html.='<ul>';
								foreach($value2['cat_id'] as $key3=>$value3){
									$html.='<li class="closed"><a href="'.U('Article/index',array('cat_id'=>$value3['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value3['name'].'</span></a>';
										if($value3['cat_id']){
											$html.='<ul>';
											foreach($value3['cat_id'] as $key4=>$value4){
												$html.='<li class="closed"><a href="'.U('Article/index',array('cat_id'=>$value4['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value4['name'].'</span></a></li>';
											}
											$html.='</ul>';
										}
									$html.='</li>';
								}
								$html.='</ul>';
							}
						$html.='</li>';
						}
					  }else
					  {
					  		$html.='<li class="closed"><a href="'.U('Article/index',array('cat_id'=>$value2['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value2['name'].'</span></a>';
							if($value2['cat_id']){
							$html.='<ul>';
								foreach($value2['cat_id'] as $key3=>$value3){
									$html.='<li class="closed"><a href="'.U('Article/index',array('cat_id'=>$value3['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value3['name'].'</span></a>';
										if($value3['cat_id']){
											$html.='<ul>';
											foreach($value3['cat_id'] as $key4=>$value4){
												$html.='<li class="closed"><a href="'.U('Article/index',array('cat_id'=>$value4['id'],'prefix'=>$prefix)).'" target="container"><span class="folder">'.$value4['name'].'</span></a></li>';
											}
											$html.='</ul>';
										}
									$html.='</li>';
								}
								$html.='</ul>';
							}
						$html.='</li>';
					  }
					}
					$html.='</ul>';
				}
			$html.='</li>';
		}
		
		$this->assign("prefix",$prefix);
		$this->assign("html",$html);
		$this->assign("articlecat",$articlecat);
		$this->display();
    }

    public function index3($cat_id){
    	$this->list = M('articlecat')->field('cat_id,cat_name,sort_order')->where("parent_id=$cat_id")->order('sort_order asc,cat_id desc')->select();
    	//print_r(M('articlecat'));
    	$this->display();
    }
	
	/**
      +----------------------------------------------------------
     * ajax载入添加文章分类页面
      +----------------------------------------------------------
     */
	public function add(){
		/* 权限判断 */
	
		$cat_id=empty($_GET['cat_id'])?0:intval($_GET['cat_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$this->assign("cat_select", article_cat_list($prefix,0,$cat_id));
		$this->assign("prefix",$prefix);
		$this->display();
	}
	
	
	/**
      +----------------------------------------------------------
     * ajax载入修改文章分类页面
      +----------------------------------------------------------
     */
	public function edit(){
		/* 权限判断 */

		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$cat_id=empty($_GET['cat_id'])?0:intval($_GET['cat_id']);
		$M_Articlecat = M()->table($prefix."articlecat");

		$cat = $M_Articlecat->where("cat_id=".$cat_id)->find();
		$this->assign("cat", $cat);
		$this->assign("cat_id", $cat_id);
		
		$this->assign("cat_select", article_cat_list($prefix,0,$cat['parent_id']));
		$this->assign("prefix",$prefix);
		$this->display();
	}
	
	/**
      +----------------------------------------------------------
     * 添加文章分类
      +----------------------------------------------------------
     */
	public function insert(){
		/* 权限判断 */
		// $prefix = $this->_request('prefix', 'trim', 'tp_');
		$prefix =$_POST['prefix']?$_POST['prefix']:'tp_';
		$data = M()->table($prefix.'articlecat')->create();
        
		//分类图片
		if($_FILES['cat_img']['error']===0){
			$cat_img = "Uploads/articlecat/".date('YmdHis').'.'.pathinfo($_FILES['cat_img']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['cat_img']['tmp_name'], $cat_img);
			$data['cat_img'] = $cat_img; 
		}
		
		$M_Articlecat = M()->table($prefix.'articlecat');
			
		$insertId=$M_Articlecat->data($data)->add();
		// echo $M_Articlecat->_sql();die;
		if($insertId){
			parent::admin_log($_POST['cat_name'],'add','articlecat');
			$this->success('添加成功！！',U('Articlecat/add',array('cat_id'=>$data['parent_id'],'prefix'=>$prefix)));
		}else{
			$this->error('添加失败！！');
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 更新文章分类
      +----------------------------------------------------------
     */
	public function update(){
		/* 权限判断 */
		$cat_id   = intval($_POST['cat_id']);
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$data = M()->table($prefix.'articlecat')->create();
		unset($data['cat_id']);

		//分类图片
		if($_FILES['cat_img']['error']===0){
			$cat_img = "Uploads/articlecat/".date('YmdHis').'.'.pathinfo($_FILES['cat_img']['name'],PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['cat_img']['tmp_name'], $cat_img);
			$data['cat_img'] = $cat_img; 
		}
		
		$M_Articlecat = M()->table($prefix.'articlecat');
			
		$updateId=M()->table($prefix.'articlecat')->where(array('cat_id'=>$cat_id))->save($data);
		
		if($updateId){
			parent::admin_log($_POST['cat_name'],'edit','articlecat');
			$this->success('修改成功！！',U('Articlecat/edit',array('cat_id'=>$cat_id,'prefix'=>$prefix)));
		}else{
			$this->error('修改失败！！',U('Articlecat/edit',array('cat_id'=>$cat_id,'prefix'=>$prefix)));
		}
		exit();
	}
	/**
      +----------------------------------------------------------
     * 删除文章分类
      +----------------------------------------------------------
     */
	public function del() {
		/* 权限判断 */
		$prefix = $this->_request('prefix', 'trim', 'tp_');
		$M_Articlecat = M()->table($prefix."articlecat");
		$M_Article    = M()->table($prefix."article");
		$cat_id       = intval($_GET['cat_id']);
		
		$cat = $M_Articlecat->where("cat_id=".$cat_id)->find();
		$cat_type = $cat['cat_type'];
		if ($cat_type == 2 || $cat_type == 3 || $cat_type ==4){
			/* 系统保留分类，不能删除 */
			$this->error('系统保留分类，不能删除');
		}
		
		$countChildcat=$M_Articlecat->where(array('parent_id'=>$cat_id))->count();
		if ($countChildcat > 0){
			/* 还有子分类，不能删除 */
			$this->error('还有子分类，不能删除');
		}
		
		/* 非空的分类不允许删除 */
		$countArticle=$M_Article->where(array('cat_id'=>$cat_id))->count();
		if ($countArticle > 0)
		{
			$this->error('非空的分类不允许删除');
		}
		else
		{
			if (M()->table($prefix."articlecat")->where("cat_id=" . $cat_id)->delete()) {
				parent::admin_log($cat['cat_name'],'remove','articlecat');
				$this->success("成功删除");
			} else {
				$this->error("删除失败，可能是不存在该ID的记录");
			}
		}   
    }


	//校园生活（批量上传图片）
    public function batchimg($cat_id=0){
    	$this->cat_id = $cat_id;
    	$this->cat_list = $this->subCat(46);
    	$this->display();
    }

    public function insertSchoolImg(){
		$cat_id = $_POST['cat_id']+0;

		$ori_img = $_POST['ori_img'];
		$sort_id = $_POST['img_sort'];
		$title = $_POST['title'];

		foreach($ori_img as $k=>$v){
			$data = array(
				'cat_id'=>$cat_id,
				'title'=>$title[$k],
				'content' => "<img src='".__ROOT__.'/'.$v."'/>",
				'original_img'=>$v,
				'sort_order'=> $sort_id[$k]
			);
			M('article')->add($data);
		}
		$this->success('操作成功！');
	}

	public function delimg2(){
		$ori_img = $_GET['ori_img'];
		$thumb_img = $_GET['thumb_img'];
		@unlink($ori_img);
		@unlink($thumb_img);
	}
}