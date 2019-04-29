
	$("#hourse_province_id").change(function(){
	var province_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_citys',
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
			var option2=$("<option></option>");
			$(option2).val("0");
			$(option2).html("请选择");
			$("#hourse_city_id").html(option);
			$("#hourse_company_id").html(option1);
			$("#be_hourse").html(option2);
			for(var i in city){
				var option=$("<option></option>");
				$(option).val(city[i]['a_id']);
				$(option).html(city[i]['area_name']);
				$("#hourse_city_id").append(option);
			}
		}
		
	});
});

$("#hourse_city_id").change(function(){
	var city_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_district',
		Type:"POST",
		data:"city_id="+city_id,
		dataType:"json",
		success:function(data){
			var district = data.district;
			var option=$("<option></option>");
			$(option).val("0");
			$(option).html("请选择");
			var option1=$("<option></option>");
			$(option1).val("0");
			$(option1).html("请选择");
			$("#hourse_district_id").html(option);
			$("#be_hourse").html(option1);
			for(var i in district){
				var option=$("<option></option>");
				$(option).val(district[i]['a_id']);
				$(option).html(district[i]['area_name']);
				$("#hourse_district_id").append(option);
			}
		}
	});
});

$("#hourse_district_id").change(function(){
	var district_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_articles',
		Type:"POST",
		data:"district_id="+district_id+"&cat_id=19",
		dataType:"json",
		success:function(data){
			var district = data.article;
			var option=$("<option></option>");
			$(option).val("0");
			$(option).html("请选择");
			$("#be_hourse").html(option);
			for(var i in district){
				var option=$("<option></option>");
				$(option).val(district[i]['article_id']);
				$(option).html(district[i]['title']);
				$("#be_hourse").append(option);
			}
		}
	});
});
/*
$("#hourse_company_id").change(function(){
	var company_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_article',
		Type:"POST",
		data:"company_id="+company_id+"&cat_id=19",
		dataType:"json",
		success:function(data){
			var district = data.article;
			var option=$("<option></option>");
			$(option).val("0");
			$(option).html("请选择");
			$("#be_hourse").html(option);
			for(var i in district){
				var option=$("<option></option>");
				$(option).val(district[i]['article_id']);
				$(option).html(district[i]['title']);
				$("#be_hourse").append(option);
			}
		}
	});
});
*/


	$("#design_province_id").change(function(){
	var province_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_citys',
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
			var option2=$("<option></option>");
			$(option2).val("0");
			$(option2).html("请选择");
			$("#design_city_id").html(option);
			$("#design_company_id").html(option1);
			$("#be_design").html(option2);
			for(var i in city){
				var option=$("<option></option>");
				$(option).val(city[i]['a_id']);
				$(option).html(city[i]['area_name']);
				$("#design_city_id").append(option);
			}
		}
		
	});
});

$("#design_city_id").change(function(){
	var city_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_company',
		Type:"POST",
		data:"city_id="+city_id,
		dataType:"json",
		success:function(data){
			var district = data.company;
			var option=$("<option></option>");
			$(option).val("0");
			$(option).html("请选择");
			var option1=$("<option></option>");
			$(option1).val("0");
			$(option1).html("请选择");

			$("#design_company_id").html(option);
			$("#be_design").html(option1);
			for(var i in district){
				var option=$("<option></option>");
				$(option).val(district[i]['c_id']);
				$(option).html(district[i]['c_name']);
				$("#design_company_id").append(option);
			}
		}
	});
});

$("#design_company_id").change(function(){
	var company_id=$(this).val();
	$.ajax({
		url:'/system.php/Areacompany/get_article',
		Type:"POST",
		data:"company_id="+company_id+"&cat_id=23",
		dataType:"json",
		success:function(data){
			var district = data.article;
			var option=$("<option></option>");
			$(option).val("0");
			$(option).html("请选择");
			$("#be_design").html(option);
			for(var i in district){
				var option=$("<option></option>");
				$(option).val(district[i]['article_id']);
				$(option).html(district[i]['title']);
				$("#be_design").append(option);
			}
		}
	});
});
