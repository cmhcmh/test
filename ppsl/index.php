<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:wap");die();
}
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '品牌实力PC版';
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
@$content = '品牌实力PC版'.$_POST['content'];
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
	<title>品牌实力</title>
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
                    <a href="#">品牌介绍</a> 
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
            	<a href="/gy/" class="nav-menu">无忧工程</a>
            	<div class="sub-menu"> 
                     <a href="/clzt/">环保材料</a>
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
			<div class="cont pa pr" style="background:none; margin:0; border:none; left: 50%; top:32%; width:700px;margin-left:-350px;">
				<img src="images/protection_pic1.png"/>
			</div>
		</div>
		<!--第1屏结束-->
		<div class="scroll protection2 clearfix protection_box section">
			<div class="cont pr fl pr">
				<div class="pic pa" style="background-image: url(imagesbg/1.jpg);">
					<div class="box"style="float:left; width:50%;height:100%;">
						<div class="top fl" >
							<h2>中国大型家居产业集团</h2>
							<p>广东华浔品味装饰集团成立于1998年，经过21年的发展，拥有全国300多家直营机构，品牌服务网点遍及20个省、直辖市、自治区的200余座城市，全国累积客户量达200多万户，赢得了良好的用户口碑。与全国几十所高校建立校企合作关系，凝聚了高端设计人才和技术管理精英</p>
						</div>
					</div>
					<div class="box"  style="float:left;text-align:left;width:50%;height:100%; margin-top:10%;">
					<div class="list fl">
						<h2 style="font-size:34px;">华浔品味装饰</h2>
						<h2 style="font-size:42px;">美好生活 从品味开始</h2>
						<h2 style="font-size:17px; font-weight:normal;">Huaxun taste decoration</br>Good life  begins with taste</h2>
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
						<h2 style="font-size:40px;">200+项品牌荣誉</h2>
						<h2 style="font-size:40px;">每年增加30余项荣誉</h2>
						<h2 style="font-size:22px; font-weight:normal;">亚洲装饰业质量服务信得过企业</h2>
						<h2 style="font-size:22px; font-weight:normal;">亚洲装饰业优秀设计奖</h2>
						<h2 style="font-size:22px; font-weight:normal;">全国住宅装饰装修行业质量、服务、诚信五星级企业</h2>
						<h2 style="font-size:22px; font-weight:normal;">全国住宅装饰装修AAAA诚信企业</h2>
						<h2 style="font-size:22px; font-weight:normal;">全国住宅装饰装修行业知名品牌企业</h2>
						<h2 style="font-size:22px; font-weight:normal;">广东省“守合同 重信用”企业（2010-2016）</h2>
						<h2 style="font-size:22px; font-weight:normal;">广东省著名商标</h2>
						<h2 style="font-size:22px; font-weight:normal;">专项设计乙级资质</h2>
						<h2 style="font-size:22px; font-weight:normal;">专项施工二级资质</h2>
						<h2 style="font-size:22px; font-weight:normal;">......</h2>
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
						<h2 style="font-size:32px;">出版50+册设计类专著</h2>
						<h2 style="font-size:32px;">500+项设计类荣誉</h2>
						<p style="font-size:20px; margin-top:10%;">《刘晓萍室内装饰作品集》《设计启示录》<br/>
						《心智空间》《巴厘岛印象》《欧洲印象》<br/>
						《日本印象》《西班牙印象》《品味设计》<br/>
						《品味经典》《品味生活》《品味创意》<br/>
						《品味匠心》《品味空间》<br/>
						《客厅系列·欧式风格》《客厅系列·中式风格》<br/>
						《客厅系列·美式风格》《客厅系列·地中海风格》<br/>
						《客厅系列·简约风格》《客厅系列·现代风格》<br/>
						</p>
					</div>
					<div class="list fr" style="z-index:999; position:relative;float:left;margin-left:0;width:50%; min-width:570px;">
						<ul class="clearfix"style="width:570px;">
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0; margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s1.png" width="185px" height="126px"/>
								<!--<p class="pa">德国EGGE OSB板</p>-->
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0; margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s2.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0; margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s3.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0; margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s4.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s5.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s6.png" width="185px" height="126px"/>
							</a></li>
						</ul>
						<ul class="clearfix" style="width:380px; float:left;">
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s7.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s8.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s9.png" width="185px" height="126px"/>
							</a></li>
								<li class="fl pr" style="padding: 0px;width: 185px;height: 126px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;"><a href="" >
								<img src="images/s10.png" width="185px" height="126px"/>
							</a></li>
						</ul>
						<ul style="width: 185px;float:left;height: 262px;">
							<li class="fl pr" style="padding: 0px;width: 185px;height: 262px;border: none; margin: 0;margin-right:5px; margin-bottom:5px;">
							<a href=""  style="height:auto;">
								<img src="images/s11.png" width="185px" height="262px"/>
							</a></li>
						</ul>
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
				<div class="box" style="z-index:999; position:relative;float:left;width:50%;height:100%;float:left;">
					<div class="list fl" style="margin-left: 17%;margin-top:22%;">
						<h2 style="font-size:34px;">21年粤派精工</h2>
						<h2 style="font-size:22px;">郑重承诺：所有工程决不转包</h2>
						<h2 style="font-size:22px; font-weight:normal; margin-top:10%;">行业首推7大工种</h2>
						<h2 style="font-size:22px; font-weight:normal;">365道工序</h2>
						<h2 style="font-size:22px; font-weight:normal;">1998个工艺节点</h2>
						<h2 style="font-size:22px; font-weight:normal;">7重质检体制</h2>
						<h2 style="font-size:22px; font-weight:normal;">荣获多项技术专利</h2>
						<h2 style="font-size:22px; font-weight:normal;">为您打造高于行业标准的无忧工程</h2>
						<a href="http://hxdec.com/gy"><div style="line-height:60px; width:275px; color:#fff;font-size:22px; background-color:#1B1B1B;text-align:center;float:right;margin-top:5%;">无忧工程 ></div></a>
					</div>
				</div>
				</div>
			</div>
		
		</div>
		<!--第5屏结束-->
		<div class="scroll protection6 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic fl pa" style="background-image: url(imagesbg/5.jpg);">
				<div class="box" style=" width:50%; float:left;">
					<div class="top fr" style="float:right; margin:0; margin-right:5%; margin-top:15%;">
						<h2 style=" font-size:26px;">拥有自己的独家设计大赛和4大培训研究基地</h2>
						<p style="font-size:20px:">
						<span style="color:#ED7020;">金马克”室内设计大赛</span>-行业大咖云集  设计精英荟萃</br>
						<span style="color:#ED7020;">H&A米兰国际设计院</span>-促进国际设计交流与培训</br>
						<span style="color:#ED7020;">江西美术专修学院</span>-华浔自己的设计培训学院</br>
						<span style="color:#ED7020;">运杰商学院</span>-与全国各大知名院校合作的培训商学院</br>
						<span style="color:#ED7020;">华浔设计研究院</span>-华浔自己的设计研究机构</p>
						<a href="#"><div style="line-height:60px; width:275px; color:#fff;font-size:22px; background-color:#ED7020;text-align:center;float:left;margin-top:5%;">“金马克”室内设计大赛 ></div></a>
						<div style="clear:both"></div>
						<a href="http://www.hamilan.cn"><div style="line-height:60px; width:275px; color:#fff;font-size:22px; background-color:#ED7020;text-align:center;float:left;margin-top:5%;">集团设计院 ></div></a>
						
					</div>
					
				</div>
				<div style="float:left; position:relative; z-index:9999;bottom:52%;left:2%; margin-left:50%;width:50%;">
				<ul style="width:600px;">
					<li class="fl pr" style="border:none; width:273px; height:196px;margin-right:2%;margin-bottom:7%;">
						<img src="images/j1.png" width="273px" height="196px"/>
						<p style="color:#fff;font-size:16px;text-align:center;">▲ H&A米兰国际设计院</p>
					</li>
						<li class="fl pr" style="border:none; width:273px; height:196px;margin-right:2%;margin-bottom:7%">
						<img src="images/j2.png" width="273px" height="196px"/>
						<p style="color:#fff;font-size:16px;text-align:center;">▲ 江西美术专修学院</p>
					</li>
						<li class="fl pr" style="border:none; width:273px; height:196px;margin-right:2%;">
						<img src="images/j3.png" width="273px" height="196px"/>
						<p style="color:#fff;font-size:16px;text-align:center;">▲ 华浔运杰商学院</p>
					</li>
						<li class="fl pr" style="border:none; width:273px; height:196px;margin-right:2%;">
						<img src="images/j4.png" width="273px" height="196px"/>
						<p style="color:#fff;font-size:16px;text-align:center;">▲ 华浔设计研究院</p>
					</li>
				</ul>
				</div>
				</div>
			</div>
			
		</div>
		<!--第6屏结束-->
		<div class="scroll protection7 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic pa" style="background-image: url(imagesbg/6.jpg);">
				<div class="box" style="z-index:999; position:relative;float:left; left:53%;">
					<div class="list fl" style="margin-top:45%;">
						<h2 style="font-size:40px;">全球知名品牌合作</h2>
						<h2 style="font-size:40px;">提供整体家装解决方案</h2>
						<h2 style="font-size:22px; font-weight:normal;margin-top:10%;">100+全球知名品牌合作</h2>
						<h2 style="font-size:22px; font-weight:normal;">2000多种家装常用材料采购、检验、储存</h2>
						<h2 style="font-size:22px; font-weight:normal;">出库、运输的专业全球产业链</h2>
						<h2 style="font-size:22px; font-weight:normal;">打造品味的家居生活</h2>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第7屏结束-->
		<div class="scroll protection8 clearfix protection_box section">
			<div class="cont fl pr">
				<div class="pic  pa" style="background-image: url(imagesbg/7.jpg);">
				
					<div class="top fr" style="float:left; margin-top:10%;margin-left:8%; width:50%;">
						<h2 style="font-size:37px; color:#ED7020;">生态工艺   健康环保</h2>
						<p style="font-size:22px;color:#fff; margin-top:10%;">不断研发并升级生态工艺，甄选国内、国际知名品牌</br>材料合作商，材料健康环保，施工更有保障。</p>
						<ul class="clearfix" style="margin-top:10%;">
							<li class="fl pr" style="border:none; margin-right:1%;">
								<img src="images/p1.png" width="249px" height="155px"/>
							</li>
							<li class="fl pr" style="border:none;">
								<img src="images/p2.png" width="249px" height="155px"/>
							</li>
						</ul>
					</div>
					
			
				</div>
			</div>
			
		</div>
		<!--第8屏结束-->
		
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
				
				<div class="pic fl pa" style="background-image: url(imagesbg/8.jpg);">
				<div class="box" style="width:50%;height:100%;float:left; padding:0;">
					<div class="list fl" style="width:700px; margin-top:25%; margin-left:10%; height:auto;">
						<ul class="clearfix"style="width:700px;">
							<li class="fl pr" style="border:none; margin:0; height:196px;">
								<img src="images/g11.png" width="171px" height="196px"/>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:196px;">
								<img src="images/g22.png" width="171px" height="196px"/>
							</li>
							<li class="fl pr" style="border:none; margin:0;height:196px;">
								<img src="images/g33.png" width="171px" height="196px"/>
							</li>
							<li class="fl pr" style="border:none; margin:0; margin-left:15%; margin-top:3%;height:196px;">
								<img src="images/g44.png" width="171px" height="196px"/>
							</li>
							<li class="fl pr" style="border:none; margin:0; margin-top:3%;height:196px;">
								<img src="images/g55.png" width="171px" height="196px"/>
							</li>
						</ul>
					</div>
				</div>
				<div class="box" style="z-index:999; position:relative;float:left; width:50%;height:100%;margin-top:10%;">
					<div class="list fl" style="margin-top:0;">
						<h2 style="font-size:34px;">汇聚精英力量   筑造良心工程</h2>
						<h2 style="font-size:22px;">做一个工程，树一个样板</h2>
						<h2 style="font-size:22px; font-weight:normal; margin-top:10%;">20000+产业技术工人</h2>
						<h2 style="font-size:22px; font-weight:normal;">5000+全国工程管家</h2>
						<h2 style="font-size:22px; font-weight:normal;">3000+精英设计师</h2>
						<h2 style="font-size:22px; font-weight:normal;">500+客服精英</h2>
						<h2 style="font-size:22px; font-weight:normal;">200+专家型质检团队</h2>
						<h2 style="font-size:22px; font-weight:normal;">用精雕细琢的“匠心”精神</h2>
						<h2 style="font-size:22px; font-weight:normal;">为您打造一个安心家！</h2>
						<a href="http://hxdec.com/index.php/Page/index/cat_id/27"><div style="line-height:60px; width:275px; color:#fff;font-size:22px; background-color:#1B1B1B;text-align:center;float:right;margin-top:5%;">无忧工程 ></div></a>
					</div>
				</div>
				</div>
			</div>
			
		</div>
		<!--第9屏结束-->
		<div class="scroll protection9 clearfix protection_box green section">
			<div class="cont fr pr">
			
				<div class="pic fl pa" style="background-image: url(imagesbg/activity_service_bg.jpg);">
				<div class="top fr" style="float:left; margin-top:15%;margin-left:10%; width:50%;">
						<h2 style="font-size:37px; color:#ED7020;">全案设计  整装服务  精准施工</h2>
						<p style="font-size:22px;color:#fff; margin-top:5%;">我们提供一站式整装设计，建立客户专属的管家式服务</br>，以1+N的服务团队模式，装修施工和材料管理20</br>年的经验的智慧结晶，精准地服务每一位客户，真正</br>做到让客户省力、省钱、省心。</p>
				</div>
				
				<div style="float:left; position:relative; z-index:9999;bottom:32%;width:50%; margin-left:50%;">
				<style>
					.ul li{margin-right:3%;}
				</style>
				<ul class="ul">
					<li class="fl pr" style="border:none; width:95px; height:95px;">
					<img src="images/n1.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n2.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n3.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n4.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n5.png" width="95px" height="95px"/>
					</li>
				</ul>
				<div style="clear:both;"></div>
				<ul class="ul" style="margin-top:10%;">
					<li class="fl pr" style="border:none; width:95px; height:95px;">
					<img src="images/n6.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n7.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n8.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n9.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n10.png" width="95px" height="95px"/>
					</li>
				</ul>
				<div style="clear:both;"></div>
				<ul class="ul" style="margin-top:10%;">
					<li class="fl pr" style="border:none; width:95px; height:95px;">
					<img src="images/n11.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n12.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n13.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n14.png" width="95px" height="95px"/>
					</li>
					<li class="fl pr" style="border:none; width:95px; height:95px;">
						<img src="images/n15.png" width="95px" height="95px"/>
					</li>
				</ul>
				</div>
				</div>
			</div>
			
		</div>
		<!--第9屏结束-->
		<div class="scroll protection10 clearfix protection_box pr section">
			<h2 style="bottom:75%;">【品质服务 全国联保】</h2>
			<div class="pic pa" ><img src="images/protection_pic2.png" width="100%" height="100%"/></div>
			<p style="bottom:20%;">服务承诺：及时、准确、守时、诚信</p>
			<p style="bottom:15%;">全国咨询热线：400-040-2005（售前）</p>
			<p style="bottom:10%;">全国服务热线：400-628-1968（售后）</p>
		</div>
		
		<!--第10屏结束-->
		
		<div class="scroll protection11 clearfix protection_box pr section fp-auto-height">

			
		<div class="leader_more">
			
			<div class="pic fl pa" style="background-image: url(imagesbg/protection_pic211.jpg);">
				<div style="width:100%;z-index:999; position:relative; top:15%;">
					<span style="z-index:999; position:relative; left:47%; top:10%; color:#fff;font-size:35px;">华浔产业</span>
					<div style="z-index:999; position:relative; left:48%; top:2%;  border-bottom:3px #ED7020 solid; width:100px;"></div>
				</div>
				
				<div class="yt">
					<div class="yy" style="margin-left:4%;" >
						<img src="images/y1.png" />
						<p>装饰装修</p>
						<p class="yp">家居/办公空间/商业空间/酒店/会所<br/>
等室内设计、施工、软装配饰的管理和服务</p>
					</div>
					<div class="yy" >
						<img src="images/y2.png" />
						<p>教育机构</p>
						<p class="yp">H&A米兰国际设计院<br/>
						江西美术专修学院</br>
						华浔运杰商学院</p>
					</div>
					<div class="yy" >
						<img src="images/y3.png" />
						<p>家私、建材、采购与全国配送</p>
						<p class="yp">华毓佳建材有限公司</p>
					</div>
					<div class="yy" >
						<img src="images/y4.png" />
						<p>生态木业制品生产和加工</p>
						<p class="yp">艺邦木业有限公司</p>
					</div>
					<div class="yy" >
						<img src="images/y5.png" />
						<p>互联网线上教育平台</p>
						<p class="yp">饰道</p>
					</div>
					<div class="yy" >
						<img src="images/y6.png" />
						<p>房地产及酒店开发</p>
						<p class="yp">艺邦置业有限公司</p>
					</div>
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