/*!
 * Public Library
 * version: 1.0.0
 */
;(function(a){
	a.A6={
		//公共头部效果
		headFn:function(){
			//搜索
			$('#search dl').hover(function(){
				$(this).children('dd').stop().slideDown('fast')	
			},function(){
				$(this).children('dd').stop().slideUp('fast')	
			})
			$('#search dd span').click(function(){
				var val=$(this).text();
				var oaction = $(this).attr("searchtype");
				$(this).parents('dl').children('dt').children('span').text(val);
				$(this).parents('dl').children('dt').children('span').attr('searchtype',val);
				$(this).parents('dd').slideUp('fast');
				$('#searchtype').val(oaction);
			});
			var $searchType=$('#searchtype');
			if($searchType.val()!=''){
				$('#search dd [searchtype='+$searchType.val()+']').click()
			}else{
				$('#search dd span').eq(0).click();
			}
			//城市列表切换
			$('.AreaNav').hover(function(){
				$(this).addClass('active');
			},function(){
				$(this).removeClass('active');	
			})
			//分站头部表单
			seajs.use('/js/plugins/jquery.form.min',function(){
				$('#headForm').ajaxForm({
					beforeSubmit:function(a,b,c){
						var flag=null;
						$.each(a,function(i,d){
							var tipname=$('[name='+d.name+']').data('tit');
							if(d.value==''||d.value==tipname){
								flag=true;
								alert(tipname+'不能为空');
								return false;	
							}else if(d.name=='phone'){
								if(!A6.validate.phone(d.value)){
									flag=true;
									alert('手机号码格式不正确')
									return false
								}
							}else if(d.name=='area'){
								if(!A6.validate.number(d.value)){
									flag=true;
									alert(tipname+'请输入数字')
									return false
								}
							}
						});
						if(flag){
							$('input').each(function(index, element) {
                                $(this).triggerHandler('blur');
                            });
							return false;	
						}
					},
					success:function(d){
						alert(JSON.stringify(d))	
					},
					error:function(){
						alert('error')	
					}	
				})	
			});
		},
		//获取验证码
		getcode:function(obj){
			var t=obj.innerHTML,n=60;
			(function(){
				if(n>0){
					obj.disabled=true
					obj.innerHTML='倒计时'+(n--)+'秒';
					setTimeout(arguments.callee,1000);
				}else{
					obj.disabled=false;
					obj.innerHTML=t;	
				}	
			})();
		},
		//活动倒计时
		countdown:function(opt){
			//  1h = 3600 s
			//  1s = 1000 ms
			;(function(){
				var t=null;	
				var sTime=new Date(opt.date);
				var mydate=new Date();
				var T=Math.floor((sTime-mydate)/1000); 
				if(T<=0){
					clearTimeout(t);
					opt.obj.html(opt.txt).parents('.count').addClass('pass');
					return;
				}
				var D=Math.floor(T/(3600*24));
				var H=Math.floor((T-D*24*3600)/3600);
				var M=Math.floor((T/60)-(D*24*60+H*60));
				var S=T%60;
				function setnum(d,t){
					if(d==0){
						return ''	
					}else{
						return d+t	
					}
				}
				var html=setnum(D,'天')+setnum(H,'小时')+setnum(M,'分')+S+'秒';
				opt.obj.html(html)
				t=setTimeout(function(){A6.countdown(opt)},1000);
			})();

		},
		//手风琴特效
		accordion:function(id){
			$(id).mouseover(function(){
				$(this).siblings().removeClass('active').end().addClass('active').find('img').lazyload();	
			}).eq(0).addClass('active').find('img').lazyload();
		},
		//验证规则
		validate:{
			required:function(e){
				if(!e==''){
					return true
				}
				return false
			},
			email:function(e){
				var reg=/^\w+@([0-9a-zA-Z]+[.])+[a-z]{2,4}$/;
				if(reg.test(e)){
					return true
				}
				return false
			},
			phone:function(e){
				var reg=/^1[3|5|8|7]\d{9}$/;
				if(reg.test(e)){
					return true
				}
				return false
			},
			number:function(e){
				if(!isNaN(e)){
					return true
				}
				return false 
			},
			idcard:function(e){
				var reg=/(^\d{15}$)|(^\d{17}([0-9]|X|x)$)/;
				if(reg.test(e)){
					return true
				}
				return false
			}
		},

		//提交信息模块
		submitinfo:function(id)
		{
			seajs.use('/js/plugins/jquery.form.min',function()
			{
				$(id).ajaxForm(
				{
					beforeSubmit:function(a,b,c)
					{
						var flag = null;
						var event_name = 'default';
						var properties = new Object();
						$.each(a, function(i, d)
						{
							var tipname = $('[name=' + d.name + ']').data('tit');
							if(d.value == "" && d.name != 'likestyle' && d.name != 'loupan')
							{
								flag = true;
								alert(tipname + '不能为空');
								return false;
							}
							else if(d.name == 'phone')
							{
								if(!A6.validate.phone(d.value))
								{
									flag = true;
									alert('手机号码格式不正确')
									return false
								}
							}
							// else if(d.name == 'acreage')
							// {
							// 	if(!A6.validate.number(d.value))
							// 	{
							// 		flag = true;
							// 		alert(tipname + '请输入数字')
							// 		return false
							// 	}
							// }

							if(d.name == 'action')
							{
								event_name = d.value;
								if(event_name == "special" || event_name == "formulate" || event_name == "loupan" || event_name == "activity" || event_name == "visit" || event_name == "price" || event_name == "plan" || event_name == "footer")
								{
									event_name == "submit";
								}
							}

							properties[d.name] = d.value;

						});

						ja.trackEvent(event_name, properties);
						userclear.track(event_name, properties);
						zhuge.track('预约报名', properties);

						if(flag)
						{
							$('input').each(function(index, element)
							{
								$(this).triggerHandler('blur');
							});
							return false;
						}
					},
					success:function(d)
					{
						alert(d.msg)	
						$(id)[0].reset();
					},
					error:function(d)
					{
						alert(d.msg)
					}	
				})	
			});
			//滚动
			var obj=$('#textScroll');
			if(obj.find('li').length>5)
			{
			var d=setInterval(function()
			{
			obj.children('li').eq(0).animate({height:0},'slow',function()
			{
			obj.append($(this).removeAttr('style'));
			});
			},2000);
			}
		},

		//底部计算器
		counter:function()
		{
			if($('#fixed-bottom-bar').length <= 0)
			{
				$('body').append('');
				// 获取风格偏好列表
				A6.getStyleList('#likestyle-txt');
			}
			seajs.use('/js/plugins/jquery.form.min', function()
			{
				var flag=A6.cookie('down-bar');
				var $bar=$('.fixed-bottom-box');
				var $form=$('#fixed-bottom-form');
				$form[0].reset();//刷新页面重置表单
				//控制显示隐藏
				function fn()
				{
					if(flag)
					{
						return
					}
					var winT = $(window).scrollTop();
					if(winT > 100)
					{
						$bar.addClass('active');
					}
					else
					{
						$bar.removeClass('active');
					}
				}
				$(window).on('scroll', fn);
				//关闭
				$bar.find('.close').click(function()
				{
					$bar.removeClass('active');
					flag = 1;
					A6.cookie('down-bar', 1);
				});
				//打开
				$('.down-bar-btn').click(function ()
				{
					$bar.addClass('active');
					flag=false;
					A6.delcookie('down-bar');
				});
				//表单异步提交
				$form.ajaxForm(
				{
					beforeSubmit:function(a, b, c)
					{
						var event_name = 'default';
						var properties = new Object();

						var flag=null, node=[$('#name-txt'), $('#phone-txt'), $('#acreage-txt'), $('#likestyle-txt')];
						$form.find('input, select').each(function(i, e)
						{
							if(i==1 || i==2){
								if($(e).val() == "" || $(e).val() == $(e).data('tit'))
								{
									alert($(e).data('tit').slice(3) + '不能为空');
									flag = true;
									return false
								}
							}
							

							if(e.name == 'action')
							{
								event_name = e.value;
							}

							properties[e.name] = e.value;
						});

						ja.trackEvent(event_name, properties);
						userclear.track(event_name, properties);
						zhuge.track('预约报名',properties);

						if(flag)
						{
							return false;
						}
						if(node[0].val().length > 5)
						{
							alert('姓名不能超过5个字');
							return false;
						}
						if(!A6.validate.phone(node[1].val()))
						{
							alert('手机号码格式不正确！');
							return false;
						}
						//if(!A6.validate.number(node[2].val()))
						//{
						//	alert('建筑面积请输入数字！');
						//	return false;
						//}
					},
					success:function(d)
					{
						alert(d.msg);
						//提交之后重置表单
						$form.find('input').each(function(index, element)
						{
							$(this).val($(this).data('tit'));
						});
						$form.find('select').val('');
					},
					error:function(d)
					{
						alert(d.msg)
					}
				})
			});
		},

		//弹层
		layer:function(opt){//二次封装
			A6.luck.open({
				content:'<div class="luck-tit">'+opt.title+'</div>'+opt.content,
				callback:function(){
					if(typeof opt.callback=='function'){
						opt.callback();
					}
				},
				width:opt.width?opt.width:'auto',
				height:opt.height?opt.height:'auto',
				closeBtn:true
			})
		},
		luck:{
			view:function(d) {
				var t=d.content?d.content:'';
					//主框架
				var luck = document.createElement("div");
					luck.className = "luck";
					luck.id = "luck";
				//内容容器
					var con = document.createElement("div");
					con.className = "luck-con";
				con.id = "luck-con";
				if(d.width){
					con.style.width=d.width;
				}
				if(d.height){
					con.style.height=d.height;
				}
				con.innerHTML=t;
				//关闭按钮
				var clo=document.createElement("div");
				clo.className='luck-close';
				clo.onclick=A6.luck.close;
				//遮罩层
				var oShade = document.createElement("div");
				oShade.className = "luck-shade";
				oShade.onclick=A6.luck.close;
				//组合框架
				if(d.closeBtn){
					con.appendChild(clo);	
				}
				luck.appendChild(con);
				luck.appendChild(oShade);
				return luck;
			},
			resize:function(){
				var obj=document.getElementById('luck-con');
				var t=((document.documentElement.clientHeight||document.body.clientHeight)/2-obj.offsetHeight/2)+(document.body.scrollTop||document.documentElement.scrollTop)
				obj.style.top=(t>0?t:0)+'px';
			},
			open:function(t) {
				document.body.appendChild(A6.luck.view(t));
				A6.luck.resize();
				if(typeof t.callback=='function'){
					t.callback();	
				}
			},
			close:function() {
				var obj = document.getElementById("luck");
				if(obj){
					document.body.removeChild(obj);
				}
			}
		},
		slide:function(opt){
			function Fn(){
				this.id=$(opt.id);
				this.len=this.id.find('img').length;
				this.num=0;	
				this.speet=opt.speet?opt.speet:'slow';
				this.auto=Number(opt.auto);
				this.btn=opt.btn;
				this.flag=true;
			}
			Fn.prototype.init=function(){
				var _self=this,d;
				_self.page();
				_self.id.find('img').one('trigger',function(){
					$(this).attr({src:$(this).data('original')});
				}).eq(0).trigger('trigger').eq(1).trigger('trigger');

				_self.id.find('.slider-panel').eq(_self.num).css({zIndex:1,display:'block'});
				if(_self.auto){
					d=setInterval(function(){
						_self.next();	
					},_self.auto)
				}
				_self.id.mouseenter(function(){
					clearInterval(d)
				})
				_self.id.mouseleave(function(){
					d=setInterval(function(){
						_self.next();	
					},_self.auto)	
				});
				if(_self.btn){_self.showBtn()}
			}
			Fn.prototype.next=function(){
				var _self=this;
				_self.num++;
				_self.num=(_self.num==_self.len?0:_self.num);
				_self.showPic(_self.num);	
			}
			Fn.prototype.prev=function(){
				var _self=this;
				_self.num--;
				_self.num=(_self.num<0?_self.len-1:_self.num);
				_self.showPic(_self.num);	
			}
			Fn.prototype.showPic=function(n){
				var _self=this;
				if(_self.flag==false){return}//防止连续点击
				_self.flag=false;
				_self.id.find('.slider-panel').eq(n).css({zIndex:2}).stop().fadeIn(_self.speet,function(){
					$(this).siblings().css({zIndex:0,display:'none'}).end().css('z-index',1);
					_self.flag=true;
				});
				_self.id.find('.slider-nav>li').eq(n).addClass('active').siblings().removeClass('active');
				_self.id.find('img').eq(n).trigger('trigger');
				var nextImg=_self.id.find('img').eq(n+1);
				if(nextImg){
					nextImg.trigger('trigger');
				}
			}
			Fn.prototype.showBtn=function(){
				var _self=this,btn="<div class='slider-prev'></div><div class='slider-next'></div>";
				_self.id.append(btn);
				_self.id.find('.slider-prev').click(function(){
					_self.prev.call(_self)
				});
				_self.id.find('.slider-next').click(function(){
					_self.next.call(_self)	
				});
			}
			Fn.prototype.page=function(){
				var page=[],_self=this;
				page.push('<ul class="slider-nav">');
				for(var i=0;i<_self.len;i++){
					page.push('<li class='+(i==0?"active":"")+'></li>');
				}
				page.push('</ul>');
				_self.id.append(page.join(''));
				_self.id.find('.slider-nav').on('click','li',function(){
					_self.showPic($(this).index());
				})
			}
			var fn=new Fn();
			fn.init();
		},
		cookie:function(c_name,value,expiredays,doMain){
			if(value){//设置cookie
				var exdate=new Date()
				exdate.setDate(exdate.getDate()+expiredays)
				document.cookie=c_name+ "=" +escape(value)+
				((expiredays==null) ? "" : ";expires="+exdate.toGMTString()) + ";path=/"+(doMain?";domain="+doMain:"");
			}else{//获取cookie
				if (document.cookie.length>0){
					c_start=document.cookie.indexOf(c_name + "=")
					if (c_start!=-1){ 
						c_start=c_start + c_name.length+1 
						c_end=document.cookie.indexOf(";",c_start)
						if (c_end==-1) c_end=document.cookie.length
						return unescape(document.cookie.substring(c_start,c_end))
					} 
				}
				return ""
			}
		},
		delcookie:function(c_name){//删除cookie
			A6.cookie(c_name,'1',-1)	
		},
		getStyleList:function(id){
			var html='<option value="现代简约">现代简约</option><option value="欧式古典">欧式古典</option><option value="新古典">新古典</option><option value="雅致主义">雅致主义</option><option value="美式乡村">美式乡村</option><option value="现代前卫">现代前卫</option><option value="新中式">新中式</option><option value="地中海式">地中海式</option><option value="简欧">简欧</option><option value="其他">其他</option>';
			$(id).append(html);
		}
	}	
}(window));
$(function(){
	setTimeout(function(){
		//表单默认值处理
		$('input[data-tit]').focus(function(){
			if(this.value==$(this).data('tit')){
				this.value='';	
			}
		}).blur(function(){
			var tit=$(this).data('tit');
			if(this.value==''){
				this.value=tit;	
			}
		}).each(function(i, e) {
			$(e).trigger('blur');
		});
	},500);
	$(".lazy").lazyload({ 
		effect : "fadeIn",
		threshold:200
	});

	//头部搜索框下拉
	$('#search dd span').click(function () {
		var key = $(this).attr('searchtype');
		var xiala = {
			building: ['翡翠山',"紫宸"],
			case: ['北欧', "美式", "日式", "简美", "实景"],
			photo: ['客厅', '厨房', '卫生间', '卧室', '餐厅'],
			story: ['装修报价', '选装修公司', '装修房子的步骤', '二手房装修注意事项']
		}
		var list = xiala[key] || [],
			liStr = '';
		for (var i = 0; i < list.length; i++) {
			liStr += '<li class="ge-select-item"> ' + list[i] + '</li>';
		}
		$('.ge-select-wrap').empty().append(liStr);
		$('#search .keyword').val('')
	});
	// $('.ge-select-wrap').on('click', '.ge-select-item', function () {
	//   $('#search .keyword').val($(this).html())
	//   $('.ge-select-wrap').slideToggle();
	// });
	$('.ge-select-wrap').on('click', '.ge-select-item', function () {
		$('#search .keyword').val($.trim($(this).html()))
		$('.ge-select-wrap').slideUp();
	})

	$('#search .keyword').focus(function(){
		$('.ge-select-wrap').slideDown();
	}).blur(function(){
		setTimeout(function(){
			$('.ge-select-wrap').slideUp();
		},1)
	})




});
/*
 * Lazy Load - jQuery plugin for lazy loading images
 * Copyright (c) 2007-2013 Mika Tuupola
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 * Project home:
 *   http://www.appelsiini.net/projects/lazyload
 * Version:  1.8.5
 */
!function(e,t,o,n){var i=e(t);e.fn.lazyload=function(r){function f(){var t=0;a.each(function(){var o=e(this);if(!d.skip_invisible||o.is(":visible"))if(e.abovethetop(this,d)||e.leftofbegin(this,d));else if(e.belowthefold(this,d)||e.rightoffold(this,d)){if(++t>d.failure_limit)return!1}else o.trigger("appear"),t=0})}var l,a=this,d={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:t,data_attribute:"original",skip_invisible:!0,appear:null,load:null};return r&&(n!==r.failurelimit&&(r.failure_limit=r.failurelimit,delete r.failurelimit),n!==r.effectspeed&&(r.effect_speed=r.effectspeed,delete r.effectspeed),e.extend(d,r)),l=d.container===n||d.container===t?i:e(d.container),0===d.event.indexOf("scroll")&&l.bind(d.event,function(){return f()}),this.each(function(){var t=this,o=e(t);t.loaded=!1,o.one("appear",function(){if(!this.loaded){if(d.appear){var n=a.length;d.appear.call(t,n,d)}e("<img />").bind("load",function(){o.hide().attr("src",o.data(d.data_attribute))[d.effect](d.effect_speed),t.loaded=!0;var n=e.grep(a,function(e){return!e.loaded});if(a=e(n),d.load){var i=a.length;d.load.call(t,i,d)}}).attr("src",o.data(d.data_attribute))}}),0!==d.event.indexOf("scroll")&&o.bind(d.event,function(){t.loaded||o.trigger("appear")})}),i.bind("resize",function(){f()}),/iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion)&&i.bind("pageshow",function(t){t.originalEvent&&t.originalEvent.persisted&&a.each(function(){e(this).trigger("appear")})}),e(o).ready(function(){f()}),this},e.belowthefold=function(o,r){var f;return f=r.container===n||r.container===t?i.height()+i.scrollTop():e(r.container).offset().top+e(r.container).height(),f<=e(o).offset().top-r.threshold},e.rightoffold=function(o,r){var f;return f=r.container===n||r.container===t?i.width()+i.scrollLeft():e(r.container).offset().left+e(r.container).width(),f<=e(o).offset().left-r.threshold},e.abovethetop=function(o,r){var f;return f=r.container===n||r.container===t?i.scrollTop():e(r.container).offset().top,f>=e(o).offset().top+r.threshold+e(o).height()},e.leftofbegin=function(o,r){var f;return f=r.container===n||r.container===t?i.scrollLeft():e(r.container).offset().left,f>=e(o).offset().left+r.threshold+e(o).width()},e.inviewport=function(t,o){return!(e.rightoffold(t,o)||e.leftofbegin(t,o)||e.belowthefold(t,o)||e.abovethetop(t,o))},e.extend(e.expr[":"],{"below-the-fold":function(t){return e.belowthefold(t,{threshold:0})},"above-the-top":function(t){return!e.belowthefold(t,{threshold:0})},"right-of-screen":function(t){return e.rightoffold(t,{threshold:0})},"left-of-screen":function(t){return!e.rightoffold(t,{threshold:0})},"in-viewport":function(t){return e.inviewport(t,{threshold:0})},"above-the-fold":function(t){return!e.belowthefold(t,{threshold:0})},"right-of-fold":function(t){return e.rightoffold(t,{threshold:0})},"left-of-fold":function(t){return!e.rightoffold(t,{threshold:0})}})}(jQuery,window,document);