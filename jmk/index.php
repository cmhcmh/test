<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:wap");die();
}
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '金马克PC版';
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
@$content = '金马克PC版'.$_POST['content'];
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
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='/ppsl/'</script>";die();
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
	<title>金马克杯</title>
	<link rel="stylesheet" type="text/css" href="css/public.css" />
	<link rel="stylesheet" href="css/jquery.mcustomscrollbar.css">
	<link rel="stylesheet" type="text/css" href="css/css.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fullpage.css" />
	<script src="js/bilin.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/jquery.js" type="text/javascript" charset="utf-8"></script>
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
	
}


</style>
<script>
//给div层中的关闭添加onclick事件：
function CloseDiva(){
document.getElementById("item1 bo_Box").style.display="none";
}
</script>
<script type="text/javascript">
	var circle_data=['首屏','1','2','3','4','5','6','7','8','9','10','11'];
</script>
<style>
	.pull-left li{border:none!important;}
</style>

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
				 <div class="mx" style="padding-left: 227px;">
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
            	<a href="#" class="nav-menu">品牌实力</a>
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
                     <a href="/gy/">精湛工艺</a>
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
			<div class="cont pa pr" style="background:none; margin:0; border:none; left: 50%; top:25%; width:900px;margin-left:-350px;">
				<img src="images/protection_pic1.png"/>
			</div>
		</div>
		<!--第1屏结束-->
		<div class="scroll protection2 clearfix protection_box section">
			<div class="cont pr fl pr">
				<div class="pic pa" style="background-image: url(imagesbg/1.jpg);">
					<div class="box"style="float:left; width:50%;height:100%;">
						<!--<div class="top fl" >
							<h2>中国大型家居产业集团</h2>
							<p>广东华浔品味装饰集团成立于1998年，经过21年的发展，拥有全国300多家直营机构，品牌服务网点遍及20个省、直辖市、自治区的200余座城市，全国累积客户量达200多万户，赢得了良好的用户口碑。与全国几十所高校建立校企合作关系，凝聚了高端设计人才和技术管理精英</p>
						</div>-->
					</div>
					<div class="box"  style="float:left;text-align:left;width:50%;height:100%; margin-top:10%;">
					<div class="list fl">
						<h2 style="font-size:34px;color:#f8e280;">何为“金马克”？</h2>
						<h2 style="font-size:17px; font-weight:normal;color:#f8e280;">
“金马克”室内设计大赛是广东华浔品味装饰集团举<br/>办的专业设计大赛，大赛坚持以人为本、设计有爱<br/>的理念，旨在发现创新设计，提升设计的魅力，并为广<br/>大设计专业人士提供交流、展示、切磋的平台。金马<br/>克大赛聚集华浔三百家分公司，五千余名设计师及合<br/>作院校的学生作为参赛对象，行业国内外顶尖专业人<br/>士进行评审。大赛自2011年成功举办首届以来，每两<br/>年举办一届，至今为止，已经成功举办四届，赢得了<br/>业界权威人士的认可与盛誉，在业内极具影响力。</h2>
					</div>
					</div>
				</div>
			</div>
			
		</div>
		<!--第2屏结束-->
		<div class="scroll protection3 clearfix protection_box green section">
			<div class="cont fr pr">
				<div class="pic pa" style="background-image: url(imagesbg/2.jpg);">
					<div class="box" style="z-index:999; position:relative;float:left; left:50%;top:10%;">
					<div class="list fl">
						
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
					<div class="top fr" style="z-index:999; position:relative;float:left;width:50%;margin-left:0; left:20%;transform: translate(0, -60%);">
					
					</div>
					<div class="list fr" style="z-index:999; position:relative;float:left;margin-left:0;width:50%; min-width:570px;">
						
					</div>
				</div>
				
				</div>
			</div>
			
		</div>
		<!--第4屏结束-->
		<div class="scroll protection5 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/4.jpg);">
					<div class="box" style="width:50%;height:100%;float:left;">
					<div class="list fl" style="z-index:999; position:relative;float:right;margin-right:5%; margin-top:22%; ">
						
					</div>
				</div>
				<div class="box" style="z-index:999; position:relative;float:left;width:50%;height:100%;float:left;">
					
				</div>
				</div>
			</div>
		
		</div>
		<!--第5屏结束-->
		<div class="scroll protection6 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic fl pa" style="background-image: url(imagesbg/5.jpg);">
				<div class="box" style=" width:50%; float:left;">
					
					
				</div>
				<div style="float:left; position:relative; z-index:9999;bottom:52%;left:2%; margin-left:50%;width:50%;">
				
				</div>
				</div>
			</div>
			
		</div>
		<!--第6屏结束-->
		<div class="scroll protection7 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic pa" style="background-image: url(imagesbg/6.jpg);">
				<div class="box" style="z-index:999; position:relative;float:left; left:5%;">
					<div class="list fl" style="margin-top:45%; color:#f8e280;">
						<h2 style="font-size:40px;color:#f8e280;">“雨虹杯”第四届金马克室内</h2>
						<h2 style="font-size:40px;color:#f8e280;">设计大赛颁奖盛典现场回顾</h2>
						<h2 style="font-size:22px;color:#f8e280; font-weight:normal;margin-top:10%;">2017年8月28日，由华浔品味装饰集团主办、广东省陈<br/>设艺术协会协办的“雨虹杯”第四届金马克室内设计大<br/>赛颁奖盛典于广州四季酒店隆重举行，本届大赛以“玩<br/>味设计”为主题，以“设计好玩，玩好设计”为理念，<br/>主张设计师以“玩乐”心态进行创作。众多行业顶尖<br/>大咖出席大赛盛典，引起社会各界的高度关注。</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第7屏结束-->
		<div class="scroll protection8 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic  pa" style="background:#111010; margin:0px auto;">
				
					<script>
						$(function(){
							var oDemo=$("#demo-erbox li");
								for(var i=0;i<oDemo.length;i++){
									oDemo.hover(function(){
										for(var i=0;i<oDemo.length;i++){
											oDemo.children("img").css("display","none");
											oDemo.children("p").css("display","block");
										}
										$(this).children("img").css("display","block");
										$(this).children("p").css("display","none");
								});
							};
							
						})
						/*$(function(){
							$(".img-box").hover(function(){
								alert("11");
							})
						})*/
					</script>
					<style>
						#demo-erbox p{
							 color:#f8e280;
						}
						#demo-erbox i{
							 font-size: 30px;position: absolute; z-index: 99999999;writing-mode:tb-rl;    font-style: normal;left:10px; top:100px;line-height: 30px;
						}
						
					</style>
					<ul id="demo-erbox">
						<li style="background:url(imagesbg/lj0.png) no-repeat center center; float: left;height: 940px;width: 124px; margin-left:1%;">
						<i style="top:250px;">
						<p style="font-size: 26px;position: absolute; z-index: 99999999;writing-mode:tb-rl;right:100px;padding-right:100px;color:#fff;">
						<span style="display：block"></span>
						</p>
						</i>
						<p></p>
						
						</li>
						<!--从这里开始-->
						<li style="background:#1B1B1B;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:0;">
							<i style="">
							<font style="font-size:14px;">中国家装教父、联合国国际生态生命安全科学院院士 、IFDA国际室内装饰协会中国区副会长 </font><br/>余静赣余工
							</i>
						</p>
						
						<img src="imagesbg/j1.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#111010;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">米兰理工大学教授、意大利石材协会会长</font><br/>Massimiliano Caviasca 马西利亚诺. 卡维斯卡
							</i>
						</p>
						<img src="imagesbg/j2.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#1B1B1B;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">广州市建筑装饰协会会长</font><br/>倪安葵
							</i>
						</p>
						<img src="imagesbg/j3.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#111010;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">广东省陈设艺术协会会长、中国建筑装饰协会设计委员会副主任
中国室内装饰协会设计专业委员会委员  </font><br/>吴宗敏 
							</i>
						</p>
						
						<img src="imagesbg/j4.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#1B1B1B;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">GACDI广东省陈设艺术协会执行会长、CIDA中国室内装饰协会设计委员会副秘书长
CIID中国建筑学会室内设计分会第九专委会（广州）秘书长、GDSJS广东设计师交流中心主任  </font><br/>胡小梅 
							</i>
						</p>
						
						<img src="imagesbg/j5.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#111010;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">台湾著名生活美学大师、亚洲皇室美学大师、台湾顶级氛围营造大师</font><br/> 齐云 
							</i>
						</p>
						
						<img src="imagesbg/j6.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#1B1B1B;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">广东省环境艺术设计行业协会副会长、广东省陈设艺术协会常务理事
CDI创思国际建筑师事务所创始人</font><br/>覃思
							</i>
						</p>
						
						<img src="imagesbg/j7.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#111010;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">广东省环境艺术设计行业协会副会长、中国建筑学会室内设计分会广州专业委员会副会长
中国建筑学会室内设计分会理事、广州市思哲设计院有限公司总设计师</font><br/> 罗思敏 
							</i>
						</p>
						
						<img src="imagesbg/j8.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#1B1B1B;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">米兰NAD新设计学院院长</font><br/> Nicola Pighi  
							</i>
						</p>
						
						<img src="imagesbg/j9.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#111010;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">中国建筑装饰协会设计委员会副主任委员
广州市建筑装饰行业协会设计委员会副主任委员、高级室内设计师</font><br/> 陈立坚 
							</i>
						</p>
						
						<img src="imagesbg/j10.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#1B1B1B;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">广州市科学技术协会常委、广州市社会科学界联合会常委、
南方民间智库专家委员会副主席、广州市博士科技创新研究会会长</font><br/> 彭澎 
							</i>
						</p>
						
						<img src="imagesbg/j11.png" style="height:100%;display:none;" />
						</li>
						<li style="background:#111010;float: left;height: 940px;width: 124px; position:relative;">
						<p style="top:200px;">
							<i style="">
							<font style="font-size:14px;">中国建筑装饰协会理事、高级室内设计师、华浔集团总设计师 </font><br/>  刘晓萍 
							</i>
						</p>
						
						<img src="imagesbg/j12.png" style="height:100%;display:none;" />
						</li>
					</ul>
					
				</div>
			</div>
			
		</div>
		<!--第8屏结束-->
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/8.jpg);">
				<div class="box" style="width:50%;height:100%;float:left; padding:0;">
					
					<div class="list fl" style="width:500px; margin-top:25%; margin-left:40%; height:auto;color:#f8e280;">
						<h2 style="font-size:34px;text-align:left;color:#f8e280;">历届金马克优秀案例赏析</h2>
						<ul class="clearfix"style="width:500px;color:#f8e280;">
						
							<li class="fl pr" style="border:none; margin:0; height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/5749">
								<img src="imagesbg/81.png" width="231px" height="150px"/>
								<span>▲ 华南碧桂园翠云山</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/13019">
								<img src="imagesbg/82.png" width="231px" height="150px"/>
								<span>▲ 君汇世家</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12238">
								<img src="imagesbg/83.png" width="231px" height="150px"/>
								<span>▲ 万科朗润园</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0; height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12214">
								<img src="imagesbg/84.png" width="231px" height="150px"/>
								<span>▲ 雪岭仙山别墅</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				
				</div>
			</div>
			
		</div>
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/81.jpg);">
				<div class="box" style="width:50%;height:100%;float:right; padding:0;">
					
					<div class="list fl" style="width:500px; margin-top:25%; margin-right:25%; height:auto;">
						<h2 style="font-size:34px;text-align:left;color:#f8e280;">历届金马克优秀案例赏析</h2>
						<ul class="clearfix"style="width:500px;color:#f8e280;">
						
							<li class="fl pr" style="border:none; margin:0; height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12222">
								<img src="imagesbg/9-1.png" width="231px" height="150px"/>
								<span>▲ 江厝韵</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/2474">
								<img src="imagesbg/9-2.png" width="231px" height="150px"/>
								<span>▲ 三盛中央</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12248">
								<img src="imagesbg/9-3.png" width="231px" height="150px"/>
								<span>▲ 猫扑咖啡</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0; height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12279">
								<img src="imagesbg/9-4.png" width="231px" height="150px"/>
								<span>▲ 金色家园</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				
				</div>
			</div>
			
		</div>
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/888.jpg);">
				<div class="box" style="width:50%;height:100%;float:left; padding:0;">
					
					<div class="list fl" style="width:500px; margin-top:25%; margin-left:40%; height:auto;">
						<h2 style="font-size:34px;text-align:left;color:#f8e280;">历届金马克优秀案例赏析</h2>
						<ul class="clearfix"style="width:500px;color:#f8e280;">
						
							<li class="fl pr" style="border:none; margin:0; height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12287">
								<img src="imagesbg/10-1.png" width="231px" height="150px"/>
								<span>▲ 丽雅龙城</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/1600">
								<img src="imagesbg/10-2.png" width="231px" height="150px"/>
								<span>▲ 嘉和城·蒙特利岛复式楼</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/771">
								<img src="imagesbg/10-3.png" width="231px" height="150px"/>
								<span>▲ 丽影广场会所</span>
								</a>
							</li>
							<li class="fl pr" style="border:none; margin:0; height:150px;">
								<a target="_blank" style="color:#f8e280;" href="http://hxdec.com/index.php/Case/detail/id/12241">
								<img src="imagesbg/10-4.png" width="231px" height="150px"/>
								<span>▲ 富力盈信办公空间</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				
				</div>
			</div>
			
		</div>
		<!--第9屏结束-->
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
			
				<div class="pic fl pa" style="background-image: url(imagesbg/activity_service_bg.jpg);">
				<div class="top fr" style="float:right; margin-top:15%;margin-right:19%; width:50%;">
						<h2 style="font-size:37px; color:#ED7020;text-align:right;color:#f8e280;">“金马克”日益增强的影响力</h2>
						<p style="font-size:22px;color:#fff; margin-top:5%; text-align:right;color:#f8e280;">10，000，000+名家居行业人的关注<br/>
1，000，000+装修客户参考的装饰风向标<br/>
20000+名华浔人对大赛全程关注<br/>
5000+名精英设计师的直接参赛<br/>
300+家华浔集团直营公司对大赛的参与<br/>
2000+名设计师、设计名人汇聚颁奖现场<br/>
几十家国内大众及专业媒体对大赛进行全场播报</p>
				</div>
				
				
				</div>
			</div>
			
		</div>
		<!--第9屏结束-->
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
			
				<div class="pic fl pa" style="background-image: url(imagesbg/activity_service_bg2.jpg);">
				
				
				
				</div>
			</div>
			
		</div>
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
			
				<div class="pic fl pa" style="background-image: url(imagesbg/activity_service_bg3.jpg);">
				
				
				
				</div>
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
		//A6.counter();
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