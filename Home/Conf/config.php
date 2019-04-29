<?php

$config_arr1 = include_once WEB_ROOT . 'Common/config.php';
$config_arr2 = array(
	'SHOW_PAGE_TRACE'=>false,
	'TMPL_PARSE_STRING'=>array(
		'__IMG__'=>__ROOT__.'/Public/Home/images',
		'__JS__'=>__ROOT__.'/Public/Home/script',
		'__CSS__'=>__ROOT__.'/Public/Home/style',
	),
    'OUTPUT_ENCODE'=>true,
    //'URL_HTML_SUFFIX'=>'html',//伪静态
    //'URL_PATHINFO_DEPR'=>'-',//  连接符号目前用的是斜杠
    'URL_MODEL' => 2,//URL重写 隐藏index.php用
	/* 'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES'=>array(      
		'news/:cat_id'  => 'News/index/',
	), */ 
	
);
return array_merge($config_arr1, $config_arr2);
?>