var _ucq = _ucq || [];
window.userclear = {track : function(){}}
// _ucq.push(['enableLinkTracking']);
// (function() {
// var u="//sdk31.lbadvisor.com/";
// _ucq.push(['setTrackerUrl', u+'t.gif']);
// _ucq.push(['setSiteId', '300925020']);
// var d=document, g=d.createElement('script'), 
// s=d.getElementsByTagName('script')[0];
// g.type='text/javascript'; g.async=true; g.defer=true; 
// g.src=u+'js/userclear.min.js'; s.parentNode.insertBefore(g,s);
// })();

window._pt_lt = new Date().getTime();
window._pt_sp_2 = [];
_pt_sp_2.push('setAccount,3dcbc51a');
var _protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
(function() {
    var atag = document.createElement('script'); atag.type = 'text/javascript'; atag.async = true;
    atag.src = _protocol + 'js.ptengine.cn/3dcbc51a.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(atag, s);
})();

(function(){
window.zhuge = window.zhuge || [];
window.zhuge.methods = "_init identify track getDid getSid getKey setSuperProperty setUserProperties setPlatform".split(" ");
window.zhuge.factory = function(b) {
return function() {
var a = Array.prototype.slice.call(arguments);
a.unshift(b);
window.zhuge.push(a);
return window.zhuge;
}
};
for (var i = 0; i < window.zhuge.methods.length; i++) {
var key = window.zhuge.methods[i];
window.zhuge[key] = window.zhuge.factory(key);
}
window.zhuge.load = function(b, x) {
if (!document.getElementById("zhuge-js")) {
var a = document.createElement("script");
var verDate = new Date();
var verStr = verDate.getFullYear().toString()
+ verDate.getMonth().toString() + verDate.getDate().toString();
a.type = "text/javascript";
a.id = "zhuge-js";
a.async = !0;
a.src ='https://data.dyrs.com.cn/zhuge.js?v=' + verStr;
a.onerror = function(){
window.zhuge.identify = window.zhuge.track = function(ename, props, callback){
if(callback && Object.prototype.toString.call(callback) === '[object Function]')callback();
};
};
var c = document.getElementsByTagName("script")[0];
c.parentNode.insertBefore(a, c);
window.zhuge._init(b, x)
}
};
window.zhuge.load('b4403c5cf3ec4de58ab37744db6f26a6');
})();

function bread(a, b)
{
	var reg = new RegExp("/"+b+"\\d+", "gim");
	var c = a.replace(reg, "");
	window.location.href = "//" + c;
}