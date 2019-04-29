<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:mobile");die();
}
header("Content-type: text/html; charset=utf-8");
require_once('inc/config.php');
@$id = $_GET['cid'];
@$city = '材料专题';
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
@$content = '材料专题'.$_POST['content'];
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
<title>华浔品味装饰集团-品质材料</title>
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
        <a href="/" class="logo pull-left"><img src="images/logo-min.png"></a>
        <ul class="nav pull-left">
            <li >
            	<a href="http://www.hxdec.com/" class="nav-menu">首页</a>
            </li>
            <li >
            	<a href="/ppsl" class="nav-menu">品牌实力</a>
            	<div class="sub-menu"> 
                    <a href="/ppsl">品牌介绍</a> 
                     <a href="http://hxdec.com/index.php/News/index/cat_id/9">发展历程</a> 
                     <a href="http://hxdec.com/index.php/News/index/cat_id/10">资质荣誉</a> 
                     <a href="http://hxdec.com/index.php/News/index/cat_id/11">企业动态</a>
                     <a href="http://hxdec.com/index.php/News/index/cat_id/12">社会公益</a>
                     <a href="http://hxdec.com/index.php/News/index/cat_id/13">品牌视频</a>
                 </div>
            </li>
            <li >
            	<a href="http://hxdec.com/index.php/Case/index" class="nav-menu">装修案例</a>
            	<div class="sub-menu"> 
                    <a href="/jmk">金马克杯</a>
                    <a href="http://hxdec.com/index.php/Case/index">精品案例</a>
                    <a href="http://hxdec.com/index.php/Gallery/index">案例图库</a> 
                    <a href="http://hxdec.com/index.php/Vr/index">VR实景</a> 
                    <a href="http://hxdec.com/index.php/Hourse/index">热装楼盘</a>
                    <a href="http://hxdec.com/index.php/Work/index">在建工地</a>
                </div>
            </li>
            <li >
            	<a href="http://hxdec.com/index.php/Design/index" class="nav-menu">服务团队</a>
            	<div class="sub-menu"> 
                    <a href="http://hxdec.com/index.php/Design/index">设计团队</a> 
                    <a href="http://hxdec.com/index.php/Dot/index">服务门店</a>
                </div>
            </li>
            <li >
            	<a href="http://hxdec.com/index.php/Activi/index" class="nav-menu">营销活动</a>
            	<div class="sub-menu"> 
                     <a href="http://hxdec.com/index.php/Activi/index/cat_id/25">全国活动</a>
                     <a href="http://hxdec.com/index.php/Activi/index/cat_id/26">分公司活动</a>
                </div>
            </li>
            <li  class="cur" >
            	<a href="/gy" class="nav-menu">无忧工程</a>
            	<div class="sub-menu"> 
                     <a href="/clzt/">环保材料</a>
                     <a href="/gy/">精湛工艺</a>
                </div>
            </li>
            <li >
            	<a href="http://hxdec.com/index.php/Page/index/cat_id/30" class="nav-menu">服务保障</a>
            	<div class="sub-menu"> 
                     <a href="http://hxdec.com/index.php/Page/index/cat_id/30">服务流程</a>
                     <a href="http://hxdec.com/index.php/Design/index">装修预约</a>
                     <a href="http://hxdec.com/index.php/News/index/cat_id/34">装修故事</a> 
                </div>
            </li>
            <li >
            	<a href="http://hxdec.com/index.php/News/index/cat_id/36" class="nav-menu">装修指南</a>
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
    <div class="clear"></div>
</div>
<div class="clear"></div>
     <div class="pzgy_banner"></div>
         <div class="yyxw_con1">
           
           <div class="article_box11">
        <div class="cl_1"><img src="picture/pzcl_2.jpg"></div>
        <div class="cl_2">
        <div class="cl_2_l1">
           <div class="cl_2_l"><img src="picture/pzcl_3.jpg"></div>
           <div class="cl_2_r">
              <p>植物油木器漆：杜绝“毒”源，木制作采用华润漆。</p>
              <p>墙面漆：采用高品质的“立邦”漆，竹炭净味更放心。</p>
              <p>电线：欧洲进口“普睿司曼”电线，质量过硬且耐高温。</p>
              <p>给水管：“丰果”PPR铝塑管，内壁物色环保，抗冻耐高压。高温、低温，进口原材料制作。</p>
              <p>木工板：专用符合欧洲E0级环保标准的香杉芯生态木工板。</p>
              <p>防水材料：“刚性”墙面和“柔性”地面的德高防水产品。</p>
              <p>粘贴材料：使用“龙马”牌，净醛建筑胶与白乳胶。</p>
           </div>
           </div>
        </div>
        <div class="clear"></div>
        <div class="tgy_8"><img src="picture/pzcl_4.jpg" /></div>
        <div class="tgy_9"><img src="picture/pzcl_5.jpg" /><img src="picture/pzcl_6.jpg" /><img src="picture/pzcl_7.jpg" /></div>
        <div class="cl_3">
           <div class="cl_3_l"><img src="picture/pzcl_8.jpg" /></div>
           <div class="cl_3_r">
              <p>
                 <span><img src="picture/pzcl_11.png" /></span>
                 给水管选用不当造成饮用水"二次污染"，常规的水管管道在经过长期使用后，积累的水垢杂质，附着在管道内壁滋生微生物...
              </p>
              <ol>
                 <li><img src="picture/pzcl_12.jpg" /><span>华浔品味装饰给水材料</span></li>
                 <li><img src="picture/pzcl_13.jpg" /><span>华浔品味装饰给水材料优势</span></li>
                 <li><img src="picture/pzcl_14.jpg" /><span>华浔品味装饰排水材料</span></li>
                 <li><img src="picture/pzcl_15.jpg" /><span>华浔品味装饰排水材料优势</span></li>
              </ol>
           </div>
        </div>
        <div class="clear"></div>
         <div class="cl_4">
           <div class="cl_4_l">
              <p>
                 <span><img src="picture/pzcl_16.png" /></span>
                 环保的电材阻燃点高，防火性能好，低烟无卤阻燃，电炉高温烧烤均无黑烟无明火，安全性好...
              </p>
              <div class="clear"></div>
              <ol>
                 <li><img src="picture/pzcl_17.jpg" /><span>华浔品味装饰电线材料</span></li>
                 <li><img src="picture/pzcl_18.jpg" /><span>华浔品味装饰电线材料优势</span></li>
                 <li><img src="picture/pzcl_19.jpg" /><span>华浔品味装饰线管材料优势</span></li>
                 <li><img src="picture/pzcl_20.jpg" /><span>华浔品味装饰弱电线材料优势</span></li>
              </ol>
              <div class="clear"></div>
           </div>
           <div class="cl_4_r"><img src="picture/pzcl_21.jpg" /></div>
        </div>
        <div class="clear"></div>
        <div class="cl_3">
           <div class="cl_3_l"><img src="picture/pzcl_24.jpg" /></div>
           <div class="cl_3_r">
              <p>
                 <span><img src="picture/pzcl_27.png" /></span>
                 大家在家居装修的过程​中，都会考虑家具，地板，门窗等但是，很多客户不知道，在家居装修的过程中，所占区域最大的一块是墙面，而对于墙面来说，涂料的选择上尤为重要，因为这关乎于家人的健康。涂料的环保，是降低居室内空气污染以及有毒气体的最重要的一个关键点。
              </p>
              <ol>
                 <li><img src="picture/pzcl_28.jpg" /><span>华浔品味装饰乳胶漆材料</span></li>
                 <li><img src="picture/pzcl_29.jpg" /><span>华浔品味装饰乳胶漆材料优势</span></li>
                 <li><img src="picture/pzcl_30.jpg" /><span>华浔品味装饰木器漆材料</span></li>
                 <li><img src="picture/pzcl_31.jpg" /><span>华浔品味装饰木器漆材料优势</span></li>
              </ol>
           </div>
        </div>
        <div class="clear"></div>
         <div class="cl_4">
           <div class="cl_4_l">
              <p>
                 <span><img src="picture/pzcl_32.png" /></span>
                 防水工程是家庭装修中的"敏感区域"，是看不见摸不着的威胁，然而防水市场混乱、品类又多，因此，在选择防水涂料时更要擦亮眼睛，不仅要看防水性能，对环保指数是否达标也要格外关注...
              </p>
              <ol>
                 <li><img src="picture/pzcl_33.jpg" /><span>华浔品味装饰防水材料</span></li>
                 <li><img src="picture/pzcl_34.jpg" /><span>华浔品味装饰防水材料优势</span></li>
                 <li><img src="picture/pzcl_35.jpg" /><span>华浔品味装饰防水材料优势</span></li>
                 <li><img src="picture/pzcl_36.jpg" /><span>华浔品味装饰防水材料PK</span></li>
              </ol>
           </div>
           <div class="cl_4_r"><img src="picture/pzcl_37.jpg" /></div>
        </div>
        <div class="clear"></div>
        <div class="cl_3">
           <div class="cl_3_l"><img src="picture/pzcl_40.jpg" /></div>
           <div class="cl_3_r">
              <p>
                 <span><img src="picture/pzcl_43.png" /></span>
                 家庭装修的有毒物质污染源一部分来自于板材、油漆、涂料、家具等，但最大真凶其实是胶水。据调查，在家装污染源所占的比例中，板材为15%—18%，油漆占15%-17%，而胶水占50%-60%！
              </p>
              <ol>
                 <li><img src="picture/pzcl_44.jpg" /><span>华浔品味装饰粘贴材料</span></li>
                 <li><img src="picture/pzcl_45.jpg" /><span>华浔品味装饰粘贴材料优势</span></li>
                 <li><img src="picture/pzcl_46.jpg" /><span>华浔品味装饰乳胶材料</span></li>
                 <li><img src="picture/pzcl_47.jpg" /><span>华浔品味装饰乳胶材料优势</span></li>
              </ol>
           </div>
        </div>
        <div class="clear"></div>
         <div class="cl_4">
           <div class="cl_4_l">
              <p>
                 <span><img src="picture/pzcl_48.png" /></span>
                 板材是家庭装修中不可或缺的一种装饰材料，不论是成品定制还是现在制作都是必不可少的，那么对于市面上常见的生态板的环保指数情况，您了解多少呢？
              </p>
              <ol>
                 <li><img src="picture/pzcl_49.jpg" /><span>华浔品味装饰木板材料</span></li>
                 <li><img src="picture/pzcl_50.jpg" /><span>华浔品味装饰木板材料优势</span></li>
                 <li><img src="picture/pzcl_51.jpg" /><span>华浔品味装饰木板材料优势</span></li>
                 <li><img src="picture/pzcl_52.jpg" /><span>华浔品味装饰木板材料PK</span></li>
              </ol>
           </div>
           <div class="cl_4_r"><img src="picture/pzcl_53.jpg" /></div>
        </div>
        <div class="clear"></div>
           </div>
        </div>

<div class="clear"></div>
<div class="rongrao">
<div class="rongrao_box">
   <img src="picture/rongrao01.jpg" />
   <p>亚洲装饰业质量服务信得过企业<br />
全国住宅装饰装修行业自律诚信宣言500家发起单位<br />
中国住宅装饰装修行业知名品牌企业<br />
中国住宅装饰装修行业AAAA诚信企业<br />
中国住宅装饰装修行业百强企业<br />
华南地区十大最具影响力装饰品牌</p>
</div>
</div>

<!--华浔荣耀 end-->
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