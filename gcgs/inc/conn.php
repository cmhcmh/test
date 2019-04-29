<?php

$mysql_server_name = 'rm-wz92k2k59v0c5kqp9do.mysql.rds.aliyuncs.com';

$mysql_username = 'hxdec';

$mysql_password = 'Huaxun123';

$mysql_database='huaxunpwdb';  



@$conn = mysql_connect($mysql_server_name,$mysql_username,$mysql_password);



mysql_query("set character set 'utf8'");//读库  

mysql_query("set names 'utf8'");//写库

if(!$conn){ 

die("could not connect to the database:</br>".mysql_error());//诊断连接错误 

} 

$db_select = mysql_select_db($mysql_database,$conn);//选择数据库

if(!$db_select) 

{ 

die("could not to the database</br>".mysql_error()); 

} 



?>