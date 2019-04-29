<?php

class PrivilegeModel extends Model {
	/**
      +----------------------------------------------------------
     * 管理员列表
      +----------------------------------------------------------
     */
	function get_admin_userlist($filter)
	{
			$where = '';
		if (!empty($filter['c_name']))
		{
			$where.= " AND c.c_name LIKE '%" . mysql_like_quote($filter['c_name']) . "%'";
		}
			if (!empty($filter['user_name']))
		{
			$where.= " AND a.user_name LIKE '%" . mysql_like_quote($filter['user_name']) . "%'";
		}
		if (!empty($filter['company_id']))
		{
			$where.= " AND a.company_id=".$filter['company_id'];
		}
		//echo $where;exit;
	
		$list=M('Admin_user')->alias('a')->field('user_id,user_name,email,add_time,last_login,a.company_id,c.c_name,r.role_name')->order('user_id DESC')->join('tp_company c on a.company_id=c.c_id')->join('tp_role r on r.role_id=a.role_id')->limit($filter['firstRow'],$filter['listRows'])->where("1".$where)->select();
		return $list;
	}
	
	/**
      +----------------------------------------------------------
     * 获取角色列表
      +----------------------------------------------------------
     */
	function get_role_list()
	{
		$list=M('Role')->field('role_id, role_name, action_list,role_describe')->select();
		return $list;
	}

	function listPrivilegeCount($filter = array(),$prefix='tp_')
	{

		$where = '';
		if (!empty($filter['c_name']))
		{
			$where.= " AND c.c_name LIKE '%" . mysql_like_quote($filter['c_name']) . "%'";
		}
			if (!empty($filter['user_name']))
		{
			$where.= " AND a.user_name LIKE '%" . mysql_like_quote($filter['user_name']) . "%'";
		}
		if (!empty($filter['company_id']))
		{
			$where.= " AND a.company_id=".$filter['company_id'];
		}

		$count=M('Admin_user')->alias('a')->field('user_id,user_name,email,add_time,last_login,a.company_id,c.c_name,r.role_name')->order('user_id DESC')->join('tp_company c on a.company_id=c.c_id')->join('tp_role r on r.role_id=a.role_id')->where("1".$where)->count();
		return  $count;

	}

}

?>
