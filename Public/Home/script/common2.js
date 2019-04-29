//js提交   
$("#jsBtn").click(function(){ 
	var action=$("#act").val();
	var url="/index.php/"+action+"/index";  

	document.searchmyform.action= url;  
	document.searchmyform.submit();     
});  
$(document).ready(function(){
		side('.sidel li','.trun','on');
});
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
};
 /****提交表单************/
function mySubmit_f4(theForm,url,result){
	var name=$('#name_f4').val();
	var mobile=$('#mobile_f4').val();
	var hourse=$('#hourse_f4').val();
	var mianji=$('#mianji_f4').val();
	
	if(name==''){
		 layer.msg('请填写姓名');
		return false;
	}


	if(mobile==''){
		 layer.msg('请填写手机');
		return false;
	}
	if(hourse==''){

		layer.msg('请填写楼盘');
		return false;
	}
	if(mianji==''){

		layer.msg('请填写面积');
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
};
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
};


$(function(){
// 2017-10-17波

$('.close').click(function(){
	$('.bo_Box,.bo_fide').hide()
})

$('.boPro').click(function(){
	$('.item0,.bo_fide').show()
	$('.bo_title').html('投诉建议');
	return false
})
$('.boOrder').click(function(){
	$('.item1,.bo_fide').show();
	$('.bo_title').html('在线下单');
$('#type_tan').val(1);
$('#design_new').val('');
	$('#design_name_tan').val('');
			$('#hourse_tan').val('');
$('#design_div').hide();
	return false
})

});

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
		$('.bo_title').html('在线下单');
		$('#type_tan').val(1);
		$('#hourse_tan').val(hourse_name);

	}else{

		$('.item1,.bo_fide').show();
		$('.bo_title').html('在线下单');
		$('#type_tan').val(1);
		$('#design_new').val('');
		$('#design_name_tan').val('');
		$('#design_div').hide();
	}
};





