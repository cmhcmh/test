// 广告公共的js
// pos_id 位置id curr_page 当前页的需要展示广告位置的div层的id
function show_ad(pos_id,curr_page){
	$.ajax({
		type : "POST",
		url : "/index.php",
		data : {action:'list',pos_id:pos_id},
		success : function(data) {
			if(data){
				if(data.nofollow == "on"){
					var nofollow = " rel='nofollow' ";
				}else{
					var nofollow = "";
				}
				var appendHtml = ' <a '+nofollow+' href="'+data.clickurl+'"  target="'+data.opentype+'"><img src="'+data.url+'" height="'+data.height+'" width="'+data.width+'" alt="'+data.alt+'"></img></a>';
				$('#'+curr_page).append(appendHtml);
				$('#'+curr_page).show();
			}else{
				$('#'+curr_page).hide();
			}
		},
		error:function(){
			$('#'+curr_page).hide();
		}
	});
}