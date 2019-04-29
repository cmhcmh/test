/**
 * 操作cookie工具
 * Created by zhaochengju on 16/5/21.
 */
var domain = '.ikongjian.com';
// 储存cookie
function setCookie(name, value, expiredays) {
    var exdate = new Date();
    if (expiredays == null) {
        expiredays = 365 * 10;
    }
    exdate.setTime(exdate.getTime() + expiredays * 24 * 60 * 60 * 1000);
    document.cookie = name + '=' + encodeURI(value) + (expiredays == 0 ? '' : ';expires=' + exdate.toUTCString()) + ';path=/;domain=' + domain;
}
// 读取cookies
function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg))
        return decodeURI(arr[2]);
    else
        return null;
}
// 删除cookies
function delCookie(name) {
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getCookie(name);
    if (cval != null) {
        document.cookie = name + "=" + cval + ";expires=" + exp.toUTCString();
    }
}