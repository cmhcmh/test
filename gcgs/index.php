<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:wap");die();
}
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '工程公司专题';
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
@$content = '工程公司专题'.$_POST['content'];
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
	echo "<script>alert('预约成功，请耐心等待客服专员与您联系！');location.href='index.php'</script>";die();
	}else{
		var_dump($sql);
		exit();
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>华浔品味装饰集团-工程公司</title>
<meta name="keywords" content="华浔品味装饰集团"/>
<meta name="description" content="华浔品味装饰集团"/>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/pzgy.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/public.css" />
<link rel="stylesheet" href="css/jquery.mcustomscrollbar.css">
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.fullpage.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/top.js"></script>
</head>

<body>
<div class="">
    <div class="min-head">
    <div class="container" style="width:1240px;">
        <a href="/" class="logo pull-left"><img src="images/logo-min.jpg"></a>
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
            </li>
        </ul>
        <div class="hotline pull-right">
            家装热线：<span><b>400-040-2005</b></span>
        </div>
    </div>
</div>	<!--头部/e-->
    <div class="clear"></div>
</div>
<div class="clear"></div>
     <div class="pzgy_banner"></div>
<div class="yyxw_con1">
<div class="article_box11">
        <div class="cl_1"><img src="picture/pzcl_2.jpg"></div>
        <div class="cl_2">
        <div class="cl_2_l1">
			<script type="text/javascript">
			$(document).ready(function(){
			
			$(".cl_2_l1 li").mask();        
			})
			 
			$.fn.mask = function(){  
				var items = $(this);  
				$.each(items, function(index, item){  
					$(item).hover(function(){  
						$(this).find("div").addClass("mask");  
						$(this).find("p").addClass("pmask");  
						$(this).find("span").addClass("smask");  
					}, function(){  
						$(this).find("div").removeClass("mask");  
						$(this).find("p").removeClass("pmask");  
						$(this).find("span").removeClass("smask");  
					});  
				});  
			};
			</script>
			<style type="text/css">
			.cl_2_l1 li{ width:390px; height:250px; position:relative; float:left;}
			.cl_2_l1 li img{width:390px; height:250px;}
			.cl_2_l1 span{
				top: 20px;
				position: relative;
				z-index:999999;
				display:none;
			}
			.cl_2_l1 span hr{
				width:85px;
				text-align:center;
				margin:0px auto;
				border:blue 1px solid;
				margin-bottom: 10px;
				margin-top: 10px;
			}
			.mask{ position:absolute; left:0; top:0; width:390px; height:250px; background:rgba(0,0,0,0.7); }
			.pmask{
				filter:alpha(opacity=0); opacity:0;
			}
			.smask{
				display:block!important;
			}
			</style>
			<ul>
           <li class="g1">
				<div class="">
				<p style="position: relative;top: 205px;font-size:25px;" class="">—  强企首选  —</p>
				<span class="">
					<font style="font-size:26px;">广东省“守合同 重信用”企业</font>
					<hr/>
					<font style="font-size:16px;">华南十大室内装饰企业之一<br/></font>
					<font style="font-size:16px;">亚洲装饰业质量服务信得过企业</font>
				</span>
				</div>
		   </li>
           <li class="g2">
				<div class="">
				<p style="position: relative;top: 205px;font-size:25px;" class="">—  全案设计  —</p>
				<span class="">
					<font style="font-size:26px;">真正的一站式全案设计服务模式</font>
					<hr/>
					<font style="font-size:16px;">设计+施工+建材+家具+空调等全产业链服务项目<br/></font>
					<font style="font-size:16px;">从初步洽谈到完工配套全流程<br/></font>
					<font style="font-size:16px;">专人对接100%贴心服务，严丝不漏</font>
				</span>
				</div>
		   </li>
           <li class="g3">
				<div class="">
				<p style="position: relative;top: 205px;font-size:25px;" class="">—  产业基地  —</p>
				<span class="">
					<font style="font-size:26px;">自有建材物流产业基地</font>
					<hr/>
					<font style="font-size:16px;">从工厂到仓库，从仓库到工地<br/></font>
					<font style="font-size:16px;">价格可控，安全无忧</font>
				</span>
				</div>
		   </li>
           <li class="g4">
				<div class="">
				<p style="position: relative;top: 205px;font-size:25px;" class="">—  设计大咖  —</p>
				<span class="">
					<font style="font-size:26px;">资深设计大咖团队</font>
					<hr/>
					<font style="font-size:16px;">轻松驾驭每一种类型每一种风格<br/></font>
					<font style="font-size:16px;">专为原创差异化而生<br/></font>
					<font style="font-size:16px;">市场前瞻方案，国际设计视野<br/></font>
					<font style="font-size:16px;">商业设计思维，成就商业价值</font>
				</span>
				</div>
		   </li>
           <li class="g5">
				<div class="">
				<p style="position: relative;top: 205px;font-size:25px;" class="">—  粤派精工  —</p>
				<span class="">
					<font style="font-size:26px;">做一个工程  树一个样板</font>
					<hr/>
					<font style="font-size:16px;">行业首推7大工种365道工序<br/></font>
					<font style="font-size:16px;">1998个工艺节点8重质检体制<br/></font>
					<font style="font-size:16px;">荣获多项技术专利<br/></font>
					<font style="font-size:16px;">为您打造高于行业标准的无忧工程</font>
				</span>
				</div>
		   </li>
           <li class="g6">
				<div class="">
				<p style="position: relative;top: 205px;font-size:25px;" class="">—  质价管控  —</p>
				<span class="">
					<font style="font-size:26px;">质价管控体系  售后服务体验</font>
					<hr/>
					<font style="font-size:16px;">任何节点及产品品控均由集团统一管理<br/></font>
					<font style="font-size:16px;">任何节点及产品统一精算，全透明流向<br/></font>
					<font style="font-size:16px;">全过程数码直播式监督质检<br/></font>
					<font style="font-size:16px;">24小时快速应答售后服务保障</font>
				</span>
				</div>
		   </li>
		   </ul>
        </div>
        </div>
        <div class="clear"></div>
        <div class="tgy_9">
			<h1>我们的服务</h1>
			<p>致力于四大热门领域，一站式配套全面解决装修环境搭建，您只需考虑企业经营，其它的请交给我们</p>
			<div>
			<ul>
			<li>
				<img src="picture/y1.png"/>
				<h2>办公、厂房空间设计装修</h2>
				<hr/>
				<span>致力于办公室、事业机关单位、写字楼、厂房等设计装修</span>
				<span>时尚美观，有思想，实用高效，有价值的办公空间设计</span>
			</li>
			<li>
				<img src="picture/y2.png"/>
				<h2>房地产、豪宅空间设计装修</h2>
				<hr/>
				<span>一站式配套服务，别墅、样品房、售楼部</span>
				<span>环境无忧管理，全部交给我们吧</span>
			</li>
			<li>
				<img src="picture/y3.png"/>
				<h2>医疗、教育空间设计装修</h2>
				<hr/>
				<span>学校、幼儿园、医院、美容院、图书馆，我们都在行</span>
				<span>将企业文化溶入环境，用文化升华凝聚力，聚集团队能量</span>
			</li>
			<li>
				<img src="picture/y4.png"/>
				<h2>商业空间设计装修</h2>
				<hr/>
				<span>酒店、餐饮、会所、商场等高端空间设计服务</span>
				<span>坚持“原创设计，放眼国际”的设计宗旨</span>
				<span>不断追求设计创新和超高设计水平。</span>
			</li>
			</ul>
			</div>
		</div>
		
        <div class="cl_3">
			<img src="picture/pzcl_bg.jpg" />
        </div>
        <div class="clear"></div>
		
		
         <div class="cl_4">
			<img src="picture/titlebg.jpg"/>
			<div>
				<li><img src="picture/t1.jpg"/></li>
				<li><img src="picture/t2.jpg"/></li>
				<li><img src="picture/t3.jpg"/></li>
				<li><img src="picture/t4.jpg"/></li>
				<li><img src="picture/t5.jpg"/></li>
			</div>
        </div>
        <div class="clear"></div>
 </div>
</div>

<div class="clear"></div>

<div class="footer">
<div class="foot">
		<div class="layout">
			<div class="ftop clearfix">
				<dl class="clearfix">
					<dt><h3>品牌实力</h3></dt>
						<dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/35" target="_blank">品牌介绍</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/9" target="_blank">发展历程</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/10" target="_blank">资质荣誉</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/11" target="_blank">企业动态</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/12" target="_blank">社会公益</a></dd><dd><a href="http://huizhou.hxdec.com//index.php/News/index/cat_id/13" target="_blank">品牌视频</a></dd>				</dl>
			
				<dl class="clearfix">
					<dt><h3>服务团队</h3></dt>
						<dd><a href="http://huizhou.hxdec.com//index.php/Design/index" target="_blank">设计团队</a></dd>
						<dd><a href="http://huizhou.hxdec.com//index.php/Dot/index" target="_blank">服务门店</a></dd>
				</dl>
				<dl class="clearfix">
					<dt><h3>营销活动</h3></dt>
					<dd><a href="http://huizhou.hxdec.com//index.php/Activi/index/cat_id/25" target="_blank">全国活动</a></dd>
					<dd><a href="http://huizhou.hxdec.com//index.php/Activi/index/cat_id/26" target="_blank">分公司活动</a></dd>
				</dl>

				<div class="box">
					<h3>为您推荐</h3>
					<div class="pich"><a target="_blank" href="http://www.hxdec.com/ppsl/index.php"><img src="picture/1510647366.jpg"></a></div> 
				</div>
				<form id="form3" method="post">
					<h3>在线下单尊享贵宾体验</h3>
					<input type="text" class="text" placeholder="联系人" name="name" id="name">
					<input type="text" class="text" placeholder="联系电话" name="mobile" id="mobile">
					<input type="hidden" name="action" value="add47">
					  <div class="clearfix">
						<input type="text" class="text text2" placeholder="验证码" name="code" id="verify" style="margin-right: 15px;width: 101px;float:left;">
						<div class="yzm"><img src="code.php" onclick="this.src+='?rand='+Math.random();" id="imgverify" style="width: 81px;"></div>
						<span><a href="javascript:void(0);" onclick="document.getElementById('imgverify').src+='?rand='+Math.random();">看不清，换一张</a></span>
                       </div>
					 <input type="hidden" name="company_id" value="0">
					     <input type="hidden" name="is_equ" value="1">
                     <input type="hidden" name="type" value="1">
					<p><font color="red" size="-1" id="s_cmresult_3"></font></p>
					<input type="submit" class="button" value="提交" onclick="s_mySubmit_3('form3','/index.php/Contact/message','s_cmresult_3')">
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
			<div class="copyright">版权信息：1998-2017 广东华浔品味装饰集团       ICP备案号:<a href="http://www.miitbeian.gov.cn/">粤ICP备15089103号</a></div>
			
		</div>
	</div>
</div>
</body>
</html>