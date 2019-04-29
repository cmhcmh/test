selectphone('.c_select','.c_name');
			$(".calculate .tit").click(function() {
		$(this).parents(".calculate").find(".con").slideDown();
	});$(".calculate .close").click(function() {
		$(this).parents(".calculate").find(".con").slideUp();
	});
	if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
		new WOW().init();
	};

	selectphone('.c_select','.c_name');
			$(".calculate .tit2").click(function() {
		$(this).parents(".calculate").find(".con").slideDown();
	});$(".calculate .close").click(function() {
		$(this).parents(".calculate").find(".con").slideUp();
	});
	if (!(/msie [6|7|8|9]/i.test(navigator.userAgent))){
		new WOW().init();
	};
	$("#province_tan").change(function(){
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
		$("#city_tan").html(option);
		//$("#company_id").html(option1);
		for(var i in city){
			var option=$("<option></option>");
			$(option).val(city[i]['a_id']);
			$(option).html(city[i]['area_name']);
			$("#city_tan").append(option);
		}
	}

	});
	});
	$("#province_tan2").change(function(){
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
		$("#city_tan2").html(option);
		//$("#company_id").html(option1);
		for(var i in city){
			var option=$("<option></option>");
			$(option).val(city[i]['a_id']);
			$(option).html(city[i]['area_name']);
			$("#city_tan2").append(option);
		}
	}

	});
	});