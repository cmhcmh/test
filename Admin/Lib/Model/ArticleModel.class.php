<?php

class ArticleModel extends Model {
	/**
      +----------------------------------------------------------
     * 文章列表
      +----------------------------------------------------------
     */
    public function listArticle($firstRow = 0, $listRows = 20 , $filter = array(),$prefix='tp_',$admin_info='') {
        
		$M_Article = M()->table($prefix.'Article');
		$where = '';
		if($admin_info && $admin_info['company_id']){
			$where.=' AND a.company_id='.$admin_info['company_id'];
		}
		if($admin_info && $admin_info['action_list']=='all'){
		   if (!empty($filter['company_id']))	
		   {
			 $where.=' AND a.company_id='.$filter['company_id'];
		   }
		}
		if (!empty($filter['keyword']))
		{
			$where = " AND a.title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
		}
		if ($filter['cat_id'])
		{
			$where .= " AND a." . get_article_children($prefix,$filter['cat_id']);
		}
		if ($filter['res'])
		{
			$where.=' AND a.is_res='.$filter['res'];
		}
		else
		{
			$where.=' AND a.is_res=0';
		}
		/* 获取文章数据 */
		if($prefix=='tp_'){
			$sql = 'SELECT a.article_id, a.cat_id, a.title, a.add_time, a.is_open, a.is_recommend,a.f_is_recommend, a.sort_order,a.f_sort_order,ac.cat_name ,a.original_img ,a.thumb_img,a.life,a.case,a.winning,a.is_show,a.is_del,a.style,a.layout,a.acreage,a.link,a.com_number,a.start_number,a.is_show,a.address,a.com_number,a.start_number,a.construct,a.be_hourse,a.be_design,a.special_style,a.obtain,a.grade,a.is_left,a.is_right,a.is_big,a.original_img_pc,co.c_name,ad.user_name,b.article_id as design_id,b.title as design_title,c.article_id as hourse_id,c.title as hourse_title '.
			   'FROM ' . C('DB_PREFIX') . 'article AS a '.
			   'LEFT JOIN ' . C('DB_PREFIX') . 'article AS  b  on b.article_id = a.be_design '.
			   'LEFT JOIN ' . C('DB_PREFIX') . 'article as  c  on c.article_id = a.be_hourse '.
			   'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
			   'LEFT JOIN ' . C('DB_PREFIX') . 'company As co ON co.c_id = a.company_id '.
			   'LEFT JOIN ' . C('DB_PREFIX') . 'admin_user As ad ON ad.user_id = a.uid '.
			   'WHERE 1 ' .$where. ' ORDER by is_show asc,is_recommend desc,'.$filter['sort_by'].' '.$filter['sort_order']. ',a.add_time desc' . 
			   ' LIMIT '.$firstRow.','.$listRows;
		}else if($prefix=='en_'){
			$sql = 'SELECT a.article_id, a.cat_id, a.title, a.add_time, a.is_open, a.is_recommend, a.sort_order, ac.cat_name ,a.original_img ,a.thumb_img '.
			   'FROM ' . $prefix . 'article AS a '.
			   'LEFT JOIN ' . $prefix. 'articlecat AS ac ON ac.cat_id = a.cat_id '.
			   'WHERE 1 ' .$where. ' ORDER by is_show asc,is_recommend desc,'.$filter['sort_by'].' '.$filter['sort_order']. ',a.add_time desc' . 
			   ' LIMIT '.$firstRow.','.$listRows;
		}

		//echo $sql;

		$result = $M_Article->query($sql);
		
        return $result;
    }
	
	/**
      +----------------------------------------------------------
     * 文章总数
      +----------------------------------------------------------
     */
    public function listArticleCount($filter = array(),$prefix='tp_',$admin_info='') {

		$M_Article = M()->table($prefix.'Article');
		$where = '';
		if (!empty($filter['keyword']))
		{
			$where = " AND a.title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
		}
		if ($filter['cat_id'])
		{
			$where .= " AND a." . get_article_children($prefix,$filter['cat_id']);
		}
			if ($filter['res'])
		{
			$where.=' AND a.is_res='.$filter['res'];
		}else
		{
			$where.=' AND a.is_res=0';
		}
		
		
		  //if (!empty($filter['company_id']))	
		 // {
			// $where.=' AND a.company_id='.$filter['company_id'];

		  //}
	    if($admin_info && $admin_info['company_id']){
			$where.=' AND a.company_id='.$admin_info['company_id'];
		}
		if($admin_info && $admin_info['action_list']=='all'){
		   if (!empty($filter['company_id']))	
		   {
			 $where.=' AND a.company_id='.$filter['company_id'];
		   }
		}
		
        if($prefix=='tp_'){
			$sql = 'SELECT COUNT(article_id) AS count FROM ' . C('DB_PREFIX') . 'article AS a '.
               'LEFT JOIN ' . C('DB_PREFIX') . 'articlecat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
		}else if($prefix=='en_'){
			$sql = 'SELECT COUNT(article_id) AS count FROM ' . $prefix. 'article AS a '.
               'LEFT JOIN ' .$prefix. 'articlecat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
		}
		
        $count = $M_Article->query($sql);

		return $count[0]['count'];
    }

    public function list_special_style_data($article_list)
    {
         foreach($article_list as $k=>$v)
         {
         	if(!empty($v['special_style'])){
         			$special_style_arr = json_decode($article_list[$k]['special_style'],true);

         			$special_style_ids = implode(',',$special_style_arr);
                    $comcatdata =M('comcat')->where("com_id in ($special_style_ids)")->select();
         			$special_style_data[$v['article_id']] =$comcatdata;
         	}

         }

         return $special_style_data;
    }	
}

?>
