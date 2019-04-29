// 分析用户来源  请求api

	// 当前的路径
	var user_land_url = readck("user_land_url");
	var user_source_url = readck("user_source_url");
	
	var date=new Date();
	var expireDays=1;
	//将date设置为1天以后的时间
	date.setTime(date.getTime()+expireDays*24*3600*1000);//或者也可以用 date.setDate(date.getDate+expireDays)
	
	if(user_land_url == "" ){
		var selfUrl = window.location.href;  
		//将 cookie设置为1天后过期
		document.cookie="user_land_url="+selfUrl+"; expire="+date.toGMTString();
	}
	var referUrl = document.referrer;
	
	if(referUrl.length > 0){
		if(referUrl.indexOf("dyrs") > 0 ){
		    
		}else{
			if(user_source_url == ''){
				//将 cookie设置为1天后过期
				document.cookie="user_source_url="+referUrl+"; expire="+date.toGMTString();
			}		
		}	
	} 


function readck(name){
		var cookieValue = "";
		var search_s = name + "=";
		if(document.cookie.length > 0)
		{ 
			offset = document.cookie.indexOf(search_s);
			if (offset != -1)
			{ 
				offset += search_s.length;
				end = document.cookie.indexOf(";", offset);
				if (end == -1) end = document.cookie.length;
				cookieValue = unescape(document.cookie.substring(offset, end))
			}
		}
		return cookieValue;
	}
