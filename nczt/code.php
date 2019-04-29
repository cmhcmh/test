<?php
/**
 * $Author:   EDUCMS
 * $Contacts: h_h_q072@qq.com
 * ============================================================================
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

include('code.class.php');
$code=new code(68,24);
$code->out_img();
for($i=1;$i<=4;$i++){
	$code_str.=$code->code_str[$i];
}
session_start();
$_SESSION['mcode']=$code_str;
?>
