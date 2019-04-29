<?php
require_once('inc/config.php');

header("Content-type: text/html; charset=utf-8");
@$id = $_GET['cid'];
@$city = '东莞11月活动手机下单';
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



@$content = '此订单为东莞活动手机版下单-'.$_POST['content'];
if(@$_POST['action'] == 'add47'){
	
	/*$search ='/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/';
	if(preg_match($search,$tel)) {
	 $tel = $tel;
	}else {
	 die("<script type=\"text/javascript\">alert('请正确输入电话');history.go(-1);</script>");
	}*/
	if(strlen($name)<2){
		die("<script type=\"text/javascript\">alert('请输入姓名');history.go(-1);</script>");
	}
	if(strlen($tel)<11){
		die("<script type=\"text/javascript\">alert('请正确输入电话');history.go(-1);</script>");
	}
	$sql = "insert into `hx_dd` (city,name,sex,tel,email,lf,lp,y,m,d,s,t,w,mj,wc,sty,x,ys,pmt,content,addtime)values('$city','$name','$sex','$tel','$email','$lf','$lp','$y','$m','$d','$s','$t','$w','$mj','$wc','$sty','$x','$ys','$pmt','$content',".time().")";
	$r = mysql_query($sql,$conn);
	if($r){
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/zt/'</script>";die();
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
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/zt/'</script>";die();
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
	echo "<script>alert('反馈成功，我们会第一时间做出处理，感谢您的支持！');location.href='/zt/'</script>";die();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta name="format-detection" content="telephone=no"/>
    <meta content="no-cache" http-equiv="pragma">
    <meta content="no-cache" http-equiv="cache-control">
    <meta content="0" http-equiv="expires">
    <title>东莞华浔品味装饰官网-东莞装修设计施工一体化装饰企业</title>
    <link href="css/css.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/cookie.utils.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
	    var appId = "wxc40035fad27cf9f4";
		var timestamp = "1510192877";
		var nonceStr = "3EF815416F";
		var signature = "d74c7300dce9e0135100bcef6a25be5660c581d7";
    </script>
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta name="keywords" content="东莞装修公司,东莞装饰公司,东莞装修,东莞装饰,东莞别墅装修,东莞旧房翻新,东莞家装公司,东莞装修设计公司,东莞华浔,东莞华浔品味装饰">
	<meta name="description" content="东莞华浔品味装饰是一家集装修、设计、施工服务于一体的大型装饰公司，专业从事家居、写字楼、商铺、酒店等的设计施工。咨询热线：400-040-2005">
	<link type="text/css" rel="stylesheet" href="css/activity.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?88a019503e162d55df9e43518349582c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script>
	$(function () {
        var reservation = function(userName, mobile, areaCode) {
			if (userName == null || userName == '') {
				error('请填写姓名');
				return;
			}
			if (mobile == null || mobile == '') {
				error('请填写手机号')
				return;
			}
			var mobeilReg = /^1[3|4|5|7|8][0-9]\d{8}$/;
			if (!mobeilReg.test(mobile)) {
				error('请填写正确的手机号')
				return;
			}
			$.ajax({
				url : "/",
				type : "post",
				dataType : "json",
				async : false,
				cache : false,
				data : {
					userName : userName,
					mobile : mobile,
					areaCode : areaCode
				},
				success : function(data) {
					if (data && (data.result == 0)) {
                        //成功
                        window.location.href = '/'
                                + data.ordersNo;
                    } else {
                        error(data.msg);
                    }
				}
			})
		};
        
		$('#submitBtn').click(
			function() {
				reservation($('#userName').val(), $('#mobile').val(), $('#areaCode').val());
		});
		
		$('#submitBtn1').click(
			function() {
				reservation($('#userName1').val(), $('#mobile1').val(), $('#areaCode1').val());
		});
		
		$('#submitBtn2').click(
			function() {
				reservation($('#userName2').val(), $('#mobile2').val(), $('#areaCode2').val());
		});
		
	})
</script>


</head>
<body>
<div style="margin:0 auto; width:0px; height:0px; overflow:hidden;">
	<img src="http://dg.hxdec.com.cn/zt/images/logo_samll.jpg" width='300'/>
</div>
	

<div class="actCon">
        <img src="images/img_01_01.jpg" alt="10获取装修报价，华浔专享">
    
        <div class="order">
            <div class="orderName">已有<span>
			<?php 
				$sqll="SELECT COUNT(id) AS `num` FROM `hx_dd` WHERE `tel` != ''";
				$r = mysql_query($sqll,$conn);
				mysql_num_rows($r);
				$rs=mysql_fetch_array($r);
				echo $rs[0]+2048;
			?></span>人预约免费报价服务</div>
			<form action="#" method="post" >
            <div class="orderBox">
                <div>
				 <p>
                        <label>楼盘</label>
                        <input class="inputText" type="text" name="lp" id="userName2" value="" placeholder="请输入您的楼盘名称">
                    </p>
                    <p>
                        <label>姓名</label>
                        <input class="inputText" type="text" name="name" id="userName" value="" placeholder="请输入您的姓名"></p>
                    <p>
                        <label>手机</label>
                        <input class="inputText" type="tel" name="tel" id="mobile" maxlength="11" value="" placeholder="请输入您的手机号码">
                    </p>
                    <p>
                        <label>&nbsp;</label>
						<input type="hidden" name="action" value="add47" />
                        <button class="orderBtn" type="submit" id="submitBtn">一键获取</button>
                    </p>
                </div>
            </div>
			</form>
        </div>
		<div class="fgdiv">
		<img src="images/img_02_01_01.jpg">
			<div class="img-box"><a href="http://dg.hxdec.com/mobile.php/Case/index/style_id/4/layout_id/0/acreage_id/0"><img src="images/img_02_02.jpg"></a></div>
			<div class="img-box"><a href="http://dg.hxdec.com/mobile.php/Case/index/style_id/1/layout_id/0/acreage_id/0"><img src="images/img_02_04.jpg"></a></div>
			<div class="img-box"><a href="http://dg.hxdec.com/mobile.php/Case/index/style_id/2/layout_id/0/acreage_id/0"><img src="images/img_02_03.jpg"></a></div>
			<div class="img-box"><a href="http://dg.hxdec.com/mobile.php/Case/index/style_id/51/layout_id/0/acreage_id/0"><img src="images/img_02_05.jpg"></a></div>
			<div class="clear"></div>
		</div>
        <img src="images/img_03.jpg">
        <img src="images/img_04.jpg">
       <!-- <img src="images/img_05.jpg">
        <img src="images/img_06.jpg">
       
        <img src="images/img_08.jpg">
        <img src="images/img_09.jpg">
        <img src="images/img_10.jpg">
        <img src="images/img_11.jpg">
        <img src="images/img_12.jpg">
        <img src="images/img_13.png">-->
        <img src="images/img_14.png">
        <img src="images/img_15.jpg">
        <img src="images/img_16.jpg">
        
        <img src="images/img_18.jpg">
        <img src="images/img_19.jpg">
        
        <img src="images/img_21.png">
        <div class="order order3">
            <div class="orderBox">
			<form action="#" method="post" >
                <div>
                    <p>
                        <label>楼盘</label>
                        <input class="inputText" type="text" name="lp" id="userName2" value="" placeholder="请输入您的楼盘名称">
                    </p>
                    <p>
                        <label>姓名</label>
                        <input class="inputText" type="text" name="name" id="userName" value="" placeholder="请输入您的姓名"></p>
                    <p>
                        <label>手机</label>
                        <input class="inputText" type="tel" name="tel" id="mobile" maxlength="11" value="" placeholder="请输入您的手机号码">
                    </p>
                    <p>
                        <label>&nbsp;</label>
						<input type="hidden" name="action" value="add47" />
                        <button class="orderBtn" type="submit" id="submitBtn">一键获取</button>
                    </p>
                </div>
			</form>
            </div>
        </div>
        <img src="images/img_22.png" alt="总部地址：广州市黄埔区黄埔东路1080号万科黄埔仓13楼">
        <p class="company">华浔品味装饰集团有限公司版权所有</p>
    </div>
    <div class="footer_href box">
			<a href="tel:4000402005" class="flex1">
				<i></i><span>电话预约</span>
			</a>
			<a href="http://wpa.qq.com/msgrd?v=3&uin=2547410506&site=qq&menu=yes" target="_blank" class="flex1">
				<i></i><span>在线客服</span>
			</a>
		</div>
    <script type="text/javascript" src="js/conversion.js">
    </script>

    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/855241981/?value=1.00&amp;currency_code=CNY&amp;label=__miCOPOiHUQ_ennlwM&amp;guid=ON&amp;script=0"/>
        </div>
    </noscript>
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1267616074'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1267616074' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">
    
    function errorCss() {
        $('.loginPop').css({
            'position': 'fixed',
            'width': '100%',
            'height': '100%',
            'background': 'rgba(2,2,7,.5)',
            'top': '0',
            'left': '0',
            'z-index': '3'
        })
        $('.loginPopDiv').css({
            'background': '#fff',
            'margin': '50% auto 0',
            'border-radius': '0.572rem',
            'width': '19.286rem',
            'min-height': '8.572rem',
            'display': 'table',
        })
        $('.loginPopDivBno').css({
            'border-radius': '0.572rem 0.572rem 0 0',
            'min-height': '7.3rem'
        })
        $('.loginPopDiv p').css({
            'font-size': '1.14286rem',
            'text-align': 'center',
            'display': 'table-cell',
            'vertical-align': 'middle',
            'padding': '1.64282rem',
            'line-height': '2rem'
        })
        $('.loginPopAn').css({
            'background': '#fff',
            'margin': '0 auto',
            'border-radius': '0 0 0.572rem 0.572rem',
            'width': '19.286rem',
            'height': '3.3rem',
            'line-height': '3.3rem',
            'border-top': '0.1rem solid #E8E8EF',
            'overflow': 'hidden'
        })
        $('.loginPopAn a').css({
            'text-align': 'center',
            'float': 'left',
            'font-size': '1.14286rem',
            'width': '50%'
        })
        $('.loginPopAn a').eq('0').css({
            'border-right': '0.1rem solid #E8E8EF'
        })
    }
    function error(text) {
        var divPop = $('<div/>').addClass('loginPop'), divText = $('<div/>').addClass('loginPopDiv'), p = $('<p/>').text(text);
        $('body').append(divPop.append(divText.append(p)))
        errorCss();
        setTimeout(function () {
            $(".loginPop").remove();
        }, 1500);
    }
</script>
</body>
</html>
