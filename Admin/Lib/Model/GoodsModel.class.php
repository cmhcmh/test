<?php

class GoodsModel extends Model {
	/**
      +----------------------------------------------------------
     * 文章列表
      +----------------------------------------------------------
     */
    public function listGoods($firstRow = 0, $listRows = 20 , $filter = array(), $prefix='tp_') {
       
		$M_Goods = M()->table($prefix."Goods");
		$where = '';
		if (!empty($filter['keyword']))
		{
			$where = " AND a.title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
		}
		if ($filter['cat_id'])
		{
			$where .= " AND a." . get_goods_children($prefix,$filter['cat_id']);
		}
		if ($filter['group_id'])
		{
			$where .= " AND a.group_id= '" . $filter['group_id']."'";
		}
		/* 获取文章数据 */
		if($prefix=='tp_'){
			$sql = 'SELECT a.*, ac.cat_name  '.
			   'FROM ' . C('DB_PREFIX') . 'goods AS a '.
			   'LEFT JOIN ' . C('DB_PREFIX') . 'goodscat AS ac ON ac.cat_id = a.cat_id '.
			   'WHERE 1 ' .$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'].',a.add_time desc'.
			   ' LIMIT '.$firstRow.','.$listRows;
		}else if($prefix=='en_'){
			$sql = 'SELECT a.*, ac.cat_name  '.
			   'FROM ' . $prefix . 'goods AS a '.
			   'LEFT JOIN ' . $prefix. 'goodscat AS ac ON ac.cat_id = a.cat_id '.
			   'WHERE 1 ' .$where. ' ORDER by '.$filter['sort_by'].' '.$filter['sort_order'].',a.add_time desc'.
			   ' LIMIT '.$firstRow.','.$listRows;
		}
		$result = $M_Goods->query($sql);
		
        return $result;
    }
	
	/**
      +----------------------------------------------------------
     * 文章总数
      +----------------------------------------------------------
     */
    public function listGoodsCount($filter = array(), $prefix='tp_') {
		$M_Goods = M()->table($prefix."Goods");
		$where = '';
		if (!empty($filter['keyword']))
		{
			$where = " AND a.title LIKE '%" . mysql_like_quote($filter['keyword']) . "%'";
		}
		if ($filter['cat_id'])
		{
			$where .= " AND a." . get_goods_children($prefix,$filter['cat_id']);
		}
		if ($filter['group_id'])
		{
			$where .= " AND a.group_id= '" . $filter['group_id']."'";
		}
       	if($prefix=='tp_'){
			$sql = 'SELECT COUNT(goods_id) AS count FROM ' . C('DB_PREFIX') . 'goods AS a '.
               'LEFT JOIN ' . C('DB_PREFIX') . 'goodscat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
		}else if($prefix='en_'){
			$sql = 'SELECT COUNT(goods_id) AS count FROM ' . $prefix. 'goods AS a '.
               'LEFT JOIN ' . $prefix. 'goodscat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where;
		}
		
        $count = $M_Goods->query($sql);

		return $count[0]['count'];
    }	

    public function getGroupId($filter = array(), $prefix='tp_') {
		$M_Goods = M()->table($prefix."Goods");
		$where = '';

		if ($filter['cat_id'])
		{
			$where .= " AND a." . get_goods_children($prefix,$filter['cat_id']);
		}
        $sql = 'SELECT a.group_id FROM ' .  $prefix . 'goods AS a '.
               'LEFT JOIN ' .  $prefix . 'goodscat AS ac ON ac.cat_id = a.cat_id '.
               'WHERE 1 ' .$where ." group by group_id";
		
        $count = $M_Goods->query($sql);

		return $count;
    }	
}

?>
