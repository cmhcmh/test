<?php
require_once('config.php');
$lp = $_GET['loupan'];
$name = $_GET['name'];
$tel = $_GET['phone'];
$action = $_GET['action'];

@$city = '品牌实力WAP版';
@$content = '品牌实力WAP版';
@$ip = $_SERVER['REMOTE_ADDR'];
if(@$action == 'messageadd'){
$sql = "INSERT INTO `tp_message`(`id`, `type`, `name`, `tel`, `content`, `add_time`, `ip`, `hourse`, `is_show`, `company_id`, `be_company_id`, `design_name`, `province_id`, `city_id`, `district_id`, `nums`, `address`, `is_equ`, `is_handle`, `qx`) VALUES ('','1','$name','$tel','$content',".time().",'$ip','$lp','0','0','0',' ','19','234','0','0',' ','2','0','0')";
	$r = mysql_query($sql,$conn);
	if($r){
	//	var_dump($sql);
	//echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/gy/'</script>";die();
	}else{
	//	var_dump($sql);
	//	exit();
	}
}
?>