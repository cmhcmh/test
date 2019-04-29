<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:mobile");die();
}
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '惠州活动3.26-4.22';
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
@$content = '惠州活动3.26-4.22'.$_POST['content'];
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
	$sql = "INSERT INTO `tp_message`(`id`, `type`, `name`, `tel`, `content`, `add_time`, `ip`, `hourse`, `is_show`, `company_id`, `be_company_id`, `design_name`, `province_id`, `city_id`, `district_id`, `nums`, `address`, `is_equ`, `is_handle`, `qx`) VALUES ('','1','$name','$tel','$content',".time().",'$ip','$lp','0','71','0',' ','19','234','0','0',' ','1','0','0')";
	$r = mysql_query($sql,$conn);
	if($r){
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/hzzt'</script>";die();
	}else{
		var_dump($sql);
		exit();
	}
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/common.css" />
<link rel="stylesheet" href="css/animate.css">
<link type="text/css" rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/swiper.min.css"/>
<link rel="stylesheet" type="text/css" href="css/index1.css"/>

<script type="text/javascript" src="js/jquery.js"></script> 
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/jquery.dotdotdot.js"></script>
<script type="text/javascript" src="js/jquery.superslide.2.1.1.js"></script>
<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/layer.js"></script>
<script type="text/javascript" src="js/jquery.countup.min.js"></script>
<script src="js/wow.min.js"></script>
 <script src="js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
 <script src="js/autuimg.js"></script>
<script src="js/common.js"></script>
<script>if (false && document.documentMode === 10) document.documentElement.className += ' ie10';</script>
<script>if (false && document.documentMode === 11) document.documentElement.className += ' ie11';</script>
<!--[if lt IE 9]>
    <script src="js/html5.js"></script>
    <script src="js/respond.src.js"></script>
<![endif]-->
<script>
    $(function () {
        try {
            $('.form_box').validate({
                onFocus: function () {
                    this.parent().addClass('active');
                    return false;
                },
                onBlur: function () {
                    var $parent = this.parent();
                    var _status = parseInt(this.attr('data-status'));
                    $parent.removeClass('active');
                    if (!_status) {
                        $parent.addClass('error');
                    }
                    return false;
                },
                onBlurpass: true
            });

            $("#city_1").citySelect({
                url: "/js/city.min.js",
                nodata: "none",
                required: false
            });
        } catch (e) {
            return false;
        }
    })
</script>
<title>华浔20年质造  惠州春装会</title>
<meta name='keywords' content=""/>
<meta name='description' content=""/>
<script type="text/javascript">
	$(document).ready(function(){
		/*
	    window.onload = function () {
	        var hei = $(".sidel,.sider").offset().top;
	        var foot = document.getElementById("index").scrollHeight - 46;
	        $(window).scroll(function () {
	            var wh = $(window).scrollTop();
	            if (wh > hei) {
	                $(".sidel,.sider").addClass("sidel2");
	                $("#siderry").addClass("sidel2");
	                

	            } else {
	                $(".sidel,.sider").removeClass("sidel2");

	            }
	            if (wh > foot) {
	                $(".sidel,.sider").removeClass("sidel2");
	                $(".sidel,.sider").addClass("sidel3");
	      
	                //$(".sidel_s").css("top",'702px');
	            } else {
	                $(".sidel,.sider").removeClass("sidel3");
	            }
	        })
	    }*/
	    side('.sidel li','.trun','on');
    });
</script>



</head>
<body style="background:#F63F3B;" >

	<div class="header">
		<div class="layout clearfix">
			<a href="/" class="logo" style="background: url(images/1511493651.png) center no-repeat;"></a>
			
			<div class="fr">
				
				<script type="text/javascript">
					  	      //js提交   
        $("#jsBtn").click(function(){ 
            var action=$("#act").val();
            var url="/index.php/"+action+"/index";  

            document.searchmyform.action= url;  
            document.searchmyform.submit();     
        })  

			</script>
				<ul class="menu clearfix">
					<li>
						<h3><a href="/">首页</a></h3>
					</li>
					<li>
						<h3><a target="_blank" href="http://www.hxdec.com/ppsl/index.php">品牌实力</a></h3>
						<dl>
						<dd><a href="http://huizhou.hxdec.com//ppsl/index.php ">品牌介绍</a></dd><dd><a href="http://huizhou.hxdec.com/index.php/News/index/cat_id/9 ">发展历程</a></dd><dd><a href="http://huizhou.hxdec.com/index.php/News/index/cat_id/10 ">资质荣誉</a></dd><dd><a href="http://huizhou.hxdec.com/index.php/News/index/cat_id/11 ">企业动态</a></dd><dd><a href="http://huizhou.hxdec.com/index.php/News/index/cat_id/12 ">社会公益</a></dd><dd><a href="http://huizhou.hxdec.com/index.php/News/index/cat_id/13 ">品牌视频</a></dd>						</dl>
					</li>
					<li>
						<h3><a href="http://huizhou.hxdec.com/index.php/Case/index">装修案例</a></h3>
						<dl>

							<dd><a href="" target="_blank">金马克</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Case/index">精品案例</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Gallery/index">案例图库</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Vr/index">VR实景</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Hourse/index">热装楼盘</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Work/index">在建工地</a></dd>
						</dl>
					</li>
					<li>
						<h3><a href="http://huizhou.hxdec.com/index.php/Design/index">服务团队</a></h3>
						<dl>
							<dd style="display: none"><a href="#">设计研究院</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Design/index">设计团队</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Dot/index">服务门店</a></dd>
						</dl>
					</li>
					<li>
						<h3><a href="http://huizhou.hxdec.com/index.php/Page/index/cat_id/30">服务保障</a></h3>
						<dl>
							<dd><a href="http://huizhou.hxdec.com//index.php/Page/index/cat_id/30">服务流程</a></dd>
							<dd><a href="#" class="boOrder">在线下单</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/Design/index"  >装修预约</a></dd>
							<dd><a href="http://huizhou.hxdec.com/index.php/News/index/cat_id/34">装修故事</a></dd>
						</dl>
					</li>
					
					
				</ul>
			</div>
		</div>
	</div>
	<!--
	<div class="sider">
		<ul>
			<li class="li2"><a href="#"  onclick="order_show();"></a></li>
			<li class="li3"><a href="https://cloud.hxdec.com/?c=a-92d/#/" target="_blank"></a></li>
			<li class="li4"><a href="http://www.hxdec123.com/R-soft-hxdec071/login.asp" target="_blank"></a></li>
			<li class="li5"><a href="javascript:void(0);" class="backtop"></a></li>
		</ul>
	</div>-->
	<div class="inbanner" >
		<img src="images/zhongjian.jpg" style="width: 100%;margin: 0px auto;text-align: center;"	align="center"/>
	</div>
	<div class="main" style="width: 100%;margin: 0px auto;text-align: center;">
		<a  id="nb_icon_wrap">
		<div style="width:1202px;margin: 0px auto;text-align: center;">
		
			<img src="images/HZ2_03.png" style="width:100%; margin: 0px auto;text-align: center;"/>
			
		</div>
		<div style="width:1201px;margin: 0px auto;text-align: center;">
		
			<img src="images/HZ2_07.png" style="width:100%; margin: 0px auto;text-align: center;"/>
			
		</div>
		<div style="width:1201px;margin: 0px auto;text-align: center;">
			<ul style="padding-top:2%;">
				<li style="float:left; background:url(images/HZ2_031.png) no-repeat center top; background-size:97%; width:33%; height:410px;">
					<p style="font-size:21.29px;color:#fff;width:352px;line-height:35px;text-align:left; position: relative; top:65%;left:8%;">活动期间面积100m²以上客户凭有效户型图前来咨询送<font color="red">精美礼品一份</font>，数量有限，送完即止 ;</p>
				</li>
				
				<li style="float:left;background:url(images/HZ2_05.png) no-repeat center top; background-size:97%;width:33%; height:410px;">
					<p style="font-size:21.29px;color:#fff;width:352px;line-height:35px;text-align:left; position: relative; top:65%;left:8%;">春装会期间下定签单客户，赠送水电隐蔽工程保修期1年！ <font color="red">保修期由5年升级为6年；</font></p>
				</li>
				<li style="float:left;background:url(images/HZ2_071.png) no-repeat center top; background-size:97%;width:33%; height:410px;">
					<p style="font-size:21.29px;color:#fff;width:352px;line-height:35px;text-align:left; position: relative; top:65%;left:8%;">活动期间客户签定999元/m²口碑理想整装套餐，<font color="red">赠送欧派价值3808元E312烟机、Q312灶具一套；</font></p>
				</li>
				<div class="clear" style="margin-top:2%;"></div>
				
				<li style="float:left;background:url(images/HZ2_12.png) no-repeat center top; background-size:95%;width:50%; height:409px;">
					<p style="font-size:21.23px;color:#fff;width:551px;line-height:45px;text-align:left; position: relative; top:65%;left:8%;"></p>
				</li>
				
				<li style="float:left;background:url(images/HZ2_14.png) no-repeat center top; background-size:95%;width:50%; height:409px;">
					<p style="font-size:21.23px;color:#fff;width:551px;line-height:45px;text-align:left; position: relative; top:65%;left:8%;">个性设计、个性报价客户，选择主材代购，优惠更精彩，至少为您的爱家省钱万元以上，详情请见现场公告</p>
				</li>
				<div class="clear"></div>
			</ul>
		</div>
		<div style="width:1200px;margin: 0px auto;text-align: center; padding:2%;">
			<img src="images/HZ2_19.png"/>
		</div>
		<div style="width:1202px;margin: 0px auto;text-align: center;">
			<img src="images/HZ2_22.png" style="width:100%; margin: 0px auto;text-align: center;"/>
		</div>
		<div style="width:1200px;margin: 0px auto;text-align: center;">
		<ul>
			<li style="float:left;width:50%;">
				<p style="font-size:39.19px;color:#ffefc0;margin: 0px auto;text-align: center;">品牌保障</p>
				<p style="font-size:18px;color:#f5f5f5;margin: 0px auto;text-align: center;line-height:35px;">专注装饰20年<br/>品质全国联保</p>
				<p style="font-size:20px;color:#ffffff;border:1px #ffffff solid; padding:1%;width:300px;border-radius:25px;margin: 0px auto;text-align: center; margin-bottom:5%;">全国联保热线：400-628-1968</p>
				<img src="images/HZ2_06.png" style="width:93%;margin: 0px auto;text-align: center;"/>
			</li>
			<li style="float:left;width:50%;">
				<p style="font-size:39.19px;color:#ffefc0;margin: 0px auto;text-align: center;">诚信护航</p>
				<p style="font-size:16.9px;color:#f5f5f5;margin: 0px auto;text-align: center;line-height:30px;margin-bottom:3%;">华浔承诺：所有工程不转包</br>
				八重质量检验体制，品质更有保障：</br>
				<font color="#ffdb7a" style="font-weight:bold;">工人自检—工长初检—工程管家复检—工程部质检</br>
				分公司总经理抽检—区域质检巡检—集团质控抽检—总裁巡查</font></p>
				<img src="images/HZ2_0321.png" style="width:90%;margin: 0px auto;text-align: center;"/>
			</li>
			<li style="float:left;width:50%; margin-top:3%;">
				<p style="font-size:39.19px;color:#ffefc0;margin: 0px auto;text-align: center;">健康环保</p>
				<p style="font-size:18px;color:#f5f5f5;margin: 0px auto;text-align: center;line-height:35px; margin-bottom:8%;">传承粤派工艺20年，致力于生态工艺发展与研究<br/>
				多项国内，国际环保认证，环保不达标<font size="30px">砸</font></p>
				<img src="images/HZ2_13.png" style="width:94%;margin: 0px auto;text-align: center;"/>
			</li>
			<li style="float:left;width:50%;margin-top:3%;">
				<p style="font-size:39.19px;color:#ffefc0;margin: 0px auto;text-align: center;">诚信护航</p>
				<p style="font-size:20px;color:#f5f5f5;margin: 0px auto;text-align: center;line-height:35px; margin-bottom:3.5%;">用银行的钱装修，用装修的钱理财<br/>
				与<font color="#ffdb7a" style="font-weight:bold;">中国建行银行，农业银行，中国银行</font>联合推出低利率<br/>
				装修分期贷，月费率最低<font color="#ffdb7a" style="font-weight:bold;">0.25%</font></p>
				<img src="images/HZ2_11.png" style="width:90%;margin: 0px auto;text-align: center;"/>
			</li>
			<div class="clear"></div>
			<li style="margin-top:3%;position:relative; z-index:5;">
				<p style="font-size:39.19px;color:#ffefc0;margin: 0px auto;text-align: center;">名品荟萃</p>
				<p style="font-size:18px;color:#f5f5f5;margin: 0px auto;text-align: center;line-height:35px; margin-bottom:2%;">联合献礼，不是大牌不聚惠   </p>
				<img src="images/HZ2_18.png" style="width:90%;margin: 0px auto;text-align: center;"/>
			</li>
		</ul>
		</div>
		</a>
		<div class="Case">
		  <div class="Shou_width">
			<div class="Centent_df">
			  <div class="COp_un">
				  <div class="swiper-container">
					<div class="swiper-wrapper">
					  <div class="swiper-slide"> 
					   <ul id="Tab">
						  <li>
							<ul id="Tab_c">
								<li>
									<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13952" target="_blank">
									<img id="display" src="images/al/HZ2_09.png" style="width: 100%;height: 383px;"/>
									<p><img src="images/al/1-1(1) .png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/1-1 (2).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/1-1 (3).png" style="width: 110px;height:104px;"/></p>
									<div class="clear"></div>
									<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">珑湖湾·新中式</div>
									</a>
								</li>
								<li>
									<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13901" target="_blank">
									<img id="display" src="images/al/HZ2_12.png" style="width: 100%;height: 383px;"/>
									<p><img src="images/al/1-2(1).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/1-2 (2).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/1-2 (3).png" style="width: 110px;height:104px;"/></p>
									<div class="clear"></div>
									<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">君域家园·欧式</div>
									</a>
								</li>
								<li>
									<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13915" target="_blank">
									<img id="display" src="images/al/HZ2_14.png" style="width: 100%;height: 383px;"/>
									<p><img src="images/al/1-3(1).jpg" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/1-3(2).jpg" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/1-3.jpg" style="width: 110px;height:104px;"/></p>
									<div class="clear"></div>
									<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">中州湾上花园·现代简约</div>
									</a>
								</li>
							</ul>
						   </li>
							</ul>
							</div>
							<div class="swiper-slide">  
							<ul id="Tab">
							  <li>
								<ul id="Tab_c">
									<li>
										<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13946" target="_blank">
										<img id="display" src="images/al/HZ2-2_03.png" style="width: 100%;height: 383px;"/>
										<p><img src="images/al/2-1 (1).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/2-1 (2).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/2-1 (3).png" style="width: 110px;height:104px;"/></p>
										<div class="clear"></div>
										<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">白鹭湖君临天下·混搭</div>
										</a>
									</li>
									<li>
										<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13955" target="_blank">
										<img id="display" src="images/al/HZ2-2_06.png" style="width: 100%;height: 383px;"/>
										<p><img src="images/al/2-2 (1).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/2-2 (2).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/2-2 (3).png" style="width: 110px;height:104px;"/></p>
										<div class="clear"></div>
										<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">中海水岸城·美式</div>
										</a>
									</li>
									<li>
										<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13954" target="_blank">
										<img id="display" src="images/al/HZ2-2_08.png" style="width: 100%;height: 383px;"/>
										<p><img src="images/al/2-3 (1).jpg" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/2-3 (2).jpg" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/2-3 (3).jpg" style="width: 110px;height:104px;"/></p>
										<div class="clear"></div>
										<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">中铠华章·法式</div>
										</a>
									</li>
								</ul>
							  </li>
							</ul>
							</div>
							<div class="swiper-slide">  <ul id="Tab">
							  <li>
								<ul id="Tab_c">
									<li>
										<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13916" target="_blank">
										<img id="display" src="images/al/HZ2-3_03.png" style="width: 100%;height: 383px;"/>
										<p><img src="images/al/3-1 (1).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/3-1 (2).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/3-1 (3).png" style="width: 110px;height:104px;"/></p>
										<div class="clear"></div>
										<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">光耀城市山谷·简欧</div>
										</a>
									</li>
									<li>
										<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13906" target="_blank">
										<img id="display" src="images/al/HZ2-3_06.png" style="width: 100%;height: 383px;"/>
										<p><img src="images/al/3-2 (1).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/3-2 (2).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/3-2 (3).png" style="width: 110px;height:104px;"/></p>
										<div class="clear"></div>
										<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">奥林匹克悦龙湾·北欧</div>
										</a>
									</li>
									<li>
										<a href="http://huizhou.hxdec.com/index.php/Case/detail/id/13951" target="_blank">
										<img id="display" src="images/al/HZ2-3_08.png" style="width: 100%;height: 383px;"/>
										<p><img src="images/al/3-3 (1).png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/3-3 (2.png" style="width: 110px;height:104px;"/></p>
									<p><img src="images/al/3-3 (3).png" style="width: 110px;height:104px;"/></p>
										<div class="clear"></div>
										<div style="background:#fdac83;padding:2%;margin-top:4%;text-align:center;font-size:18px; color:#fff;">方直星耀国际·欧式经典</div>
										</a>
									</li>
								</ul>
							  </li>
							</ul>
							</div>
							<div class="clear"></div>
						</div>
		<!-- Add Pagination -->
		<div class="swiper-pagination"></div>
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
		</div>
			  </div>
			</div>
		  </div>
		</div>
		<div class="clear"></div>
		<script type="text/javascript">
		$('#Tab_c li a p>img').hover(function () {
			$(this).parent().siblings('img').attr('src',$(this).attr('src'));
		})
		  var swiper = new Swiper('.swiper-container', {
		  slidesPerView: 1,
		  spaceBetween: 30,
		  loop: true,
		  pagination: {
			el: '.swiper-pagination',
			clickable: true,
		  },
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		});
		var Tab_se=document.getElementsByClassName("Tab_se")
		for (var i=0;i<Tab_d.children.length;i++){
		  Tab_d.children[i].index=i
		  Tab_d.children[i].onclick=function  () {
			for (var i=0;i<Tab_d.children.length;i++){
			  Tab_d.children[i].style.backgroundColor="#faa332"
			  Tab_se[i].style.display="none"
			  
			}
			this.style.background="#e6002d"
			Tab_se[this.index].style.display="block"
		  }
		}
		</script>
		
		<div style="background:url(images/HZ2_055553.png) no-repeat center top; margin:0px auto; width:1201px; height:400px; margin-top:74px;margin-bottom:314px;position:relative; z-index:9;">
			<div class="left"style="margin-top: 2%; margin-left: 2%;width:800px;float:left;">
				<ul >
					<a target="_blank" href="http://huizhou.hxdec.com/index.php/Design/detail/id/13812"><li style="float:left;margin-right:2%;"><img src="images/HZ2_17.png"/></li></a>
					<a target="_blank" href="http://huizhou.hxdec.com/index.php/Design/detail/id/13810"><li style="float:left;margin-right:2%;"><img src="images/HZ2_15.png"/></li></a>
					<a target="_blank" href="http://huizhou.hxdec.com/index.php/Design/detail/id/13823"><li style="float:left;margin-right:2%;"><img src="images/HZ2_1443.png"/></li></a>
					<a target="_blank" href="http://huizhou.hxdec.com/index.php/Design/detail/id/13814"><li style="float:left;margin-right:2%;"><img src="images/HZ2_1431.png"/></li></a>
					<div class="clear"></div>
				</ul>
				<div style="width:96.5%; height:84px;background:#F92424;margin-top:2%;color:#fff;font-size:18px;text-align:center;line-height:84px;font-weight:bold;">
					<p><span style="font-size:36.3px; margin-left:-5%;">设计师团队</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;汇聚行业顶级设计人才，全心全意为客户服务</p>
				</div>
			</div>
			<div class="right" style="float:left; margin-top: 2%;width:350px;height:350px;background:#FA8246;">
				<div style="font-size:16px;color:#fff; line-height:35px; border-bottom:1px #fff solid; width:80%; margin:0px auto; padding:2%;margin-top:7%;">
					<span style="font-size:33px;">预约设计师</span> designer
				</div>
				<p style="font-size:16px;color:#fff;line-height:35px;text-align:left; margin-top:15%;  margin-left: 12%; font-weight:bold;"><font color="#f63e39">空间布局</font>如何正确利用？<br/>
					<font color="#f63e39">软装</font>如何布置？<br/>
					求<font color="#f63e39">新中式风格</font>设计？</p>
					<div>
					<input type="button" value="立即预约"href="#" class="boOrder"style="width:240px; height:40px; color:red; background:#fff;border-radius:10px;font-size:20px; margin-top:10%;font-weight:bold;" />
					</div>
			</div>
		</div>
			
		</div>
	
	<div style="position:absolute; bottom:1750px;z-index:3;"><img src="images/HZ2_0333.png" style="width:100%;"/></div>
	<div style="position:absolute; bottom:345px;z-index:3;"><img src="images/HZ2_02.png" style="width:100%;"/></div>
<div class="foot">
		<div class="layout">
			<div class="ftop clearfix">
				<dl class="clearfix">
					<dt><h3>品牌实力</h3></dt>
						<dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/35" target="_blank">品牌介绍</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/9" target="_blank">发展历程</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/10" target="_blank">资质荣誉</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/11" target="_blank">企业动态</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/12" target="_blank">社会公益</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/13" target="_blank">品牌视频</a></dd>				</dl>
				<dl class="clearfix">
					<dt><h3>装修案例</h3></dt>
							<dd><a href="http://huizhou.hxdec.com//index.php/Case/index"  target="_blank">金马克</a></dd>
							<dd><a href="http://huizhou.hxdec.com//index.php/Case/index"  target="_blank">精品案例</a></dd>
							<dd><a href="http://huizhou.hxdec.com//index.php/Gallery/index"  target="_blank">案例图库</a></dd>
							<dd><a href="http://huizhou.hxdec.com//index.php/Vr/index"  target="_blank">VR实景</a></dd>
							<dd><a href="http://huizhou.hxdec.com//index.php/Hourse/index"  target="_blank">热装楼盘</a></dd>
							<dd><a href="http://huizhou.hxdec.com//index.php/Work/index"  target="_blank">在建工地</a></dd>
				</dl>

				<dl class="clearfix">
					<dt><h3>服务团队</h3></dt>
						<dd><a href="http://huizhou.hxdec.com//index.php/Design/index"  target="_blank">设计团队</a></dd>
						<dd><a href="http://huizhou.hxdec.com//index.php/Dot/index"  target="_blank">服务门店</a></dd>
				</dl>
				<dl class="clearfix">
					<dt><h3>营销活动</h3></dt>
					<dd><a href="http://huizhou.hxdec.com//index.php/Activi/index/cat_id/25"  target="_blank">全国活动</a></dd>
					<dd><a href="http://huizhou.hxdec.com//index.php/Activi/index/cat_id/26"  target="_blank">分公司活动</a></dd>
				</dl>

				<div class="box">
					<h3>为您推荐</h3>
					<div class="pich"><a target="_blank" href="http://www.hxdec.com/ppsl/index.php"><img src="picture/1510647366.jpg"></a></div> 
				</div>
				<form id="form3" method="post">
					<h3>在线下单尊享贵宾体验</h3>
					<input type="text" class="text" placeholder="联系人" name="name" id="name" />
					<input type="text" class="text" placeholder="联系电话"  name="mobile" id="mobile"/>
					<input type="hidden"  name="action" value="add47">
					  <div class="clearfix">
                                <input type="text" class="text text2" placeholder="验证码"   name="code" id="verify" style="margin-right: 15px;width: 101px;float:left;" />
                                <div class="yzm"><img src="code.php" onclick="this.src+='?rand='+Math.random();" id="imgverify" style="width: 81px;"></div>
                                <span><a href="javascript:void(0);" onclick="document.getElementById('imgverify').src+='?rand='+Math.random();">看不清，换一张</a></span>
                       </div>
					 <input type="hidden"  name="company_id" value="0">
					     <input type="hidden"  name="is_equ" value="1">
                     <input type="hidden"  name="type" value="1">
					<p><font color='red' size='-1' id='s_cmresult_3'></font></p>
					<input type="submit" class="button" value="提交" onclick="s_mySubmit_3('form3','/index.php/Contact/message','s_cmresult_3')" />
				</form>
				<script type="text/javascript">
                /****提交表单************/
                function s_mySubmit_3(theForm,url,result){
                    var province_id=$('#province').val();
                    var city_id=$('#city').val();
                    var name=$('#name').val();
                    var mobile=$('#mobile').val();
                    var verify=$('#verify').val();
                    var hourse=$('#hourse').val();

              
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
                 <div class="ewm">
					<span style="font-size:16px; text-align:left;">亲！关注我们</span>
					<div class="pic"><img src="picture/1511494024.jpg"></div>
					<p>周一到周日 9：00-18：00<em>400-040-2005</em></p>
				</div>
			</div>
			<dl class="link clearfix">
				<dt>友情链接</dt>
				<dd>
					<div class="link_line">		
						<div>
						<a target="_blank" href="http://www.totojia.com ">房子装修效果图</a><a target="_blank" href="http://zh.landizs.com">珠海装修公司</a><a href="http://www.hxdec.com/">装修公司</a><a href="http://www.hxdec.com/">装饰公司</a><a href="http://www.hxdec.com/">别墅装修公司</a>
						</div>
						<div>
						<a href="http://www.hxdec.com/">广州装修公司</a>	
						</div>		
					</div>
				</dd>
			</dl>
			<div class="copyright">版权信息：1998-2017 广东华浔品味装饰集团       ICP备案号:<a href="http://www.miitbeian.gov.cn/">粤ICP备15089103号</a></div>
			
		</div>
	</div>
	
	<div class="bo_fide"></div>
	
	<div class="item1 bo_Box">
		<div class="bo_title">预约下单</div>
		<div class="bo_form">
			<form id="form_tan" method="post">
				<div class="mx">
					<label><i>* </i>楼盘名字：</label>
					<input type="text" name="hourse"  id="hourse_tan">
				</div>
				<div class="mx">
					<label><i>* </i>您的名字：</label>
					<input type="tel" name="name" id="name_tan">
				</div>
				<div class="mx">
					<label><i>* </i>联系电话：</label>
					<input type="tel" name="mobile" id="mobile_tan">
				</div>
				 <div class="mx" style="padding-left: 187px;">
				 <label style="float: left;"><i>* </i>验 证 码：</label>
				
				<input type="text" class="text text2" placeholder="验证码" name="code" id="verify_tan" style="width:50px;float: left;" />
				<div class="yzm"><img style="float: left;margin: 5px;" src="code.php" onclick="this.src+='?rand='+Math.random();" id="tan_imgverify"></div>        
                  </div>
                     <input type="hidden"  name="company_id" value="0">
                     <input type="hidden"  name="action" value="add47">
                            <input type="hidden"  name="type" value="1" id="type_tan">
                             <input type="hidden"  name="is_equ" value="1">
                   <p class="mx"><font style="text-align: center;" color='red' size='-1' id='cmresult_tan'></font></p>
				<input type="submit" name="submit" class="submit" value="立即提交" onclick="mySubmit_tan('form_tan','/index.php/Contact/message','cmresult_tan')">
			</form>
		</div>
		<div class="close"><img src="picture/bo_close.jpg"></div>  
	</div>
<style>
	#kfqq{ position:fixed; right:0px; top:10%;  }
	#kfqq img{ width:130px; }
</style>
		<script type="text/javascript">
		$(function(){
			// 2017-10-17波

			$('.close').click(function(){
				$('.bo_Box,.bo_fide').hide()
			})

			$('.boPro').click(function(){
				$('.item0,.bo_fide').show()
				$('.bo_title').html('投诉建议');
				return false
			})
			$('.boOrder').click(function(){
				$('.item1,.bo_fide').show();
				$('.bo_title').html('在线下单');
			$('#type_tan').val(1);
			$('#design_new').val('');
				$('#design_name_tan').val('');
						$('#hourse_tan').val('');
			$('#design_div').hide();
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
	<script type="text/javascript">
		selectphone('.c_select','.c_name');
					$(".calculate .tit").click(function() {
				$(this).parents(".calculate").find(".con").slideDown();
			});$(".calculate .close").click(function() {
				$(this).parents(".calculate").find(".con").slideUp();
			});
			if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
				new WOW().init();
			};
	</script>
	<script type="text/javascript">
		selectphone('.c_select','.c_name');
					$(".calculate .tit2").click(function() {
				$(this).parents(".calculate").find(".con").slideDown();
			});$(".calculate .close").click(function() {
				$(this).parents(".calculate").find(".con").slideUp();
			});
			if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
				new WOW().init();
			};
	</script>
	<form action="#" method="post">
	<div class="footer_float">
	<div class="f_f_box">
	<div class="f_l">
	<img src="picture/baojiabg.png">
	<h3>算一算装修该花多少钱?</h3>
	
	</div>
	<div class="f_c">
	<dl class="book fixed AForm form_box">
		<dd class="m_t"><span class="error">
			<input type="text" placeholder="您的姓名" name="name" class="txt required Aname" data-valid="isNonEmpty||EnorZh||between:2-5" data-error="姓名不能为空||姓名为中或英文||姓名为2-5位" data-status="0"></span></dd>

		<dd class="m_t"><span class="in error">
			<input type="text" placeholder="手机号" name="mobile"class="txt required Aphone" data-valid="isNonEmpty||isMobile" data-error="电话不能为空||电话格式有误" data-status="0"></span></dd>
		<dd><span class="">
			<input type="text" name="hourse" placeholder="楼盘名称" class="txt ALPMC"></span></dd>
		<dd><span class="">
			<input type="text" class="text text2" placeholder="验证码" name="code" id="verify_tan" style="width:60%;float: left;" />
				<div class="yzm"><img style="margin: 5px;" src="code.php" onclick="this.src+='?rand='+Math.random();" id="tan_imgverify"></div>   </span></dd>
		<dd class="last">
		<input type="hidden"  name="action" value="add47">
			<button type="submit" name="button" class="bon Applicationbtn1 btm" data-id="1" data-name="底部预约" data-title="预约服务" data-classid="62">获取<br>
				报价</button>
		</dd>
	</dl>
	</div>
	<div class="f_r">
	<h3>400-040-2005</h3>
	<p>装修咨询热线</p>
	</div>
	</div>
	<span class="togg">x</span>
	<div class="getshow">
	<img src="picture/11.png">
	</div>
	</div>
	<script>
	getSingleLine1Numto("SingleLine1Num2", 62, "title");
	getSingleLine1Numto("SingleLine1Num1", 62, "title");
	</script>

    </form>


</body>
</html>