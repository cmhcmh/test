<?php
require_once('inc/config.php');
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:mobile.php");die();
}
header("Content-type: text/html; charset=utf-8");
@$id = $_GET['cid'];
@$city = '江苏活动PC下单';
@$name = $_POST['name'];
@$sex = $_POST['sex'];
@$tel = $_POST['tel'];
@$email = $_POST['email'];
@$lf = $_POST['lf'];
@$lp = $_POST['lp'];
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
@$content = '此订单为江苏活动PC版下单-'.$_POST['content'];
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
	$sql = "insert into `hx_dd` (city,name,sex,tel,email,lf,lp,y,m,d,s,t,w,mj,wc,sty,x,ys,pmt,content,addtime)values('$city','$name','$sex','$tel','$email','$lf','$lp','$y','$m','$d','$s','$t','$w','$mj','$wc','$sty','$x','$ys','$pmt','$content',".time().")";
	$r = mysql_query($sql,$conn);
	if($r){
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/jshd/'</script>";die();
	}
}elseif(@$_POST['action'] == 'add49'){
	if(strlen($name)<2){
		die("<script type=\"text/javascript\">alert('请输入姓名');history.go(-1);</script>");
	}
	if(strlen($tel)<11){
		die("<script type=\"text/javascript\">alert('请正确输入电话');history.go(-1);</script>");
	}
	$sql = "insert into `hx_yy` (gd,name,sex,tel,email,lp,mj,ys,content,addtime)values('$gd','$name','$sex','$tel','$email','$lp','$ys','$mj','$content',".time().")";
	$r = mysql_query($sql,$conn);
	if($r){
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/jshd/'</script>";die();
	}
}elseif(@$_POST['action'] == 'add50'){
	if(strlen($name)<2){
		die("<script type=\"text/javascript\">alert('请输入姓名');history.go(-1);</script>");
	}
	if(strlen($tel)<11){
		die("<script type=\"text/javascript\">alert('请正确输入电话');history.go(-1);</script>");
	}
	$sql = "insert into `hx_ts` (name,tel,email,title,content,addtime)values('$name','$tel','$email','$zt','$content',".time().")";
	$r = mysql_query($sql,$conn);
	if($r){
	echo "<script>alert('反馈成功，我们会第一时间做出处理，感谢您的支持！');location.href='/jshd/'</script>";die();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
    <meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
	
    <meta name="format-detection" content="telephone=no"/>
    <meta content="no-cache" http-equiv="pragma">
    <meta content="no-cache" http-equiv="cache-control">
	
    <meta content="0" http-equiv="expires">
    <title>华浔品味江苏大区保价跨年活动</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="keywords" content="">
	<meta name="description" content="华浔品味装饰是一家集装修、设计、施工服务于一体的大型装饰公司，专业从事家居、写字楼、商铺、酒店等的设计施工。咨询热线：400-040-2005">
	<head>
	
	</head>
	<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?88a019503e162d55df9e43518349582c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
	<style>
		body{ margin:0px auto; font-family: Arial, "微软雅黑";
    font-size: 14px;
    color: #666;
	    min-width: 1200px;
    overflow: auto;
	background-color:#D20000;
	}
body{margin:0;height:2000px;}
dl,dd,dt{margin:0;padding:0;}
a{ text-decoration:none;}

.floating_ck{position:fixed;right:20px;top:30%; z-index:999999;}
.floating_ck dl dd{position:relative;width:80px;height:80px;background-color:#646577;border-bottom:solid 1px #555666;text-align:center;background-repeat:no-repeat;background-position:center 20%;cursor:pointer;}
.floating_ck dl dd:hover{background-color:#e40231;border-bottom:solid 1px #a40324;}
.floating_ck dl dd:hover .floating_left{display:block;}
.consult,.words{background-image:url(images/icon0701/zxicon.png);}
.quote{background-image:url(images/icon0701/kficon.png);}
.qrcord{background-image:url(images/icon0701/erweima.png);}
.return{background-image:url(images/icon0701/fanhui.png);}
.floating_ck dd span{color:#fff;display:block;padding-top:54px;}
.floating_left{position:absolute;left:-160px;top:0px;width:160px;height:80px;background-color:#e40231;border-bottom:solid 1px #a40324;display:none;}
.floating_left a{color:#fff;line-height:80px;}
.floating_ewm{height:260px;top:-180px;}
.floating_ewm i{background-image:url(images/erweima.png);display:block;width:145px;height:145px;margin:auto;margin-top:7px;}
.floating_ewm p{color:#fff;margin-top:5px;}
.floating_ewm .qrcord_p01{font-size:12px;line-height:20px;}
.floating_ewm .qrcord_p02{font-size:18px;}
.bo_Box {
    display: none;
    position: relative;
    width: 737px;
    height: 444px;
    background: #fff;
    padding: 30px 0px;
    position: fixed;
    z-index: 9999999;
    top: 50%;
    left: 50%;
    margin-left: -368.5px;
    margin-top: -282px;
}
.item1 .bo_title {
    margin-bottom: 20px;
}
.bo_Box .bo_title {
    color: #000;
    width: 225px;
    height: 58px;
    border-bottom: 5px solid #d16c15;
    margin: 0 auto;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
}
.bo_form .mx {
    overflow: hidden;
    text-align: center;
    margin-bottom: 20px;
}
.bo_form .mx label {
    display: inline-block;
    font-size: 16px;
    color: #666666;
    line-height: 30px;
    height: 30px;
}
.bo_form .mx label i {
    color: #fb2d2d;
    line-height: 30px;
}
#province_tan, #city_tan {
    background: url(../images/slese.jpg) 110px 10px no-repeat;
    cursor: pointer;
    width: 140px;
    height: 30px;
    line-height: 30px;
    color: #000;
    border: 1px solid #e1e1e1;
    font-size: 14px;
    padding-left: 15px;
}
.bo_form .submit {
    background: #333333;
    width: 260px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    color: #fff;
    font-size: 18px;
    margin: 0 auto;
    display: block;
}
.bo_Box .close {
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
}
.bo_form .mx input {
    height: 30px;
    line-height: 30px;
    border: 1px solid #e1e1e1;
    display: inline-block;
    width: 260px;
    padding: 0 10px;
}
.bo_form .mx {
    overflow: hidden;
    text-align: center;
    margin-bottom: 20px;
}
.newForm input{display:block; width:730px; padding-left:20px; height:100px; line-height:100px; border-radius:40px; background:none; border:3px solid #fff; outline:none; margin-bottom:30px; font-size:36px; font-family:微软雅黑; color:#fff;}
input::-webkit-input-placeholder { /* WebKit browsers */  
  color: white;  
}  
input:-moz-placeholder { /* Mozilla Firefox 4 to 18 */  
  color: white;  
}  
input::-moz-placeholder { /* Mozilla Firefox 19+ */  
  color: white;  
}  
input:-ms-input-placeholder { /* Internet Explorer 10+ */  
  color: white;  
}  
.wz{margin-top:220px; width:1000px;}
.wz p {color:#fff;font-family:Microsoft YaHei!important;font-size:25px; font-weight:normal;text-align:left;}
.wz p a{color:#fff;font-family:Microsoft YaHei!important;font-size:25px;line-height:40px;font-weight:normal; margin:8px 11px 8px 11px;}
</style>

<script type="text/javascript" src="js/top.js"></script>
<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/jquery.dotdotdot.js"></script>
<script type="text/javascript" src="js/jquery.SuperSlide.2.1.1.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/layer.js"></script>
<script type="text/javascript" src="js/jquery.countup.min.js"></script>
<script src="js/wow.min.js"></script>


	<body >
		<div class="item1 bo_Box">
		<div class="bo_title">在线下单</div>
		<div class="bo_form">
			<form id="form_tan" action="#" method="post">

				<div class="mx" style="margin-top:5%;">
					<label><i>* </i>楼盘名字：</label>
					<input type="text"  name="lp" id="userName2" value="" placeholder="请输入您的楼盘名称">
				</div>
				<div class="mx">
					<label><i>* </i>您的名字：</label>
					<input type="tel"  name="name" id="userName" value="" placeholder="请输入您的姓名">
				</div>
				<div class="mx">
					<label><i>* </i>联系电话：</label>
					<input type="tel"  name="tel" id="mobile" maxlength="11" value="" placeholder="请输入您的手机号码">
				</div>
				 <div class="mx" style="padding-left: 187px;">
				 <label style="float: left;"><i>* </i>验 证 码：</label>

				<input type="text" class="text text2" placeholder="验证码" name="code" id="verify_tan" style="width:150px;float: left;">
				<div class="yzm"><img style="float: left;margin: 5px; width:110px;" src="code.php" onclick="this.src+='?rand='+Math.random();" id="tan_imgverify"></div>
           
                  </div>
					<input type="hidden" name="action" value="add47" />
                     <input type="hidden" name="company_id" value="0">
                            <input type="hidden" name="type" value="1" id="type_tan">
                   <p class="mx"><font style="text-align: center;" color="red" size="-1" id="cmresult_tan"></font></p>
				<input type="submit" name="submit" class="submit" value="立即提交" onclick="">
			</form>
		</div>

		<div class="close"><img src="images/bo_close.jpg"></div>
		<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1263522543'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s13.cnzz.com/z_stat.php%3Fid%3D1263522543%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script><span id="cnzz_stat_icon_1263522543"><a href="http://www.cnzz.com/stat/website.php?web_id=1263522543" target="_blank" title="站长统计"><img border="0" hspace="0" vspace="0" src="http://icon.cnzz.com/img/pic.gif"></a></span><script src=" http://s13.cnzz.com/z_stat.php?id=1263522543&amp;show=pic" type="text/javascript"></script><script src="http://c.cnzz.com/core.php?web_id=1263522543&amp;show=pic&amp;t=z" charset="utf-8" type="text/javascript"></script>

		  <script type="text/javascript">
                /****提交表单************/
                function mySubmit_tan(theForm,url,result){
                    var province_id=$('#province_tan').val();
                    var city_id=$('#city_tan').val();
                    var name=$('#name_tan').val();
                    var mobile=$('#mobile_tan').val();
                    var verify=$('#verify_tan').val();
                    var hourse=$('#hourse_tan').val();

                    if(province_id==''){

                         layer.msg('请选择省份');
                        return false;
                    }
                     if(city_id==0){

                        layer.msg('请选择城市');
                        return false;
                    }
                      if(hourse==''){

                        layer.msg('请填写楼盘');
                        return false;
                    }
                        if(name==''){
                         layer.msg('请填写姓名');
                        return false;
                    }
                        if(mobile==''){
                         layer.msg('请填写手机');
                        return false;
                    }
                   
                       if(verify==''){

                        layer.msg('请填写验证码');
                        return false;
                    }
        
                    //$('#form').submit();
                    function default_callback(res){
                        
                        if(res.status=='1'){
                            //document.getElementById(theForm).reset();

                        layer.msg('留言提交成功');
                            location.reload();
                            document.getElementById(theForm).reset();


                        }else{
                            result.html(res.info);
                        }
                    }

                    var callback = arguments[3] || default_callback;

                    var result = $('#'+result);
                    result.html('loading...');
                    var data = $('#'+theForm).serialize();//2014/10/07更新

                    $.post(url,data,callback,'json');
                    return false;
                }

                       /****提交表单************/
                function mySubmit_tan2(theForm,url,result){
                    var province_id=$('#province_tan2').val();
                    var city_id=$('#city_tan2').val();
                    var name=$('#name_tan2').val();
                    var mobile=$('#mobile_tan2').val();
                    var verify=$('#verify_tan2').val();
                    var hourse=$('#hourse_tan2').val();

                    if(province_id==''){

                         layer.msg('请选择省份');
                        return false;
                    }
                     if(city_id==0){

                        layer.msg('请选择城市');
                        return false;
                    }
                      if(hourse==''){

                        layer.msg('请填写楼盘');
                        return false;
                    }
                        if(name==''){
                         layer.msg('请填写姓名');
                        return false;
                    }
                        if(mobile==''){
                         layer.msg('请填写手机');
                        return false;
                    }
                   
                       if(verify==''){

                        layer.msg('请填写验证码');
                        return false;
                    }
        
                    //$('#form').submit();
                    function default_callback(res){
                        
                        if(res.status=='1'){
                            //document.getElementById(theForm).reset();

                        layer.msg('留言提交成功');
                            location.reload();
                            document.getElementById(theForm).reset();


                        }else{
                            result.html(res.info);
                        }
                    }

                    var callback = arguments[3] || default_callback;

                    var result = $('#'+result);
                    result.html('loading...');
                    var data = $('#'+theForm).serialize();//2014/10/07更新

                    $.post(url,data,callback,'json');
                    return false;
                }


            </script>
			<script type="text/javascript">
		$(function(){
			// 2017-10-17波

			$('.close').click(function(){
				$('.bo_Box,.bo_fide').hide()
			})

			$('.boPro').click(function(){
				$('.item0,.bo_fide').show()
				return false
			})
			$('.boOrder').click(function(){
				$('.item1,.bo_fide').show()
				return false
			})

		    })
	</script>
		<script type="text/javascript">
		function design_order(design_name)
		{
			$('.item1,.bo_fide').show();
			$('.bo_title').html('预约装修');
			$('#type_tan').val(2);
			$('#design_new').val(design_name);
				$('#design_name_tan').val(design_name);
			$('#design_div').show();
		}

	    function order_show(hourse_name)
		{
			if(hourse_name)
			{
				$('.item1,.bo_fide').show();
				$('.bo_title').html('在线下单');
				$('#type_tan').val(1);
				$('#hourse_tan').val(hourse_name);

			}else{

				$('.item1,.bo_fide').show();
				$('.bo_title').html('在线下单');
				$('#type_tan').val(1);
				$('#design_new').val('');
				$('#design_name_tan').val('');
				$('#design_div').hide();
			}
		}
	</script>


	</div>
		<div class="floating_ck">
			<dl>
				<dt></dt>
				<dd class="consult">
					<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2547410506&site=qq&menu=yes"><span>在线咨询</span></a>
					<div class="floating_left"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2547410506&site=qq&menu=yes">QQ在线咨询</a></div>
				</dd>
				<dd class="quote">
					<a href="#" onclick="order_show();"><span>获取报价</span></a>
					<div class="floating_left"><a href="#" onclick="order_show();">立即获取报价</a></div>
				</dd>
				<dd class="qrcord">
					<span>扫一扫</span>
					<div class="floating_left floating_ewm">
						<i></i>
						<p class="qrcord_p01">扫一扫<br>获取更多活动详情</p>
						<p class="qrcord_p02">全国免费服务热线<br><b>400-040-2005<b></p>
					</div>
				</dd>
				<dd class="return">
					<span onClick="gotoTop();return false;">返回顶部</span>
				</dd>
			</dl>
		</div>	
		<div style="margin-left:auto; margin-right:auto; width:100%;text-align:center;">
			<div style="width:1200px; margin:0 auto; position:relative">
			<img src="images/123.jpg" style="width:100%; margin:0px auto; text-align:center;" align="center" />
			<div style="position:absolute; z-index:10; top:5980px; left:110px; height:940px;">
				<form action="#" method="post">
					<div style="margin-top:450px;" class="newForm">
						<input type="text" name="name" placeholder="请输入您的称呼"/>
						<div>
						<input style="width:300px; float:left;" type="tel" name="tel" maxlength="11" placeholder="请输入您的电话"/>
						<input style="width:140px; float:left;" type="text" name="code"  placeholder="验证码"/><img style="float: left;margin: 5px; width:270px;" src="code.php" onclick="this.src+='?rand='+Math.random();" id="tan_imgverify">
						</div>
						<input type="text"  name="lp" placeholder="请输入您的楼盘名称"/>
						<input type="hidden" name="action" value="add47" />
                     <input type="hidden" name="company_id" value="0">
                            <input type="hidden" name="type" value="1" id="type_tan">
					</div>
					<input type="submit" value="" style="position:absolute; top:0;display:block;width:270px;height:270px; left:50%;margin-left:-40px; cursor:pointer; border:none;background:none;" />
				</form>
				<div class="wz">
				<p>华东25联动火爆进行中：</p>
				<p style="text-indent:2em;">
					<a target="_blank" href="http://wuxi.hxdec.com">无锡</a>
					<a target="_blank" href="http://nj.hxdec.com">南京</a>
					<a target="_blank" href="http://tzs.hxdec.com">泰州</a>
					<a target="_blank" href="http://jt.hxdec.com">金坛</a>
					<a target="_blank" href="http://yz.hxdec.com">扬州</a>
					<a target="_blank" href="http://wjq.hxdec.com">吴江</a>
					<a target="_blank" href="http://txs.hxdec.com">泰兴</a>
					<a target="_blank" href="http://ha.hxdec.com">淮安</a>
					<a target="_blank" href="http://yx.hxdec.com">宜兴</a>
					<a target="_blank" href="http://jys.hxdec.com">江阴</a>
					<a target="_blank" href="http://jr.hxdec.com">句容</a>
					<a target="_blank" href="http://zj.hxdec.com">镇江</a>
					<a target="_blank" href="http://lyg.hxdec.com">连云港</a>
					<a target="_blank" href="http://li.hxdec.com">溧阳</a>
					<a target="_blank" href="http://dys.hxdec.com">丹阳</a>
					<a target="_blank" href="http://xz.hxdec.com">徐州</a>
					<a target="_blank" href="http://lsq.hxdec.com">溧水</a>
					<a target="_blank" href="http://nt.hxdec.com">南通</a>
					<a target="_blank" href="http://rgs.hxdec.com">如皋</a>
					<a target="_blank" href="http://jdq.hxdec.com">江都</a>
					<a target="_blank" href="http://zjg.hxdec.com">张家港</a>
					<a target="_blank" href="http://jjs.hxdec.com">靖江</a>
					<a target="_blank" href="http://tc.hxdec.com">太仓</a>
					<a target="_blank" href="http://ycs.hxdec.com">盐城</a>
					<a target="_blank" href="http://jd.hxdec.com">上海嘉定</a>
				</p>
			</div>
			</div>
			
			</div>
		</div>
		<div style="margin:0px auto; max-width:1920px; width:1200px; line-height:60px; font-size:16px;">
			<p style="text-align:center;">
				华浔品味装饰集团有限公司版权所有  ICP备案号:粤ICP备15089103号-1
			</p>
		</div>
		
		
	</body>
</html>
