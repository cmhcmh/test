<?php
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("Location:http://wuxi.hxdec.com/mobile.php");die();
}
?>