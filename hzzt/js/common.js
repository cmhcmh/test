//$(function(){
//    try{
//document.body.oncontextmenu=document.body.ondragstart=document.body.onselectstart=document.body.onbeforecopy=function(){
//            return false;
//        };
//document.body.onselect=document.body.oncopy=document.body.onmouseup=function(){try{document.selection.empty();}catch(err){
//        return false;
//    }};
//    }catch(err){
//         return false;
//     }
// })
$(function(){
  $('.navmain').find('li').last().insertBefore($('.navmain').find('li').eq(1));
  $('.navsub').find('li').last().insertBefore($('.navsub').find('li').eq(1));
  $('.sel-con .power').insertBefore($('.sel-con .case'));
})
$(document).ready(function () {
    $(".dynamic").stop().show();
    $(".static").stop().hide();
    $(".navsub").stop().show();
    $(".header").css('padding-bottom', '0px');
	$("html").scrollTop(0);

// var o_href=window.location.href;
// var b_href='http://www.shangcengsh.com/'
// if(o_href.indexOf(b_href) >=0){

//     console.log(o_href);
//     $('dl.select-box').hide();
// };

//--------------单独标记
//$(".imglist li:nth-child(4n)").addClass("an");
$(".right_menu li:last-child").addClass("last");

/*if ($(window).width() > 767&& $(window).width() < 1023){$(".imglist li:nth-child(4n)").removeClass("an");$(".imglist li:nth-child(3n)").addClass("an");}
if ($(window).width() > 319&& $(window).width() < 768){
	$(".imglist li:nth-child(3n)").removeClass("an");
	$(".imglist li:nth-child(4n)").removeClass("an");
	$(".imglist li:nth-child(2n)").addClass("an");
	}*/
if ($(window).width() < 767){
	$(".sear").click(function(){
		$(this).addClass("open");
		})

	 /*$(document).on("click", ".sear .button", function () {
         $(this).addClass("open");
	 })*/
}


var isSupportTouch = !!('ontouchend' in document) || navigator.userAgent.indexOf('Windows Phone') > 0;

$('input').placeholder();
$('textarea').placeholder();


//--------------手机导航
    $(document).on("click", ".menu_h,.ph-mask", function () {
		$(this).parents("body").toggleClass("menu-open");
	});
//

//--------------手机端导航点击展开
	$(".header .nav li").click(function() {
		$(this).find(".child").toggle();
		//$(this).toggleClass('on');
	})
//

//--------------头部滚动
//if($(".menu_h").is(":hidden")){
    var headt = $(".header").height();
    $(window).scroll(function () {
        var st = $(window).scrollTop();
        if (st > 0) {
            $(".header").addClass("fixedhede");
        }
        else {
            $(".header").removeClass("fixedhede");
        }
    })
//}
//


//--------------图片加载
    $(".img-load").each(function () {
        if($(window).width()<768)
        {
            $(this).attr({ src: $(this).data("phone-src")})
        }
        else
        {
            $(this).attr({ src: $(this).data("src") })
        }

    });
//

//--------------模拟下拉
    $(document).on("click", ".select-box dt a", function (e) {
        e.preventDefault();
        e.stopPropagation();


        if ($(this).parents(".disabled").hasClass("disabled"))
        {
            return false;
        }

        $(".select-body-box,.selectmask").remove();
        var el = $(this).parents(".select-box");
        el.addClass("open");
        var ht = el.find("dd").html(),
            oftop = el.offset().top + el.height(),
            ofleft = el.offset().left,
            ofwidth = el.width();

        if ($(window).width() < 767) {
            $("body").append("<div class='select-body-box'>" + ht + "</div><a href='javascript:;' class='selectmask'></a>");
            oftop = ($(window).height() - $(".select-body-box").height()) / 2;
            $(".select-body-box").css({ top: oftop });
        } else {
            $("body").append("<div class='select-body-box' style='top:" + oftop + "px; left:" + ofleft + "px; width:" + ofwidth + "px;' >" + ht + "</div><a href='javascript:;' class='selectmask'></a>");
        }

    })
    $(document).on("click", ".select-body-box a", function (e) {
        var inde = $(this).index();
        $(this).addClass("on").siblings().removeClass("on");
        var el = $(".select-box.open");
        el.next(".select-hidden").val($(this).attr("data-val"))
        el.find("dt a b").text($(this).text());
        el.find("dd a").eq(inde).addClass("on").siblings().removeClass("on");
        setTimeout(function () {//其他方法判断open的延迟；
            el.removeClass("open");
        },1)
        $(".select-body-box,.selectmask").remove();
    })
    $(document).click(function () {
        $(".select-box.open").removeClass("open");
        $(".select-body-box,.selectmask").remove();

    })
//end

//--------------公用选项卡切换
$(document).on("click", ".tab-box .tab-a", function () {
	$(this).addClass("on").siblings().removeClass("on");
	var ii=$(this).index();
	$(this).parents(".tab-box").find(".tab-b").eq(ii).show().siblings().hide();
})
//
$(".tab-box").each(function (i) {
	$(this).find(".tab-a:eq(0)").click();
	if($(window).width()<=1024 & isSupportTouch)
	{
		$(this).find(".tab-a a").attr({"href":"javascript:;"})
	}
});
//end


//右侧快速入口
$(function(){
    $(".right_menu li>a").click(function(event){
        event.stopPropagation();
        if($(this).parent().hasClass('on')){
           $(this).parent().removeClass('on');
        }else{
            $(this).parent().addClass("on").siblings().removeClass('on');

        }

        $(".right_menu").siblings().click(function(event) {
            event.stopPropagation();
            $(".right_menu li").removeClass('on')
        });
    })


})

//手机端底部快速入口
$(document).on("click", ".tel_bot a.t_b02", function (e) {
    e.stopPropagation();
    $(".t_b02_box").toggleClass("open");
})

$(".in").click(function () {
    return false;
})

// $(".r_m_sub button").click(function(){
//     $(".right_menu li.on").removeClass("on");
//     $(".right_menu").find(".error").removeClass("error")
//     $(".right_menu").find(".valid_message").css({"display":"none"})
// });

$(document).on('click',function () {
	  $(".t_b02_box").removeClass("open");
})
$(".t_b02_box").click(function(e){
    e.stopPropagation();
});





//首页底部滚动
$(function(){
 var _wrap=$('ul.link_line');//定义滚动区域
 var _interval=2000;//定义滚动间隙时间
 var _moving;//需要清除的动画
 _wrap.hover(function(){
  clearInterval(_moving);//当鼠标在滚动区域中时,停止滚动
 },function(){
    if(_wrap.find('li').length>1){
      _moving=setInterval(function(){
       var _field=_wrap.find('li:first');//此变量不可放置于函数起始处,li:first取值是变化的
       var _h=_field.height();//取得每次滚动高度(多行滚动情况下,此变量不可置于开始处,否则会有间隔时长延时)
       _field.animate({marginTop:-_h+'px'},600,function(){//通过取负margin值,隐藏第一行
        _field.css('marginTop',0).appendTo(_wrap);//隐藏后,将该行的margin值置零,并插入到最后,实现无缝滚动
       })
      },_interval)//滚动间隔时间取决于_interval
    }
 }).trigger('mouseleave');//函数载入时,模拟执行mouseleave,即自动滚动


});


})

$(function () {
    $('.wx').click(function () {
        $('.tan_weixin').toggleClass('disP');

    });

    $('.closed2').click(function () {
        // alert(1)
        $('.disP').removeClass('disP');
    })
})
$(function () {
    $('.font_size a').click(function () {
        var index = jQuery(this).index();
        jQuery(this).addClass('on').siblings().removeClass('on');
        if (index == 0) {
            $('.sc-Jun-left .edit_con_original').css('font-size', '12px');
        }
        else if (index == 1) {
            $('.sc-Jun-left .edit_con_original').css('font-size', '14px');

        } else {
            $('.sc-Jun-left .edit_con_original').css('font-size', '16px');
        }
    })
    //窗口改变大小回调ratio；
    var rtime = new Date();
    var timeout = false;
    var delta = 200;
    $(window).resize(function () {
        rtime = new Date();
        if (timeout === false) {
            timeout = true;
            if (!$("html").hasClass("ie7")) {
                setTimeout(resizeend, delta); //resize只回调最后一次
            }
        }
    });
    function resizeend() {  //window.resize回调
        if (new Date() - rtime < delta) {
            setTimeout(resizeend, delta);
        } else {
            timeout = false;
            var lock=true;
            _win = $(window).width();
            $(window).resize(function () {
                _win2 = $(window).width();
                if ($("html").hasClass("ie7")) { } else {

                    if (_win != _win2 && _win < 1180 && lock) {
                        // console.log(lock);
                        window.location.reload();
                        lock=false;
                    }
                }
            })
        }
    }
})
// var lock=true;
// _win = $(window).width();
// $(window).resize(function () {
//     _win2 = $(window).width();
//     if ($("html").hasClass("ie7")) { } else {

//         if (_win != _win2 && _win < 1180 && lock) {
//             console.log(lock);
//             window.location.reload();
//             lock=false;
//         }
//     }



// })


/* 顶部条 */
$(function(){
    $(window).scroll(function() {
        var h=$(document).scrollTop();

        if (h>20) {
            $(".dynamic").hide();
            $(".static").show();
            $(".navsub").hide();
            $(".header").css('padding-bottom', '10px');

        }else {
            $(".dynamic").show();
            $(".static").hide();
            $(".navsub").show();
            $(".header").css('padding-bottom', '0px');

        }

        // console.log(h);
    });
})

/* 导航 */
var debounce = function(action, delay) {
    var timer = null;

    return function() {
        var self = this,
              args = arguments;

        clearTimeout(timer);
        timer = setTimeout(function() {
            action.apply(self, args)
        }, delay);
    }
}
window.load=function(){

}
$(function () {
    var fixel = $('.sel-con').find('.power').find('.bl_05_con').eq(2).find('.panel');
    var fixh = $(document).width()*0.86*0.332*0.8;
    // console.log(fixel,fixh)
    fixel.find('.img').height(fixh);
    var headerH=$("header").innerHeight();
    $(".sel-con").css('top', headerH);
    $(window).scroll(function() {

        headerH=$("header").innerHeight();
        $(".sel-con").css('top', headerH);

    })
    function navHover (i,$this) {
        $this.addClass('red');
        $this.parent().siblings().find('a').removeClass('red');
        if (i>0) {
            // console.log(i)
            $(".sel-con>ul").eq(i-1).css('display', 'block').animate({"opacity":"1.0"}, 'swing').siblings().css('display', 'none').animate({"opacity":"0"}, 'swing').finish();


            $(".sel-con").mouseleave(function(event) {
                $(".sel-con>ul").stop().slideUp('swing');
                $this.removeClass('red');
                $(".clicked").addClass('red');
            });
        } else {
            $(".sel-con>ul").addClass('hide').fadeOut('fast','swing').finish();
            $this.mouseleave(function(event) {
                $this.removeClass('red');
                $(".clicked").addClass('red');
            });

        }
        $(window).scroll(function(event) {

            $(".sel-con>ul").slideUp()


        });
    }
    $(".navsub").find('a').each(function(i,el) {
        $(this).on('mouseenter',function() {
            var $this = $(this);
            // navHover(i,$this);
            debounce(navHover(i,$this), 500)
        });

    });
    $(".navmain").find('a').each(function(i,el) {
        $(this).on('mouseenter',function() {
            var $this = $(this);
            debounce(navHover(i,$this), 500)
        });

    });
    function titHover(i,$this) {
        if(!$this.hasClass('select')){
            // console.log(i)
            $this.addClass('select').siblings().removeClass('select');

            // $this.parent().siblings(i).stop().fadeIn(1000).siblings('div').stop().fadeOut(1000).finish();
            if ($this.parents('.pro').hasClass('power')) {
                if(i<7){
                    $this.parent().siblings('div').eq(i).stop().fadeIn(1000).siblings('div').stop().fadeOut(1000).finish();
                }

            }else{
                $this.parent().siblings('div').eq(i).stop().fadeIn(1000).siblings('div').stop().fadeOut(1000).finish();
            }

        }
    }
    $(".tab-tit li").hover(function(event) {

        // var i = '.'+$(this).data('i');
        var i = $(this).index();
        var $this = $(this);
        debounce(titHover(i,$this), 500)


    },function(event){

    });
    $(".ser-adv").find(".bl_05_con").first().find("li").find(".img").css({"box-sizing":"border-box","padding":"2% 16%"});
})

/* 底部条 */
$(function(){

    function togfun (o,w) {
        $(".f_f_box").animate({"opacity":o})
        $(".footer_float").animate({"width":w}, 'slow',function () {
            // console.log(tog)
            $(".getshow").animate({"left":0})
        })
    }
    $(".togg").click(function(){

        togfun('0','0');

    });
    $(".getshow").click(function(){
        $(".f_f_box").animate({"opacity":'1'})
        $(".getshow").animate({"left":'-100'}, 'slow',function () {
            $(".footer_float").animate({"width":'100%'})
        })
    })
    /*$(window).scroll(function(){
        var scrollTop = $(this).scrollTop();
        var scrollHeight = $(document).height();
        var windowHeight = $(this).height();
        if (scrollTop + windowHeight >= scrollHeight-100) {

            $(".footer_float").css('display', 'none');
        } else{

            $(".footer_float").css('display', 'block');
        };
    });*/



})




