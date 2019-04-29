/****提交表单************/
function mySubmit(theForm,url,result){
	var province_id=$('#province').val();
	var city_id=$('#city').val();
	var name=$('#name').val();
	var mobile=$('#mobile').val();
	var verify=$('#verify').val();
	var hourse=$('#hourse').val();

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

$("#province").change(function(){
var province_id=$(this).val();
$.ajax({
	url:'/mobile.php/Areacompany/get_citys',
	Type:"POST",
	data:"province_id="+province_id,
	dataType:"json",
	success:function(data){
		var city = data.city;
		var option=$("<option></option>");
		$(option).val("0");
		$(option).html("请选择");
		var option1=$("<option></option>");
		$(option1).val("0");
		$(option1).html("请选择");
		$("#city").html(option);
		//$("#company_id").html(option1);
		for(var i in city){
			var option=$("<option></option>");
			$(option).val(city[i]['a_id']);
			$(option).html(city[i]['area_name']);
			$("#city").append(option);
		}
	}
	
});
});

/****提交表单2************/
function s_mySubmit(theForm,url,result){
	var province_id=$('#province_2').val();
	var city_id=$('#city_2').val();
	var name=$('#s_name').val();
	var mobile=$('#s_mobile').val();
	var verify=$('#s_verify').val();
	var hourse=$('#s_hourse').val();
	var design=$('#design_name').val();

	if(province_id==''){

		 layer.msg('请选择省份');
		return false;
	}
	 if(city_id==0){

		layer.msg('请选择城市');
		return false;
	}
		if(design==''){

		layer.msg('请填写设计师名称');
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

$("#province_2").change(function(){
var province_id=$(this).val();
$.ajax({
	url:'/mobile.php/Areacompany/get_citys',
	Type:"POST",
	data:"province_id="+province_id,
	dataType:"json",
	success:function(data){
		var city = data.city;
		var option=$("<option></option>");
		$(option).val("0");
		$(option).html("请选择");
		var option1=$("<option></option>");
		$(option1).val("0");
		$(option1).html("请选择");
		$("#city_2").html(option);
		//$("#company_id").html(option1);
		for(var i in city){
			var option=$("<option></option>");
			$(option).val(city[i]['a_id']);
			$(option).html(city[i]['area_name']);
			$("#city_2").append(option);
		}
	}
	
});
});