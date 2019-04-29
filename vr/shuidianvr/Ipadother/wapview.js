var myScroll;
function loaded() {
	myScroll = new iScroll('wrapper');
}
document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);

function AlertiframeForProduct(id){
	var url = "html/product/product"+id+".html";
	getHtml(url);
}

function AlertiframeForImg(id){
	var url = "html/img/img"+id+".html";
	if(!getHtml(url)){
		url = "html/img"+id+".html";
		getHtml(url);
	}
}

function getHtml(url){
	$.post(url, "isAjax=1", function(data){
		if(data){
			$("#jx_box_content").html("<div>"+data+"</div>");
			var imgNum=$("#jx_box_content img").length;
			if(imgNum == 0){
				setTimeout(function(){
					myScroll.refresh();
					myScroll.scrollTo(0, 0);
				},100)
			} else {
				$("#jx_box_content img").load(function(){
					if(!--imgNum){
						myScroll.refresh();
						myScroll.scrollTo(0, 0);
					}
				});
			}
		} else {
			$("#jx_box_content").html("<div>暂无内容</div>");
			return false;
		}
		$("#jx_box").show();
	});
	return true;
}
$(function(){
	$("#jx_box_close").click(function(){$("#jx_box").hide();});
});

var wapView = {
	act:function(type,data){
		if(type=='video'){
			this.alertVideo(data);
		}else if(type=='article'){
			this.alertArticle(data);
		}
	},
	alertVideo:function(data){
		getHtml('http://i.svrvr.com/?c=index&a=wap_img&id=1');
		setTimeout(function(){
			$("#jx_box_content").html('<iframe height=460 width=99% src="'+data+'" frameborder=0 allowfullscreen></iframe>')
		},1200);
		$("#jx_box_content").css('padding-top','12px');
	},
	alertArticle:function(data){
		console.log(data);
		AlertiframeForImg(data);
	}
}