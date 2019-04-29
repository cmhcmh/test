$(document).ready(function(){

	  window.onload = function () {
	        var hei = $(".sidel").offset().top;
	        var foot = document.getElementById("index").scrollHeight - 46;
	        $(window).scroll(function () {
	            var wh = $(window).scrollTop();
	            if (wh > hei) {
	                $(".sidel").addClass("sidel2");
	            } else {
	                $(".sidel").removeClass("sidel2");
	            }
	            if (wh > foot) {
	                $(".sidel").removeClass("sidel2");
	                $(".sidel").addClass("sidel3");
	            } else {
	                $(".sidel").removeClass("sidel3");
	            }
	        })
	    }
	    $(window).scroll(function(){
			var htmlTop = $(document).scrollTop();
			if( $(document).scrollTop() > 943){
				$(".sider").addClass("sidel2");	
			}else{
				$(".sider").removeClass("sidel2");
			}
		});
	
	$('.dot').dotdotdot({
		wrap: 'letter' 
	});
	
	$(".case_det .right dt").click(function() {
		$(this).parents("dl").children("dd").slideToggle();
		$(this).toggleClass("on")
	});
	
	jQuery(".bookbox").slide({"trigger":"click"});
	
	$(".choose_box dd a").hover(function(){
		//$(this).parents('dd').find('a').removeAttr("class");
		//$(this).addClass("on");
	});
	
	$('.hotdes_pic').slick({
		infinite: true,
		dots: false,
		autoplay: true,
		arrows: true
	});
	
	$(".deser li").hover(function() {
		$(this).children(".out").stop().show().animate({
			"top": "0",
			opacity: "1"
		}, 500)
	}, function() {
		$(this).children(".out").stop().hide().animate({
			"top": "-100%",
			opacity: "1"
		}, 1)
	});
	
	$(".xiala").hover(function() {
		$(this).children("ul").slideToggle();
	});
    $(document).on("click",".xiala ul li",function () {
        $(".xz").text($(this).text());
        var id=$(this).attr('id');
        var actname = $("#act1").val(id);

        $(".xzs").text($(this).text());
        var ids=$(this).attr('id');
        var actname = $("#act").val(ids);
    });
    
    $(".menu li").hover(function() {
		$(this).children("dl").slideDown(500);
	}, function(){
		$(this).children("dl").slideUp(0);
	});
	
	$(".index_3 li").hover(function() {
		$(this).children("h5").stop().show().animate({
			"top": "490px",
			opacity: "1"
		}, 500)
	}, function() {
		$(this).children("h5").stop().hide().animate({
			"top": "525px",
			opacity: "1"
		}, 1)
	});
	$(".chinamap .city a").hover(function(){
		$(this).parents('.chinamap').find('b').removeAttr("class");
		$(this).parents("b").addClass("hover");
	});
	
	$('.link_line').slick({
		infinite: true,
		dots: false,
		autoplay: true,
		arrows: false,
		vertical:true
	});
	$(".backtop").live("click", function(){
		var _this = $(this);
		$('html,body').animate({ scrollTop: 0 }, 500);
	});
	//	1019
	$('.do_box dd').on('click',function(){
   	    var gba=$(this).find('img').attr("src");
   	    var winHH=$(window).height();
   		$('.pohot span').find('img').attr("src",gba).parents('.pohot').fadeIn();
   	    var imghh=$(this).find('img').height()*3.3;
   		if(winHH<=imghh){
   			$('.pohot span').find('img').height(winHH-60)
   		}else{
   			$('.pohot span').find('img').height('auto')
   		}
   })

	$('.pohot .p-bg').on('click',function(){
		$(this).parents('.pohot').fadeOut();
    });
    $('.pohot i').on('click',function(){
		$(this).parents('.pohot').fadeOut();
    });
    $('.pohot .nmian').on('click',function(){
		$(this).parents('.pohot').fadeOut();
    });
   //	1019
});



function side(el1,el2,zt){
    var canGo = true;
    var al= $(el1);
    var main = $(el2);
    var on=zt;
    var abc=main.length;
	$(window).scroll(function() {
   		 main.each(function(index, element) {
        if ($(window).scrollTop()>=$(this).offset().top) {
            al.removeClass(on);
            al.eq(index).addClass(on);
        }
    	});
	})
    al.each(function(index, element) {
        $(this).click(function() {
            canGo = false;
            al.removeClass(on);
            $(this).addClass(on);
            $("html,body").stop(true, true).animate({
                "scrollTop": main.eq(index).offset().top
            }, 500,function(){
                canGo=true;
            });
        });
 });
}

function selectphone(select,selectval){
	$(selectval).each(function () {
		$(this).html( $(this).parent().find(select).find("option:selected").val());
	});
	$(select).change(function(){
		var opval=$(this).find("option:selected").html();
		$(this).parent().find(selectval).html(opval);
	});
}

