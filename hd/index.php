<?php
//手机版判断跳转
$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agent,'mac os')>0||strpos($agent,'android')>0||strpos($agent,'windows phone')>0){
	header("location:wap");die();
}
header("Content-type: text/html; charset=utf-8");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>华浔品味装饰2017盛世保价活动</title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content=""/>
<meta name="copyright" content=""/>
<link href="css/maincss.min.css" rel="stylesheet" type="text/css" />

<!-- pinyou find code start -->
<script type="text/javascript">
var _py = _py || [];
_py.push(['a', 'bts..zT6q8oc8Gm5sEIfcFR_iB0']);
_py.push(['domain','stats.ipinyou.com']);
_py.push(['e','']);
-function(d) {
	var s = d.createElement('script'),
	e = d.body.getElementsByTagName('script')[0]; e.parentNode.insertBefore(s, e),
	f = 'https:' == location.protocol;
	s.src = (f ? 'https' : 'http') + '://'+(f?'fm.ipinyou.com':'fm.p0y.cn')+'/j/adv.js';
}(document);
</script>
<noscript><img src="picture/adv.gif" style="display:none;"/></noscript>
<!-- pinyou find code end -->

<!-- zhihui transform code start -->
<script type="text/javascript"  src="js/page_duration.js" arguments="{'cpid':'700018814','t':'w'}" id="ad_statistic_kit" ></script>
<!--<div style="text-align:center;color:black;width:110px;line-height: 30px;background:#d9b12e"><span style="vertical-align:middle;">网站统计</span></div>-->
<!-- zhihui transform code end -->
<!-- 360 count start-->
<!--<script type="text/javascript" src="js/4092.js"></script>-->
<!-- 360 count end -->
<link rel="stylesheet" type="text/css" href="css/swiper.min.css" />
<script type="text/javascript" src="js/jquery-core.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="js/fai.min.js"></script>

<style type="text/css">
html, body {position: relative;height: 100%; font-family: "微软雅黑";background: #fff;}
body {background: #eee;font-family: "微软雅黑";font-size: 16px;color:#fff;margin: 0;padding: 0;overflow: hidden;width: 100%;}
.swiper-container {width: 100%;height: 100%;}
.swiper-slide {text-align: center;font-size: 18px;background: #000;display: -webkit-box;display: -ms-flexbox;display: -webkit-flex;display: flex;-webkit-box-pack: center;-ms-flex-pack: center;-webkit-justify-content: center;justify-content: center;-webkit-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;}


/*进度点处理*/
.swiper-container-vertical > .swiper-pagination-bullets .swiper-pagination-bullet {margin: 0.15rem 0.025rem;}
.swiper-container-vertical > .swiper-pagination-bullets .swiper-pagination-bullet-active{margin: 0.15rem 0rem;}
.swiper-pagination-bullet {width: 0.08rem;height:0.08rem;background: #fff;opacity: 1;  background:url(images/pic02.png) 0 -0.416rem no-repeat ; background-size: 6.667rem; }
.swiper-pagination-bullet-active {width:0.12rem;height: 0.12rem;opacity: 1;background: #288ce2;background:url(images/pic02.png) 0 0rem no-repeat ; background-size: 6.667rem;	}
.swiper-container-vertical > .swiper-pagination-bullets{right: 0.45834rem;}
/*进度点处理*/

/*fixed banner start*/
#footer{position: fixed;bottom: 0;left: 0; z-index: 777; height: 0.534rem ; width: 100%;
	-ms-transition:all ease 0.6s;
	-o-transition:all ease 0.6s;
	-webkit-transition:all ease 0.6s;
	-moz-transition:all ease 0.6s;
	transition:all ease 0.6s;
}
#footer .img{width: 100%; height: 0.534rem ; background: url(images/new3b_v2.png) center 0 no-repeat; background-size: 20rem;}
#footer .footText{display: none; margin: 0 auto; font-size:0.134rem ; color:#00deff;font-family: "微软雅黑";  text-align: center; }
#footer.mini{height:0.35rem; line-height: 0.35rem; opacity: 0.9;}
#footer.mini .footText{display: block;}
#footer.mini .img{ background: none;}
/*fixed banner end*/

/* swiper bg*/
.page1{width: 100%; height: 100%;position: relative;background:url(images/pin_01.jpg) center 0  no-repeat ; background-size: cover;}
.page2{width: 100%; height: 100%;position: relative;background:url(images/pin_02.jpg) center 0  no-repeat ; background-size: cover;}
.page3{width: 100%; height: 100%;position: relative;background:url(images/pin_03.jpg) center 0  no-repeat ; background-size: cover;}
.page4{width: 100%; height: 100%;position: relative;background:url(images/pin_04.jpg) center 0  no-repeat ; background-size: cover;}
.page5{width: 100%; height: 100%;position: relative;background:url(images/pin_05.jpg) center 0  no-repeat ; background-size: cover;}
.page6{width: 100%; height: 100%;position: relative;background:url(images/pin_06.jpg) center 0  no-repeat ; background-size: cover;}
.page7{width: 100%; height: 100%;position: relative;background:url(images/pin_07.jpg) center 0  no-repeat ; background-size: cover;}
.page8{width: 100%; height: 100%;position: relative;background:url(images/pin_08.jpg) center 0  no-repeat ; background-size: cover;}
.page9{width: 100%; height: 100%;position: relative;background:url(images/pin_09.jpg) center 0  no-repeat ; background-size: cover;}


#jzPro6Container {position: relative; width: 100%;height: 100%;}
.page{position: relative;width: 100%;height: 100%;}
.textDiv ,.regDiv{margin:0 auto; height:100%;}
.regBtn{cursor: pointer; display: background-size: 6.667rem; text-align: center; vertical-align: middle; font-family: "微软雅黑"; font-size: 0.2167rem; color: #fff;}
.text{ background-size: 6.667rem;}

/* 页面文字处理*/
#page1Container{width: 100%;height: 100%;position: relative;}
.page1 .regDiv{width: 3.04rem; height: 0.55rem; line-height: 0.55rem;}
.page1 .regBtn1{position: absolute; top:  48%; width: 3.04rem; height: 0.55rem;  background-position: 0 -0.834rem;  }
.page1 .regBtn1:hover{position: absolute; top:  48%; width: 3.04rem; height: 0.55rem;  background-position: -3.334rem -0.834rem;color: #eee;  }
.page1 .textDiv{width: 4.5rem; height: 0.3834rem;}
.page1 .textDiv .text1{position: absolute; top: 38%; color:#729cb7; font-size: 0.1667rem;}
.page1 .textDiv .text1 .textCount{width: 4.5rem;text-align:center;}
.page1 .textDiv .text1 .spanSite{font-size: 0.2rem;}
.page1 .textDiv .text1 #count-number{font-size:0.4rem;color:#00ffea;font-weight: normal; font-family:  Arial;}


.page2 .textDiv{width: 6.50rem; height: 0.3834rem;}
.page2 .textDiv .text2{position: absolute; top:  69.21%; width: 4.04rem; height: 0.667rem; background-position: 0 -6.917rem; }
.page2 .textDiv .regDiv{position: absolute; top:  71.0%; width: 6.50rem;line-height: 0.45rem;}
.page2 .textDiv .regBtn2{float: right; width: 1.867rem; height: 0.467rem;  background-position: 0 -1.75rem;  }
.page2 .textDiv .regBtn2:hover{float: right; width: 1.867rem; height: 0.467rem; background-position: -3.334rem -1.75rem;color: #eee;}


.page3 .textDiv{width: 6.317rem; height: 0.3834rem; }
.page3 .textDiv .text3{position: absolute; top:  68%; width: 2.4167rem; height: 1.167rem;  background-position: 0 -7.834rem; }
.page3 .textDiv .regDiv{position: absolute; top:  76%; width: 6.317rem;line-height: 0.45rem; }
.page3 .textDiv .regBtn3{float: right;width: 1.867rem; height: 0.467rem;  background-position: 0 -2.5834rem;  }
.page3 .textDiv .regBtn3:hover{float: right; width: 1.867rem; height: 0.467rem; background-position:-3.334rem -2.5834rem;color: #eee;}


.page4 .textDiv{width: 6.5834rem; height: 0.3834rem; }
.page4 .textDiv .text4{position: absolute; top:  70%; width: 3.334rem; height: 0.75rem; background-position:0 -9.25rem;}
.page4 .textDiv .regDiv{position: absolute; top:  71%; width: 6.5834rem; line-height: 0.45rem; }
.page4 .textDiv .regBtn4{float: right;width: 1.867rem; height: 0.467rem;  background-position:0 -3.4167rem;}
.page4 .textDiv .regBtn4:hover{float: right;width: 1.867rem; height: 0.467rem; background-position:-3.334rem -3.4167rem;color: #eee; }


.page5 .textDiv{width:4.334rem; height: 0.3834rem; border: 0px solid #aaa;}
.page5 .textDiv .text5{position: absolute; top:  65%; width: 4.334rem; height: 0.75rem; background-position: 0 -10.25rem; }
.page5  .regDiv{width: 1.867rem;line-height: 0.45rem; }
.page5  .regBtn5{position: absolute; top:  76.4%; width: 1.867rem; height: 0.467rem;  background-position:0 -4.25rem; }
.page5  .regBtn5:hover{position: absolute; top:  76.4%;  width: 1.867rem; height: 0.467rem; background-position:-3.334rem -4.25rem; color: #eee;}


.page6 .textDiv{width:4.334rem; height: 0.3834rem;}
.page6 .textDiv .text6{position: absolute; top:  61.5%; width: 4.25rem; height: 0.5834rem; background-position: 0 -11.25rem ;}
.page6  .regDiv{width: 1.867rem;  line-height: 0.45rem;}
.page6  .regBtn6{position: absolute; top:  73%; width: 1.867rem; height: 0.467rem; background-position: 0 -5.0834rem;}
.page6  .regBtn6:hover{position: absolute; top:  73%;  width: 1.867rem; height: 0.467rem; background-position:-3.334rem -5.0834rem;color: #eee;}


.page7 .textDiv{width:2.917rem; height: 0.3834rem; }
.page7 .textDiv .text7{position: absolute; top:  19%; width: 2.917rem; height: 0.67rem; background-position:0 -12.0834rem; }
.page7  .regDiv{width: 3.04rem; line-height: 0.55rem; }
.page7  .regBtn7{position: absolute; top:  70.3%;  width: 3.04rem; height: 0.55rem;  background-position:0 -5.9167rem;}
.page7  .regBtn7:hover{position: absolute; top:  70.3%; width: 3.04rem; height: 0.55rem; background-position:-3.334rem -5.9167rem;color: #eee;}


.page8 .textDiv{width:2.917rem; height: 0.3834rem; }
.page8 .textDiv .text7{position: absolute; top:  19%; width: 2.917rem; height: 0.67rem; background-position:0 -12.0834rem; }
.page8  .regDiv{width: 3.04rem; line-height: 0.55rem; }
.page8  .regBtn7{position: absolute; top:  70.3%;  width: 3.04rem; height: 0.55rem;  background-position:0 -5.9167rem;}
.page8  .regBtn7:hover{position: absolute; top:  70.3%; width: 3.04rem; height: 0.55rem; background-position:-3.334rem -5.9167rem;color: #eee;}


.page9 .textDiv{width:2.917rem; height: 0.3834rem; }
.page9 .textDiv .text7{position: absolute; top:  19%; width: 2.917rem; height: 0.67rem; background-position:0 -12.0834rem; }
.page9  .regDiv{width: 100%; line-height: 0.55rem; }
.page9  .regBtn7{position: absolute; top:  70.3%;  width: 100%; height: 0.55rem;  background-position:0 -5.9167rem;}
.page9  .regBtn7:hover{position: absolute; top:  70.3%; width: 100%; height: 0.55rem; background-position:-3.334rem -5.9167rem;color: #eee;}

/*#faiscoService{display: none;}*/
.hideText{visibility: hidden;}
/* 页面文字处理*/

@-ms-keyframes fadeIn {
  0% {
  	opacity: 0;
  }
  80%{
  	opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

@-o-keyframes fadeIn {
  0% {
  	opacity: 0;
  }
  80%{
  	opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

@-webkit-keyframes fadeIn {
  0% {
  	opacity: 0;
  }
  80%{
  	opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

@-moz-keyframes fadeIn {
  0% {
  	opacity: 0;
  }
  80%{
  	opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  80%{
  	opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.swiper-slide-active .fadeIn {
  	-ms-animation: fadeIn 1s linear ;
  	-o-animation: fadeIn 1s linear ;
  	-webkit-animation: fadeIn 1s linear ;
	-moz-animation: fadeIn 1s linear ;
	animation: fadeIn 1s linear ;
}

/*seo blog */
.dropDown{width:2.917rem;; margin:0px auto; position: relative; position: absolute; bottom:-2.5rem; left: 0;right: 0;}
.icon_Down{width: 0.26rem; height: 0.26rem; margin: 0 auto 0.1rem auto; background: url(images/icond.png) 0px 0px no-repeat; cursor: pointer; background-size: cover;}
.icon_Up{width: 0.28rem; height: 0.28rem; margin: 0 auto 0.1rem auto; background: url(images/iconu.png) 0px 0px no-repeat; cursor: pointer; background-size: cover;}
.item_border_top{border-top: 1px solid #FC7498;border-bottom: 1px solid #FC7498;}
.item_border_bottom{border-bottom: 1px solid #FC7498;}
.item{display: block; width:2.917rem;;padding: 5px 5px;}
.item_tip{display:inline-block; width:1rem; color: #FC7498; font-size: 0.2rem;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
.item_tip a{color: #FC7498;}
.middle{display: inline-block; width: 2px; height: 0.3rem;border-left:1px solid #FC7498; margin: 0px 9px 0px 5px;}
.readMore, .readMore a{font-size: 0.2rem; color:#85B0DD; width: 100%; text-align: center;}


</style>


</head>
<body >
	<div id="jzPro6Container">
	    <div class="swiper-container">
	        <div class="swiper-wrapper">
	            <div class="swiper-slide" id="swiperPage1">
	            	<div class="page page1 ">
						
		            </div>
	            </div>
	            <div class="swiper-slide" id="swiperPage2">
	            	<div class="page page2">
						<div class="regDiv" style="margin-top:18%;">
							<?php require('form.php'); ?>
							<a class="regBtn2 regBtn fadeIn" style=" margin-left:27%; width:none;" href="#" onclick="javascript:OpenDiv();" id="open" _srcId="12"><img style="width:17%;" src="images/n1.png" /></a>
						</div>
		            </div>
	            </div>
	            <div class="swiper-slide" id="swiperPage3">
	            	<div class="page page3">
	            			<div class="regDiv" style="margin-top:25%;">
							<?php require('form1.php'); ?>
	            				<a class="regBtn3 regBtn fadeIn"style=" margin-right:35%;"  href="#" onclick="javascript:OpenDiv1();" id="open1" _srcId="13"><img style="width:25%;" src="images/n2.png" /></a>
	            			</div>
		            </div>
	            </div>
	            <div class="swiper-slide" id="swiperPage4">
	            	<div class="page page4">
		            	
	            			<div class="regDiv" style="margin-top:25%; margin-left:20%;">
								<?php require('form2.php'); ?>
	            				<a class="regBtn4 regBtn fadeIn" href="#" onclick="javascript:OpenDiv2();" id="open2" _srcId="14"><img style="width:25%;" src="images/n3.png" /></a>
	            			</div>
	            
		            </div>
	            </div>
	            <div class="swiper-slide" id="swiperPage5">
	            	<div class="page page5">
					<?php require('form3.php'); ?>
					<a class="regBtn5 regBtn fadeIn" style="margin-top:6%; margin-left:-5%;" href="#"  _srcId="15"><img style="width:120%;" onclick="javascript:OpenDiv3();" id="open3" src="images/n2.png" /></a>
	            </div>
	            </div>
	            <div class="swiper-slide" id="swiperPage6">
	            	<div class="page page6">
						<?php require('form4.php'); ?>
		            	<a class="regBtn6 regBtn fadeIn" style="margin-top:-10%; margin-left:-7%;" href="#"  _srcId="16"><img style="width:100%;"onclick="javascript:OpenDiv4();" id="open4" src="images/n4.png" /></a>
	            	</div>
	            </div>
	            <div class="swiper-slide" id="swiperPage7">
	            	<div class="page page7">
		            	
	            		<div class="regDiv fadeIn" style="margin-left:27%;">
							<?php require('form5.php'); ?>
	            			<a class="regBtn7 regBtn fadeIn" style=" margin-top:7%; margin-left:3%;" href="#" _srcId="17"><img style="width:100%;" onclick="javascript:OpenDiv5();" id="open5" src="images/n2.png" /></a>
	            		</div>
		            </div>
	            </div>
				 <div class="swiper-slide" id="swiperPage8">
	            	<div class="page page8">
						<?php require('form6.php'); ?>
						<div class="regDiv fadeIn" style="margin-top:40%;">
							<a class="regBtn6 regBtn fadeIn" href="#" onclick="javascript:OpenDiv6();" id="open6" _srcId="16"><img style="width:100%;" src="images/n2.png" /></a>
						</div>
		            </div>
	            </div>
				 <div class="swiper-slide" id="swiperPage9">
	            	<div class="page page9">
						<div class="regDiv fadeIn" style="margin-top:7%; margin-right:65%;">
							<?php require('form7.php'); ?>
							<a class="regBtn6 regBtn fadeIn" href="#" onclick="javascript:OpenDiv7();" id="open7" _srcId="16"><img width="80%" src="images/n5.png" /></a>
						</div>
		            </div>
	            </div>
				
	        </div>
	       
	        <div class="swiper-pagination"></div>
	    </div>
	</div>
	                     
<script src="js/swiper.min.js"></script>
<script type="text/javascript">
	$(window).resize(function(){
		adjustWindow();	
	});

	$(function(){
		adjustWindow();
		$(".hideText").css("visibility","visible");
		//售前咨询按钮点击统计
		$('body').on('click', '#faiscoService .serviceText', function(){
			logDog(4000007, 3);
		});
		//售后咨询按钮点击统计
		$('body').on('click', '#faiscoService .serviceText2', function(){
			logDog(4000021, 3);
		});
		
		$(".regBtn").bind("click",function(){
			var _isFromPro8 = false;
		  if(_isFromPro8){
				var _srcId = $(this).attr("_srcId");
				logDog(200342, _srcId);
			}
		});
	});
		
	var picWidth = 2400 ;
	var picHeight = 990 ; 
	var picRate = picWidth / picHeight ; 
	var windowRate =  1920 /978 ;
	picRate = windowRate;
	//调整窗口自适应
	function adjustWindow(){
		var rem=$('#jzPro6Container').width()/16;
	    $('html').css('font-size',rem+"px");
		var windowH = $(window).height();
		var windowW = $(window).width();
		var realRate = windowW / windowH ;
		var pp =  picHeight * realRate;
		var pb = windowH * picRate;

		if(realRate> picRate){
	    	var dreamH = windowW / picRate;	
			var pb = dreamH * picRate;
			$("#page1Container").css("height",dreamH +"px");
			$("#jzPro6Container").css("height",dreamH +"px");
	    }else{
	    	$("#jzPro6Container").css("height","100%");
	    	$("#page1Container").css("height","100%");
	    }

		var rem= pb/16;
	    $('html').css('font-size',rem+"px");
	}
  


function changeBanner(){   
    var curPage = $(".swiper-slide-active").attr("id");
    var curIndext = curPage.replace(/swiperPage/, "");
    if(curIndext ==1 ){
    	$("#footer").removeClass("mini");
    }else if(curIndext ==2 ){
    	$("#footer").addClass("mini");
    	$("#footer.mini").css("background","#091f51");
    }else if(curIndext == 3){
    	$("#footer").addClass("mini");
    	$("#footer.mini").css("background","#0d2865");
    }else if(curIndext == 4 ){
    	$("#footer").addClass("mini");
    	$("#footer.mini").css("background","#0b3575");
    }else if(curIndext == 5 ){
    	$("#footer").addClass("mini");
    	$("#footer.mini").css("background","#002165");
    }else if(curIndext ==6 ){
    	$("#footer").addClass("mini");
    	$("#footer.mini").css("background","#004392");
    }else if(curIndext ==7){
    	$("#footer").addClass("mini");
    	$("#footer.mini").css("background","#0d2865");
    } 
}

var swiper = new Swiper('.swiper-container', {
    pagination: '.swiper-pagination',
    mousewheelControl : true,
    mousewheelReleaseOnEdges : true,
    speed : 600,
    direction: 'vertical',
    preventClicks : false,
 	paginationClickable :true,
    onSlideChangeEnd: function(swiper){ //切换页面触发事件
      changeBanner(); 
    }
});



/*------------ jQuery动态数字翻滚计数到指定数字的文字特效代码 --------------------*/
$.fn.countTo = function (options) {
	options = options || {};
	
	return $(this).each(function () {
		// set options for current element
		var settings = $.extend({}, $.fn.countTo.defaults, {
			from:            $(this).data('from'),
			to:              $(this).data('to'),
			speed:           $(this).data('speed'),
			refreshInterval: $(this).data('refresh-interval'),
			decimals:        $(this).data('decimals')
		}, options);
		
		// how many times to update the value, and how much to increment the value on each update
		var loops = Math.ceil(settings.speed / settings.refreshInterval),
			increment = (settings.to - settings.from) / loops;
		
		// references & variables that will change with each update
		var self = this,
			$self = $(this),
			loopCount = 0,
			value = settings.from,
			data = $self.data('countTo') || {};
		
		$self.data('countTo', data);
		
		// if an existing interval can be found, clear it first
		if (data.interval) {
			clearInterval(data.interval);
		}
		data.interval = setInterval(updateTimer, settings.refreshInterval);
		
		// initialize the element with the starting value
		render(value);
		
		function updateTimer() {
			value += increment;
			loopCount++;
			
			render(value);
			
			if (typeof(settings.onUpdate) == 'function') {
				settings.onUpdate.call(self, value);
			}
			
			if (loopCount >= loops) {
				// remove the interval
				$self.removeData('countTo');
				clearInterval(data.interval);
				value = settings.to;
				
				if (typeof(settings.onComplete) == 'function') {
					settings.onComplete.call(self, value);
				}
			}
		}
		
		function render(value) {
			var formattedValue = settings.formatter.call(self, value, settings);
			$self.html(formattedValue);
		}
	});
};

$.fn.countTo.defaults = {
	from: 0,               // the number the element should start at
	to: 0,                 // the number the element should end at
	speed: 1000,           // how long it should take to count between the target numbers
	refreshInterval: 100,  // how often the element should be updated
	decimals: 0,           // the number of decimal places to show
	formatter: formatter,  // handler for formatting the value before rendering
	onUpdate: null,        // callback method for every time the element is updated
	onComplete: null       // callback method for when the element finishes updating
};

function formatter(value, settings) {
	return value.toFixed(settings.decimals);
}

// custom formatting example
$('#count-number').data('countToOptions', {
formatter: function (value, options) {
  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
}
});

// start all the timers
$('.timer').each(count);  

function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
}
/*------------ jQuery动态数字翻滚计数到指定数字的文字特效代码 end --------------------*/

  closeBlog();
  function showBlog(){
    $(".bb05").css("height","auto");
    $(".icon_Down").css("display","none");
    $(".icon_Up").css("display","block");
  }

  function closeBlog(){
    $(".dropDown").css({"width":"0px","height":"0px","overflow":"hidden"});
    $(".bb05").css("height","566px");
    $(".icon_Up").css("display","none");
    $(".icon_Down").css("display","block");
  }	
</script>
</body>
</html>





<script type="text/javascript" src="js/jquery-core.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="js/fai.min.js"></script>

<script type='text/javascript' src='js/_dog.jsp'></script>

<!-- cnzz stat -->
<script src="https://s13.cnzz.com/z_stat.php?id=1263522543&web_id=1263522543" language="JavaScript"></script>
<!-- cnzz stat end -->



<script type="text/javascript">
var regCountInterval = 0;
$(function(){
	$(".nav").hover(function(){
		$(".nav").removeClass("navHover");
		$(this).addClass("navHover");
	}, function(){
		$(this).removeClass("navHover");
	});
	
	$(".webRegCount .weixin").hover(function(){
		$(this).attr('_mouseIn', 1);
		var div = $(this).find(".weixinContent").show();
		div.show();
	}, function(){
		$(this).attr('_mouseIn', 0);
		setTimeout(function(){
			var mouseIn = parseInt($('.webRegCount .weixin').attr('_mouseIn'));
			if(mouseIn == 0){
				$('.webRegCount .weixin').find(".weixinContent").hide();
			}
		}, 100);
	});
	$(".webRegCount .weixin .weixinContent").hover(function(){
		$('.webRegCount .weixin').attr('_mouseIn', 1);
	}, function(){
		$('.webRegCount .weixin').attr('_mouseIn', 0);
		setTimeout(function(){
			var mouseIn = parseInt($('.webRegCount .weixin').attr('_mouseIn'));
			if(mouseIn == 0){
				$(".webRegCount .weixin .weixinContent").hide();
			}
		}, 100);
	});
	
	$(".webRegCount .phone").hover(function(){
		$(this).attr('_mouseIn', 1);
		var div = $(this).find(".phoneContent").show();
		div.show();
	}, function(){
		$(this).attr('_mouseIn', 0);
		setTimeout(function(){
			var mouseIn = parseInt($('.webRegCount .phone').attr('_mouseIn'));
			if(mouseIn == 0){
				$('.webRegCount .phone').find(".phoneContent").hide();
			}
		}, 100);
	});
	$(".webRegCount .phone .phoneContent").hover(function(){
		$('.webRegCount .phone').attr('_mouseIn', 1);
	}, function(){
		$('.webRegCount .phone').attr('_mouseIn', 0);
		setTimeout(function(){
			var mouseIn = parseInt($('.webRegCount .phone').attr('_mouseIn'));
			if(mouseIn == 0){
				$(".webRegCount .phone .phoneContent").hide();
			}
		}, 100);
	});
	if ( $('.regCountMiddle').length != 0 ){
		regCountInterval = window.setInterval(regCountShow, 30);
	}
	
	footAutoHeight();
});

function footAutoHeight(){
	if ($('.footLineGray').length != 0){	
		var footHeightDifference = document.documentElement.clientHeight - ($('.footLineGray').offset().top + 2 + $('.webFoot').height());
		if ( footHeightDifference > 0 ){
			$('#autoHeightDiv').css("height", footHeightDifference);
		}
	}
}

/**function regCountShow(){
	var left1 = $('#regCountText1')[0].offsetLeft;
	var left2 = $('#regCountText2')[0].offsetLeft;
	//console.log(left1 + "  " + left2);
	if ( --left1 == 0 ){
		$('#regCountText1').css("left", left1);
		$('#regCountText2').css("left", 320);
		return;
	}
	if ( --left2 == 0 ){
		$('#regCountText1').css("left", 320);
		$('#regCountText2').css("left", left2);
		return;
	}
	//console.log(left1 + "  " + left2);
	$('#regCountText1').css("left", left1);
	$('#regCountText2').css("left", left2);
}**/

</script>
<style type="text/css">
#qiao-icon-wrap {display:none !important;}
</style>
