//初次访问
if (window.WebViewJavascriptBridge) {
    WebViewJavascriptBridge.callHandler('login');
} else {

}
function videoPause() {
    document.getElementById("video_cont").get(0).pause();
}
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}
var token = "";
$(document).ready(function () {
    token = GetQueryString("token");
    var ua = navigator.userAgent.toLowerCase();
    var params = "token=" + token + "&areaCode=" + GetQueryString("areaCode") + "&imei=" + GetQueryString("imei") + "&lat=" + GetQueryString("lat") + "&lng=" + GetQueryString("lng");
    if (ua.indexOf("ikongjian") >= 0) {
        for (var i = 0; i < document.getElementsByTagName("a").length; i++) {
            var href = document.getElementsByTagName("a")[i].attributes["href"];
            if (href) {
                if (href.value.indexOf("javascript") != 0) {
                    if (href.value.indexOf("tel:") != 0) {
                        if (href.value.indexOf("?") >= 0) {
                            document.getElementsByTagName("a")[i].setAttribute("href", href.value + "&" + params);
                        } else {
                            document.getElementsByTagName("a")[i].setAttribute("href", href.value + "?" + params);
                        }
                    }
                }

            }

        }
        for (var i = 0; i < document.getElementsByTagName("form").length; i++) {
            var action = document.getElementsByTagName("form")[i].attributes["action"].value;
            if (action.indexOf("?") >= 0) {
                document.getElementsByTagName("form")[i].setAttribute("action", action + "&" + params);
            } else {
                document.getElementsByTagName("form")[i].setAttribute("action", action + "?" + params);
            }
        }

        $('.bottom_nav').hide();
        $('header').hide();
        $('.houseHr').hide();
        $('.tabNav').hide();
        $('header').next().css("padding-top", '0');
    }else{
        var nowHref=window.location.href;
        if(nowHref.indexOf("/changeCity")==-1 && nowHref.indexOf("/activitys")==-1){
            var city =  getCookie("ik_area");
            if(city==null){
                window.location.href="/changeCity";
            }
        }
    }
})
