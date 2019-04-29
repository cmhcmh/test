<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:wap");die();
}
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '精湛工艺PC版';
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
@$content = '精湛工艺PC版'.$_POST['content'];
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
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/gy/'</script>";die();
	}else{
		var_dump($sql);
		exit();
	}
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
	<title>精湛工艺-华浔品味装饰</title>
	<link rel="stylesheet" type="text/css" href="css/public.css" />
	<link rel="stylesheet" href="css/jquery.mcustomscrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fullpage.css" />
	<script src="js/bilin.js" type="text/javascript" charset="utf-8"></script>
	
</head>

<style type="text/css">
html{overflow: hidden;background: #f7f7f7;}
html,body{height: 100%;}
.min-head{position: fixed!important;left: 0;top: 0;width: 100%;z-index: 99999;}

body{ margin:0px auto; font-family: Arial, "微软雅黑";
font-size: 14px;
color: #666;
min-width: 1200px;
overflow: auto;
}

dl,dd,dt{margin:0;padding:0;}
a{ text-decoration:none;}

.floating_ck{position:fixed;right:20px;top:30%;}
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
    width: 180px;
    padding: 0 10px;
}
.bo_form .mx {
    overflow: hidden;
    text-align: center;
    margin-bottom: 20px;
	    padding-left: 187px;
}
</style>
<script type="text/javascript">
	var circle_data=['首屏','1','2','3','4','5','6','7','8','9','10','11'];
</script>
<style>
	.pull-left li{border:none!important;}
</style>
<script>
//给div层中的关闭添加onclick事件：
function CloseDiva(){
document.getElementById("item1 bo_Box").style.display="none";
}
</script>
<body>
<div class="item1 bo_Box" id="item1 bo_Box">
		<div class="bo_title">我要装修</div>
		<div class="bo_form">
			<form id="form_tan" action="#" method="post" style="background-color:#fff;">

				<div class="mx" style="margin-top:5%;">
					<label><i>* </i>楼盘名字：</label>
					<input type="text"  name="hourse" id="userName2" value="" placeholder="请输入您的楼盘名称">
				</div>
				<div class="mx">
					<label><i>* </i>您的名字：</label>
					<input type="text"  name="name" id="userName" value="" placeholder="请输入您的姓名">
				</div>
				<div class="mx">
					<label><i>* </i>联系电话：</label>
					<input type="tel"  name="mobile" id="mobile" maxlength="11" value="" placeholder="请输入您的手机号码">
				</div>
				 <div class="mx" style="padding-left: 187px;">
				 <label style="float: left;"><i>* </i>验 证 码：</label>

				<input type="text" class="text text2" placeholder="验证码" name="code" id="verify_tan" style="width:70px;float: left;">
				<div class="yzm"><img style="float: left;margin: 5px; width:110px;" src="code.php" onclick="this.src+='?rand='+Math.random();" id="tan_imgverify"></div>
           
                  </div>
					<input type="hidden" name="action" value="add47" />
                     <input type="hidden" name="company_id" value="0">
                            <input type="hidden" name="type" value="1" id="type_tan">
                   <p class="mx"><font style="text-align: center;" color="red" size="-1" id="cmresult_tan"></font></p>
				<input type="submit" name="submit" class="submit" value="立即提交" onclick="">
			</form>
		</div>

		<div class="close" onclick="javascript:CloseDiva();"><img src="images/bo_close.jpg"></div>
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
				$('.bo_title').html('我要装修');
				$('#type_tan').val(1);
				$('#hourse_tan').val(hourse_name);

			}else{

				$('.item1,.bo_fide').show();
				$('.bo_title').html('我要装修');
				$('#type_tan').val(1);
				$('#design_new').val('');
				$('#design_name_tan').val('');
				$('#design_div').hide();
			}
		}
	</script>


	</div>
<div class="quality">
	<!--头部/s-->
<div class="min-head">
    <div class="container" style="width:1240px;">
        <a href="/" class="logo pull-left"><img src="images/logo-min.png"></a>
        <ul class="nav pull-left">
            <li >
            	<a href="/" class="nav-menu">首页</a>
            </li>
            <li >
            	<a href="/ppsl" class="nav-menu">品牌实力</a>
            	<div class="sub-menu"> 
                    <a href="/ppsl">品牌介绍</a> 
                     <a href="/index.php/News/index/cat_id/9">发展历程</a> 
                     <a href="/index.php/News/index/cat_id/10">资质荣誉</a> 
                     <a href="/index.php/News/index/cat_id/11">企业动态</a>
                     <a href="/index.php/News/index/cat_id/12">社会公益</a>
                     <a href="/index.php/News/index/cat_id/13">品牌视频</a>
                 </div>
            </li>
            <li >
            	<a href="/index.php/Case/index" class="nav-menu">装修案例</a>
            	<div class="sub-menu"> 
                    <a href="/jmk">金马克杯</a>
                    <a href="/index.php/Case/index">精品案例</a>
                    <a href="/index.php/Gallery/index">案例图库</a> 
                    <a href="/index.php/Vr/index">VR实景</a> 
                    <a href="/index.php/Hourse/index">热装楼盘</a>
                    <a href="/index.php/Work/index">在建工地</a>
                </div>
            </li>
            <li >
            	<a href="/index.php/Design/index" class="nav-menu">服务团队</a>
            	<div class="sub-menu"> 
                    <a href="/index.php/Design/index">设计团队</a> 
                    <a href="/index.php/Dot/index">服务门店</a>
                </div>
            </li>
            <li >
            	<a href="/index.php/Activi/index" class="nav-menu">营销活动</a>
            	<div class="sub-menu"> 
                     <a href="/index.php/Activi/index/cat_id/25">全国活动</a>
                     <a href="/index.php/Activi/index/cat_id/26">分公司活动</a>
                </div>
            </li>
            <li  class="cur" >
            	<a href="/gy" class="nav-menu">无忧工程</a>
            	<div class="sub-menu"> 
                     <a href="/clzt">环保材料</a>
                     <a href="/gy">精湛工艺</a>
                </div>
            </li>
            <li >
            	<a href="/index.php/Page/index/cat_id/30" class="nav-menu">服务保障</a>
            	<div class="sub-menu"> 
                     <a href="/index.php/Page/index/cat_id/30">服务流程</a>
                     <a href="/index.php/Design/index">装修预约</a>
                     <a href="/index.php/News/index/cat_id/34">装修故事</a> 
                </div>
            </li>
            <li >
            	<a href="/index.php/News/index/cat_id/36" class="nav-menu">装修指南</a>
            	<!--<div class="sub-menu"> 
                     <a href="/column/9">客户评价</a>
                     <a href="/service/flow">服务流程</a>
                     <a href="/service/reservation/t2">装修预约</a>
                     <a href="javascript:;" onclick="doyoo.util.openChat('g=10059956');return false;" >免费咨询</a> 
                     <a href="/service/repair">投诉报修</a>
                </div>-->
            </li>
			 <li>
            	<a href="http://www.hamilan.cn" style="color:#fff;">集团设计</a>
            </li>
        </ul>
        <div class="hotline pull-right">
            家装热线：<span><b>400-040-2005</b></span>
        </div>
    </div>
</div>	<!--头部/e-->

	<div class="quality_cont">
		
		<div class="scroll protection1 pr section" style="overflow: hidden;">
			<div class="cont pa pr" style="background:none; margin:0; border:none; left: 35%; top:32%; width:700px;margin-left:-350px;">
				<img src="images/protection_pic1.png"/>
			</div>
		</div>
		<!--第1屏结束-->
		<div class="scroll protection2 clearfix protection_box section">
			<div class="cont pr fl pr">
				<div class="pic pa" style="background-image: url(imagesbg/1.jpg);">
					<div class="box"style="float:left; width:50%;height:100%;">
						<div class="top fl" >
							
						</div>
					</div>
					<div class="box"  style="float:left;text-align:left;width:50%;height:100%; margin-top:10%;">
					<div class="list fl">
						<h2 style="font-size:34px;">让工地开口说话</h2>
						<h2 style="font-size:20px;">21年粤派工艺传承与发扬</h2>
						<h2 style="font-size:17px; font-weight:normal;text-align:left; margin-top:20%;">责任是品质的保证，品质是品牌的根基，华浔21年坚持<br/>从设计、工艺、材料、服务的品质上来满足客户对家居<br/>空间的消费需求，精益求精地打造一个人性化居住空间。<br/>以“粤派精工”为指导标准，首推行业七大工种，严格<br/>按照365道施工工序，高于行业标准的施工审核体系</h2>
					</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--第2屏结束-->
		<div class="scroll protection3 clearfix protection_box green section">
			<div class="cont fr pr">
				<div class="pic pa" style="background-image: url(imagesbg/2.jpg);">
					<div class="box" style="z-index:999; position:relative;float:left; left:10%;top:15%; color:#000;">
					<div class="list fl">
						<h2 style="font-size:40px;color:#000;">七大工艺流程 -「施工保护」</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">电梯出入口保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">入户门保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">阳台保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">窗户保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">推拉门滑道保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">洁具的保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">临时护栏的保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">外露电线保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">强弱电箱保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">地砖、木地板的保护</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;color:#000;">成品门保护</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第3屏结束-->
		<div class="scroll protection4 clearfix protection_box section">
			<div class="cont fl pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/3.jpg);">
					<div class="box" style="width:100%;height:100%;">
					<div class="top fr" style="z-index:999; position:relative;float:right;width:50%;margin-left:0; left:5%;transform: translate(0, -60%);">
						<h2 style="font-size:32px; color:#fff;">七大工艺流程 -「电工工程」</h2>
						<p style="font-size:20px; margin-top:10%;">根据定出的位置确定整套房内线路的走向进行弹线<br/>
						电路布管横平竖直，整齐美观<br/>
						电路的铺设<br/>
						电路施工根据规范检测<br/>
						安装接线盒并保护<br/>
						灯线出口软管保护<br/>
						</p>
					</div>
				
				</div>
				
				</div>
			</div>
			
		</div>
		<!--第4屏结束-->
		<div class="scroll protection5 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/4.jpg);">
				
				<div class="box" style="z-index:999; position:relative;float:left;width:50%;height:100%;float:left;">
					<div class="list fl" style="margin-left: 23%;margin-top:27%; text-align:left;">
						<h2 style="font-size:34px;color:#000;text-align:left;">七大工艺流程 -「水工工程」</h2>
						<h2 style="font-size:22px; font-weight:normal; margin-top:10%;color:#000;text-align:left;">水管布设，尽量避开煤气管、暖气管、通风管，保持有</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">一定的间隔距离</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">线管开槽，避免从卧室、书房开槽走管</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">水路施工，热熔连接</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">排水排污施工，排水管道安装</h2>
					</div>
				</div>
				</div>
			</div>
		
		</div>
		<!--第5屏结束-->
		<div class="scroll protection6 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic fl pa" style="background-image: url(imagesbg/5.jpg);">
				<div class="box" style=" width:50%; float:right;">
					<div class="top fr" style="float:left; margin:0; margin-left:10%; margin-top:25%;">
						<h2 style=" font-size:34px;color:#fff;">七大工艺流程 -「泥工工程」</h2>
						<p style="font-size:22px;text-align:right;">
						砌墙挂网批荡</br>
						墙面及地面找平</br>
						防水处理</br>
						沉箱处理</br>
						地面铺贴及墙面镶贴工程</p>
						
					</div>
					
				</div>
				
				</div>
			</div>
			
		</div>
		<!--第6屏结束-->
		<div class="scroll protection7 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic pa" style="background-image: url(imagesbg/6.jpg);">
				<div class="box" style="z-index:999; position:relative;float:left; left:13%;">
					<div class="list fl" style="margin-top:55%;">
						<h2 style="font-size:40px;color:#000;text-align:left;">七大工艺流程 -「木工工程」</h2>
						<h2 style="font-size:22px; font-weight:normal;margin-top:10%;color:#000;text-align:left;">门套制造</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">推拉门制作安装</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">柜体制作安装</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">天花吊顶制作安装</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">墙面、玄关造型</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第7屏结束-->
		<div class="scroll protection8 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic  pa" style="background-image: url(imagesbg/7.jpg);">
				
					<div class="top fr" style="float:right; margin-top:10%;padding-left:20%; width:50%;">
						<h2 style="font-size:37px; color:#fff; margin-left:8%;">七大工艺流程 -「油漆工程」</h2>
						<p style="font-size:22px;color:#fff; margin-top:5%; margin-left:8%;">
						刷保护漆</br>
						补钉眼</br>
						打磨清底</br>
						喷三遍底漆</br>
						打干、水磨</br>
						喷三遍面漆</br>
						验收合格后用专用保护膜保护</br>
						</p>
					</div>
					
				</div>
			</div>
			
		</div>
		<!--第8屏结束-->
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/8.jpg);">
				
				<div class="box" style="z-index:999; position:relative;float:left; width:50%;height:100%;margin-top:17%;margin-left:10%;">
					<div class="list fl" style="margin-top:0;">
						<h2 style="font-size:34px;color:#000;text-align:left;">七大工艺流程 -「煽灰工程」</h2>
						<h2 style="font-size:22px; font-weight:normal; margin-top:10%;color:#000;text-align:left;">内墙煽灰</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">天花板煽灰</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">墙面挂网、煽灰</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">手工、机械打磨</h2>
						<h2 style="font-size:22px; font-weight:normal;color:#000;text-align:left;">手刷漆、滚涂墙面漆、机械喷涂</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第9屏结束-->
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/9.jpg);">
				
				<div class="box" style="width:50%;height:100%;float:left; padding:0;">
					<div class="list fl" style="width:700px; margin-top:25%; margin-left:10%; height:auto;">
						
					</div>
				</div>
				<div class="box" style="z-index:999; position:relative;float:left; width:50%;height:100%;margin-top:10%;">
					<div class="list fl" style="margin-top:0;">
						<h2 style="font-size:34px;">千万家庭的信赖</h2>
						<h2 style="font-size:34px;">匠心工艺 良心铸造</h2>
						<h2 style="font-size:22px; font-weight:normal; margin-top:10%;text-align:left;">从材料、施工保护，基层、隐蔽、面层以及整体装饰</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;">效果的呈现进项全质量把控，针对每一个环节进行预</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;">验收及正式验收，保障承接范围内所有细节符合甚至</h2>
						<h2 style="font-size:22px; font-weight:normal;text-align:left;">高于行业标准</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第9屏结束-->
		<div class="scroll protection8 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic  pa" style="background-image: url(imagesbg/10.jpg);">
				
					<div class="top fr" style="float:left; margin-top:10%;margin-left:21%; width:50%;">
						<h2 style="font-size:37px; color:#000;">八重质检体制</h2>
						<p style="font-size:22px;color:#fff; margin-top:10%;color:#000;">
						● 工人自检 </br>
						● 工长初检</br>
						● 工程管家复检 </br>
						● 工程部质检 </br>
						●分公司总经理抽检</br>
						● 区域质检巡检 </br>
						● 集团质控抽检  </br>
						● 总裁巡查 </br>
						</p>
					</div>
					
				</div>
			</div>
			
		</div>
		<!--第10屏结束-->
			<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/11.jpg);">
				
				<div class="box" style="z-index:999; position:relative;float:right; width:50%;height:100%;margin-top:10%;">
					<div class="list fl" style="">
						<h2 style="font-size:34px;">品质管理专著</h2>
						<h2 style="font-size:22px; font-weight:normal; margin-top:10%;">《无忧工程施工规范指导手册》《无忧工程形象手册》</h2>
						<h2 style="font-size:22px; font-weight:normal;">《无忧工程材料手册》《无忧工程施工标准视频》</h2>
						<h2 style="font-size:22px; font-weight:normal;">《质量简报》《工程岗位工作执行手册》</h2>
						<h2 style="font-size:22px; font-weight:normal;">《品质工艺标准执行手册》</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第11屏结束-->
		<div class="scroll protection8 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic  pa" style="background-image: url(imagesbg/12.jpg);">
				
					<div class="top fr" style="float:left; margin-top:10%;width:50%;">
						<h2 style="font-size:37px; color:#000; text-align:right; margin-right:10%;">工程研发</h2>
						<p style="font-size:22px;color:#000; margin-top:10%; text-align:left; margin-left:40%;">
						工艺研发：投入大量的人力物力对装修的七大工种进</br>
						行技术改进和研发</br>
						工具研发：不断研发或引进先进高科技检测设备，如</br>
						红外线投线仪、标准测距仪、湿度测量仪、弱电线路</br>
						信号衰弱检测器等。</br>
						工艺专利：申请市专利10余项</br>
						
						</p>
						<ul class="clearfix" style="margin-top:2%;text-align:right; margin-left:40%;">
							<li class="fl pr" style="border:none; margin-right:1%;text-align:right; ">
								<img src="images/p1.png" width="133px" height="191px"/>
							</li>
							<li class="fl pr" style="border:none;margin-right:1%;text-align:right; ">
								<img src="images/p2.png" width="133px" height="191px"/>
							</li>
							<li class="fl pr" style="border:none;text-align:right; ">
								<img src="images/p3.png" width="133px" height="191px"/>
							</li>
						</ul>
					</div>
					
					<div class="box" style="width:50%;height:100%;float:left; margin-top:5%;">
					<div class="list fl" style="z-index:999; ">
						<ul class="clearfix">
								<li class="fl pr" style="border:none; width:170px; height:196px;">
								<img src="images/g1.png" width="170px" height="196px"/>
							</li>
								<li class="fl pr" style="border:none; width:170px; height:196px;">
								<img src="images/g2.png" width="170px" height="196px"/>
							</li>
								<li class="fl pr" style="border:none; width:170px; height:196px;">
								<img src="images/g3.png" width="170px" height="196px"/>
							</li>
								<li class="fl pr" style="border:none; width:170px; height:196px;">
								<img src="images/g4.png" width="170px" height="196px"/>
							</li>
						</ul>
					</div>
					</div>
			
				</div>
			</div>
			
		</div>
		<!--第12屏结束-->
		
		
	
		<div class="scroll protection10 clearfix protection_box pr section">
			<style>
			#div1{
			z-index:9999999;
			display: none;
			position: absolute;
			left:40%;
			top:30%;
			width:450px;
			height:250px;
			background-color:#fff;
			text-align: center;
			padding-bottom:2%;
			}
			#div1 label{font-size:16px;}	 
			#div1 input{border:1px gray solid;font-size:16px;}	 
			.mx{width:300px;line-height:35px;}
			#div1 form{padding:5px 5px; margin:0px auto; margin-left:12%; }
			</style>
			<script>
			function OpenDiv(){
			document.getElementById("div1").style.display="block";
			document.getElementById("open").style.display="none";
			}
			//给div层中的关闭添加onclick事件：
			function CloseDiv(){
			document.getElementById("div1").style.display="none";
			document.getElementById("open").style.display="block";
			}
			</script>
			<div id="div1">
			<div style="color:#000;font-size:28px;">预约参观工地</div>
			<div style="clear:both;"></div>
			<form id="form_tan" method="post" action="#">

			<div class="mx">
			<label><i>* </i>楼盘名字：</label>
			<input type="text" name="hourse" id="hourse_tan">
			</div>
			<div class="mx">
			<label><i>* </i>您的名字：</label>
			<input type="text" name="name" id="name_tan">
			</div>
			<div class="mx">
			<label><i>* </i>联系电话：</label>
			<input type="tel" name="mobile" id="mobile_tan">
			</div>
			<div class="mx" style="padding-left:10%">

				<div style="float:left;"><label><i>* </i>验 证 码：</label>
					<input type="text" class="text text2" placeholder="验证码" name="code" id="verify_tan" style="width:80px;" />
				</div>
				<div style="float:left;">
					<img  src="/code.php" onclick="this.src+='?rand='+Math.random();" />
				</div>
			</div>
			<input type="hidden" name="action" value="add47" />
			<input type="hidden" name="company_id" value="0">
			<div style="clear:both;"></div>
			<p class="mx"><font style="text-align: center;" color="red" size="-1" id="cmresult_tan"></font></p>
			
			<input style="font-size:14px;padding:3px;margin-top:2%;" type="submit" name="submit" class="submit" value="立即提交" />
			<a style="margin-left:2%;" href="javascript:CloseDiv();"><input style="font-size:14px;padding:3px;margin-top:2%;" type="button" name="guanbi" value="关闭" /></a>
			</form>
			</div>
			<div class="pic pa" style="border-radius:inherit; width:788px;height:122px; border:none; left:40%;" ><img src="images/kf.png" width="100%" height="100%" /></div>
			<p style="bottom:45%;">保修及跟踪服务24小时到位，一年2次定期回访</p>
			<p style="bottom:40%;">预约参观工地热线：<span style="color:#EEBC04";>400-040-2005</span></p>
			<p style="bottom:30%;left:45%;"><img src="images/anniu.jpg"  onclick="javascript:OpenDiv();" id="open" align="center"/></p>
		</div>
		
		<!--第10屏结束-->
		
		<div class="scroll protection11 clearfix protection_box pr section fp-auto-height">

			
		<div class="leader_more">
			
			<div class="pic fl pa" style="background-image: url(imagesbg/protection_pic211.jpg);">
				<div style="width:100%;z-index:999; position:relative; top:5%;">
					<span style="z-index:999; position:relative; left:47%; top:10%; color:#fff;font-size:35px;">-售后无忧-</span>
					
				</div>
				
				<style>
			#div2{
			z-index:9999999;
			display: none;
			position: absolute;
			left:40%;
			top:30%;
			width:450px;
			height:250px;
			background-color:#fff;
			text-align: center;
			padding-bottom:2%;
			}
			#div2 label{font-size:16px;}	 
			#div2 input{border:1px gray solid;font-size:16px;}	 
			.mx{width:300px;line-height:35px;}
			#div2 form{padding:5px 5px; margin:0px auto; margin-left:12%; }
			</style>
			<script>
			function OpenDiv1(){
			document.getElementById("div2").style.display="block";
			document.getElementById("open1").style.display="none";
			}
			//给div层中的关闭添加onclick事件：
			function CloseDiv1(){
			document.getElementById("div2").style.display="none";
			document.getElementById("open1").style.display="block";
			}
			</script>
			<div id="div2">
			<div style="color:#000;font-size:28px;">售后登记</div>
			<div style="clear:both;"></div>
			<form id="form_tan" method="post">

			<div class="mx">
			<label><i>* </i>楼盘名字：</label>
			<input type="text" name="hourse" id="hourse_tan">
			</div>
			<div class="mx">
			<label><i>* </i>您的名字：</label>
			<input type="text" name="name" id="name_tan">
			</div>
			<div class="mx">
			<label><i>* </i>联系电话：</label>
			<input type="tel" name="mobile" id="mobile_tan">
			</div>
			<div class="mx" style="padding-left:10%">

				<div style="float:left;"><label><i>* </i>验 证 码：</label>
					<input type="text" class="text text2" placeholder="验证码" name="code" id="verify_tan" style="width:80px;" />
				</div>
				<div style="float:left;">
					<img  src="/code.php" onclick="this.src+='?rand='+Math.random();" />
				</div>
			</div>
			<input type="hidden" name="company_id" value="0">
			<div style="clear:both;"></div>
			<p class="mx"><font style="text-align: center;" color="red" size="-1" id="cmresult_tan"></font></p>
			<input type="hidden" name="action" value="add47" />
			<input style="font-size:14px;padding:3px;margin-top:2%;" type="submit" name="submit" class="submit" value="立即提交" />
			<a style="margin-left:2%;" href="javascript:CloseDiv1();"><input style="font-size:14px;padding:3px;margin-top:2%;" type="button" name="guanbi" value="关闭" /></a>
			</form>
			</div>
				
				<div class="yt">
					<div class="yy" style="margin-left:4%;" >
						<img src="images/y1.png" />
						<p>初心</p>
						<p class="yp">专注品味装饰21年</p>
					</div>
					<div class="yy" >
						<img src="images/y2.png" />
						<p>匠心</p>
						<p class="yp">7大工种<br/>
						365道施工工序</p>
					</div>
					<div class="yy" >
						<img src="images/y3.png" />
						<p>省心</p>
						<p class="yp">三重服务<br/>七重质检体制</p>
					</div>
					<div class="yy" >
						<img src="images/y4.png" />
						<p>放心</p>
						<p class="yp">100+国际一线品牌战略合作</p>
					</div>
					<div class="yy" >
						<img src="images/y5.png" />
						<p>舒心</p>
						<p class="yp">200万家庭的信赖</p>
					</div>
				</div>
				
				<div style="z-index:999; position:relative; left:43%; top:5%; color:#fff; width:350px;"><p style="font-size:22px;">售后服务热线：<span style="color:#F8C302;">400-628-1968</span></p>
				<p style="margin-left:5%; margin-top:5%;"><img src="images/anniu2.jpg" onclick="javascript:OpenDiv1();" id="open1"  align="center"/></p></div>
			</div>
		</div>
		<div class="container banner-ad"  id="js-show-ad"></div>
		<script src="js/jquery-1.9.1.min.js"></script>
		<!--底部/e-->
		</div>
	</div>
		

	
		
		<!--底部/e-->
		<!--右侧悬浮导航/s-->
		<div class="fixed-right-nav">
    <a href="javascript:window.scroll(0,0)" class="backtop"><i></i></a>
	<a href="http://wpa.qq.com/msgrd?v=3&uin=2547410506&site=qq&menu=yes" target="_blank" onclick="move();" class="msg"><i></i>免费咨询</a>
	  <!--<a href="" style="background: url(imagesbg/car.png) no-repeat 28px 8px;background-color:#f1544b;line-height:70px;" target="_blank"><i></i>免费到店</a>-->
		<a href="#" onclick="order_show();" class="decora"><i></i>我要装修</a>
   <!-- <a class="qrcode"><i></i><div class="qrcodePic"><img width="150" height="150" src=""></div></a>-->
</div>

<script>
function move(){
	ja.trackEvent('enterim');
	zhuge.track('点击咨询');
	doyoo.util.openChat('g=10059956');return false;
}
</script>
		<!--右侧悬浮导航/e-->
	<script src="js/jquery-1.9.1.min.js"></script> 
	<script src="js/public.js"></script> 
	<script src="js/sea.js" id="seajsnode"></script>
	<script src="js/jquery.slimscroll.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.fullpage.min.js" type="text/javascript" charset="utf-8"></script> 
	<script src="js/header.js"></script>
	<script src="js/ad_common.js"></script>
	
	<script type="text/javascript">
		//头部基础脚本
		A6.headFn();
		//底部计算器
		A6.counter();
		show_ad('100000','js-show-ad');
		//导航收缩
		$(function() {
					$('.quality_cont').fullpage({
						scrollOverflow: true,
						verticalCentered:true,
						css3: true,
						verticalCentered: true,
						navigation: true,
						navigationPosition:'left',
						navigationColor:'#fff',
						navigationTooltips:circle_data
					});
					$('.swiper_content .title span').click(function() {
						if ($(this).hasClass('on')) {
							return false;
						} else {
							$(this).addClass('on').siblings().removeClass('on');
							var index = $(this).index();
							$(this).parents('.swiper_content').find('li').fadeOut().eq(index).fadeIn();
						};
					});
					var yhw = {
						num: function() {
							yhw.height = $(window).height()-170;
							$('.footer_content').css({
								height: yhw.height - $('.footer_num').height() < 0 ? 0 : yhw.height - $('.footer_num').height()
				
							})
						}
					};
				$('.backtop').click(function(){
						$.fn.fullpage.moveTo(1,0);
					});
				
				});
		</script>

		
</body>
</html>