var top_contact_status = 1 ;



$(document).ready(function(e) {


     $(".main_nav").css("background","rgba(255,255,255,0.5)");
     $(window).scroll(function() {

        if ($(document).scrollTop()>42){
               if(top_contact_status == 1){
                        $(".top_contact").fadeOut('2000');
                        top_contact_status = 0 ;

                         $(".main_nav").stop(true,true) ;
                         $(".main_nav").animate({top:"0px"},2000);

                         $(".main_nav").animate({height:"110px"},500);
                         $(".main_nav_box").animate({height:"110px"},500);
                         $(".nav_content").animate({height:"110px"},500);
                         $(".nav_content li").animate({height:"110px"},500);
               }
        }else{
               if(top_contact_status == 0){
                        $(".top_contact").fadeIn('2000');
                        top_contact_status = 1 ;

                         $(".main_nav").stop(true,true) ;
                         $(".main_nav").animate({top:"40px"},2000);

                         $(".main_nav").css("height","120px");
                         //$(".main_nav").animate({height:"120px"},2000);
                         $(".main_nav_box").animate({height:"120px"},2000);
                         $(".nav_content").animate({height:"120px"},2000);
                         $(".nav_content li").animate({height:"120px"},2000);
               }
        }

        if ($(document).scrollTop()<=10){
/* 
             if (parseInt(istop) > 0){
                     $(".main_nav_box").stop(true,true) ;
                     istop = 0 ;
              } */


        }else{
          /*   if(parseInt(istop) == 0){
                $(".main_nav_box").stop(true,true) ;
                istop = 1 ;
           } */

        }

    });

});





$(function () {
 var $spans = $(".yyxw_con1 .title_header1 span");
 $spans.hover(function () {
 var index = $spans.index(this);
 $(this).addClass("No_active")
 .siblings("span").removeClass("No_active");
 $('.yyxw_con1 .article_box1').eq(index).show()
 .siblings('.yyxw_con1 .article_box1').hide();
 $(this).siblings('a').eq(index).show()
 .siblings('a').hide();
 })
})





$(function () {
 var $spans = $(".title_zxyy li");
 $spans.hover(function () {
 var index = $spans.index(this);
 $(this).addClass("No_active")
 .siblings("li").removeClass("No_active");
 $('.zxyy_box').eq(index).show()
 .siblings('.zxyy_box').hide();
 $(this).siblings('a').eq(index).show()
 .siblings('a').hide();
 })
})
	
	