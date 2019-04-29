<?php
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '全国活动手机版3.26-4.22';
@$name = $_POST['name'];
@$sex = $_POST['sex'];
@$tel = $_POST['mobile'];
@$email = $_POST['email'];
@$lf = $_POST['lf'];
@$lp = $_POST['hourse'];
@$y = $_POST['y'];
@$m = $_POST['m'];
@$d = $_POST['d'];
@$s = $_POST['s'];
@$t = $_POST['t'];
@$w = $_POST['w'];
@$mj = $_POST['mj'];
@$wc = $_POST['wc'];
@$sty = $_POST['sty'];
@$x = $_POST['x'];
@$ys = $_POST['ys'];
@$zt  = $_POST['zt'];
@$pmt = $_POST['pmt'];
@$gd = $_POST['gd'];
@$code = $_POST['code'];
@$content = '全国活动手机版3.26-4.22'.$_POST['content'];
@$ip = $_SERVER['REMOTE_ADDR'];
if(@$_POST['action'] == 'add47'){

	if($code != $_SESSION['mcode']){
		die("<script type=\"text/javascript\">alert('请正确的验证码');history.go(-1);</script>");
	}
	if(strlen($name)<2){
		die("<script type=\"text/javascript\">alert('请输入姓名');history.go(-1);</script>");
	}
	if(strlen($tel)<11){
		die("<script type=\"text/javascript\">alert('请正确输入电话');history.go(-1);</script>");
	}
	/*$sql = "insert into `tp_message` (city,name,sex,tel,email,lf,lp,y,m,d,s,t,w,mj,wc,sty,x,ys,pmt,content,addtime)values('$city','$name','$sex','$tel','$email','$lf','$lp','$y','$m','$d','$s','$t','$w','$mj','$wc','$sty','$x','$ys','$pmt','$content',".time().")";
	$sql = "insert into `tp_message` (id,tpye,name,tel,content,addtime,ip,hourse,is_show,company_id,be_company_id,is_equ)values('',1,'$name','$tel','$content',".time().",'$ip','$lp','0','0','0','1')";*/
	$sql = "INSERT INTO `tp_message`(`id`, `type`, `name`, `tel`, `content`, `add_time`, `ip`, `hourse`, `is_show`, `company_id`, `be_company_id`, `design_name`, `province_id`, `city_id`, `district_id`, `nums`, `address`, `is_equ`, `is_handle`, `qx`) VALUES ('','1','$name','$tel','$content',".time().",'$ip','$lp','0','0','0',' ','19','234','0','0',' ','1','0','0')";
	$r = mysql_query($sql,$conn);
	if($r){
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/hzzt/mobile'</script>";die();
	}else{
		var_dump($sql);
		exit();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="format-detection" content="telephone=no, email=no" />
	<link href="css/swiper-3.4.1.min.css" type="text/css" rel="stylesheet" />
	<link href="css/style.css" type="text/css" rel="stylesheet" />
    <title>华浔装饰集团20年质造，百城春装会 </title>
    <meta name='keywords' content=""/>
<meta name='description' content=""/>
    <script src="js/jquery.js"></script>
     <script src="js/layer.js"></script>
	 <style>
	 *{padding:0;margin:0;}
	 input {
		    -webkit-appearance: textfield;
    background-color: white;
    -webkit-rtl-ordering: logical;
    -webkit-user-select: text;
    cursor: auto;
    padding: 1px;
    border-width: 2px;
    border-style: inset;
    border-color: initial;
    border-image: initial;
	width: 90%; padding:0.155rem;font-size:0.272rem; background: #fff; color: #333;
	border: 0;
	margin:10px 0.3rem;
	 font-family: "微软雅黑";
	}
	* {
    margin: 0;
    padding: 0;
    border: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
	 </style>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?88a019503e162d55df9e43518349582c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>

<script type="text/javascript" src="js/d7a1262ccb014ec48576a00b960fa165.js"></script>
<body data-psd-width="750">
<div class="content">
	<div class="con">
		<div style="width:100%;">
			<img style="width:100%;" src="images/1.jpg"/>
		</div>
		<div style="background:#E8302B;width:100%; margin:0 auto;">
			<form action="#" method="post">
			<ul style="margin:0 auto;">
			<input type="hidden"  name="action" value="add47">
				<li><input class="inputText" type="text" name="hourse" id="userName2" value="" placeholder="请输入您的楼盘名称"></li>
				<li><input class="inputText" type="text" name="name" id="userName2" value="" placeholder="请输入您的名字"></li>
				<li><input class="inputText" type="text" name="mobile" id="userName2" value="" placeholder="请输入您的手机号"></li>
				<li><input class="inputText" style="width:55%;float:left;" type="text" name="code" id="userName2" value="" placeholder="请输入验证码" ><div class="yzm"><img style="float: left;margin: 5px;width:25%;" src="code.php" onclick="this.src+='?rand='+Math.random();" id="tan_imgverify"></div>   
				</li>
				<li><input class="inputText" type="submit" style="color:#fff; background:#FA8950; font-size:0.4rem;" value="立即预约"></li>
			</ul>
			<p style="color:#fff; text-align:center;line-height:0.42rem; padding:0.3rem 0;">我们承诺：您所填写的信息将被严格保密，请放心填写!</p>
			</form>
		</div>
		<div style="width:100%;position:relative;">
			<img style="width:100%;" src="images/02.png"/>
			<div style="width:25%; height:192px;position:absolute; right:0px; bottom:-115px;"><img style="width:100%;" src="images/03.png"/></div>
		</div>
		<div style="width:100%;">
			<div style="margin:0px auto;background:url(images/hz033.png) no-repeat center top; background-size:100%;width:90%;  height:100%;">
				<ul style="width:100%; display:block; padding-top:9%; padding-bottom:5%;padding-left:2%;">
					<a href="http://www.hxdec.com/mobile.php/Case/detail/id/13915"><li style="width:45%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/hzal05.png" style="width:98%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Case/detail/id/13952"><li style="width:45%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/hzal03.png" style="width:98%;"/></li></a>
					<div class="clear"></div>
					<a href="http://www.hxdec.com/mobile.php/Case/detail/id/13955"><li style="width:45%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/hzal12.png" style="width:98%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Case/detail/id/13916"><li style="width:45%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/hzal09.png" style="width:98%;"/></li></a>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div style="width:100%; margin-bottom:6%;margin-top:6%;position: relative; z-index:99;">
			<div style="margin:0px auto;background:url(images/hz007.png) no-repeat center top; background-size:100%;width:90%;  height:100%;padding-bottom:15%;">
				<ul style="width:100%; display:block;  padding-left:0%;">
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/2450"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_11.png" style="width:99%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/475"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_13.png" style="width:99%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/3547"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_15.png" style="width:99%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/1014"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_17.png" style="width:99%;"/></li></a>
					<div class="clear"></div>
				</ul>
				<ul style="width:100%; display:block;  padding-left:0%;">
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/1689"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_29.png" style="width:99%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/1303"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_31.png" style="width:99%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/2622"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_33.png" style="width:99%;"/></li></a>
					<a href="http://www.hxdec.com/mobile.php/Design/detail/id/428"><li style="width:21%; display:block; float:left; margin:2%; overflow: hidden;"><img src="images/全国站手机、_35.png" style="width:99%;"/></li></a>
					<div class="clear"></div>
				</ul>
				<div style="background:#F92424; color:#fff;font-size:0.01rem;width:95%; margin:0px auto; line-height:0.6rem;">
					<p><font style="font-weight:bold;font-size:0.3rem; text-align:center;">设计师团队</font>汇聚行业顶级设计人才，全心全意为客户服务</p>
				</div>
			</div>
		</div>
		<div style="width:100%;position:relative;">
			<div style="width:100%; height:192px;position:absolute;bottom:0px; z-index:2;"><img style="width:100%;" src="images/hzdb.png"/></div>
		</div>
	</div>
 	<div class="footer">
 		<p>Copyright © 2018华浔品味装饰 版权所有（粤ICP备15089103号-1）</p>
 	</div>
 
	<div class="go_top"></div>
	<div class="footer_href box">
		<a href="tel:4000402005" class="flex1" onclick="return confirm('当前号码：4000402005');">
		
			<i></i><span>电话预约</span>
		</a>
		<a href="/mobile.php/Contact/index/type/1" class="flex1">
			<i></i><span>装修报价</span>
		</a>

</div>

</body>
</html>

<script src="js/rem.js"></script>
<script src="js/fastclick.js"></script>
<script src="js/swiper-3.4.1.jquery.min.js"></script>
<script src="js/js.js"></script>

<script src="js/jquery.lazyload.min.js"></script>
<script>
	//单独页面上的js
	$(function(){
		// $(".lazy_img").lazyload({ effect: "fadeIn" });
	})
</script>