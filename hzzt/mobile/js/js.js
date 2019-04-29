$(document).ready(function() {	
//置顶
	$('.go_top').click(function() {
		$('html,body').stop().animate({ scrollTop: 0 }, 500);
	});
	var $go_top = $('.go_top');
	$(window).scroll(function() {
		if($(this).scrollTop() > 40) {
			$go_top.show();
		} else {
			$go_top.hide();
		}
	});
	//菜单
	var img_flag = true;
	$('body').on('click', '.menu', function() {
		var $_this = $(this);
		if($_this.hasClass('on')) {
			$_this.removeClass('on')
			$('.menu_detail').removeClass('zoom_big').addClass('zoom_small');
			$('div.black_block').stop().fadeOut();
			var tt = setTimeout(function() {
				$('.menu_detail').hide();
				$('.menu_detail').addClass('zoom_big').removeClass('zoom_small');
				clearTimeout(tt);
			}, 500)
		} else {
			$('.menu_detail').addClass('zoom_big').show(); 
			$('div.black_block').stop().fadeIn();
			var tts = setTimeout(function() {
				clearTimeout(tts);
			}, 500);
			if(img_flag) {
				img_flag = false;
			}
			$_this.addClass('on');
		}
	});
	//定位
	$('.geo_close').click(function(){
		$('.location_detail').removeClass('fadeInUp').addClass('fadeOutDown');
		var tts = setTimeout(function() {
			$('.location_detail').hide().addClass('fadeInUp').removeClass('fadeOutDown');
			clearTimeout(tts);
		}, 500);
	});
	$('.loca').click(function() {
		$('.location_detail').show();
	});
// });
});