(function(){var h=this,k=function(a){return"string"==typeof a},l=Date.now||function(){return+new Date};var n=function(a){a=parseFloat(a);return isNaN(a)||1<a||0>a?0:a};var p=Array.prototype.indexOf?function(a,b,c){return Array.prototype.indexOf.call(a,b,c)}:function(a,b,c){c=null==c?0:0>c?Math.max(0,a.length+c):c;if(k(a))return k(b)&&1==b.length?a.indexOf(b,c):-1;for(;c<a.length;c++)if(c in a&&a[c]===b)return c;return-1},q=Array.prototype.filter?function(a,b,c){return Array.prototype.filter.call(a,b,c)}:function(a,b,c){for(var d=a.length,e=[],f=0,g=k(a)?a.split(""):a,m=0;m<d;m++)if(m in g){var x=g[m];b.call(c,x,m,a)&&(e[f++]=x)}return e},r=Array.prototype.map?function(a,
b,c){return Array.prototype.map.call(a,b,c)}:function(a,b,c){for(var d=a.length,e=Array(d),f=k(a)?a.split(""):a,g=0;g<d;g++)g in f&&(e[g]=b.call(c,f[g],g,a));return e},aa=function(a){return Array.prototype.concat.apply([],arguments)};var t=function(a){var b=[],c=0,d;for(d in a)b[c++]=a[d];return b};var u=function(a){u[" "](a);return a};u[" "]=function(){};var v=function(a,b){for(var c in a)Object.prototype.hasOwnProperty.call(a,c)&&b.call(void 0,a[c],c,a)};var ba=n("0.20"),ca=n("0.0"),da=n("1.0"),ea=n("1.0"),fa=n("0.2"),ha=n("0.0"),ia=n("0.1"),ja=/^true$/.test("false");var ka=/^true$/.test("true"),la=/^true$/.test("true"),ma=/^true$/.test("true");var w=null,oa=function(){var a=t(na);this.o={};this.b={};a=a||[];for(var b=0,c=a.length;b<c;++b)this.b[a[b]]=""},y=function(){if(null===w){w="";try{var a=h.top.location.hash;if(a){var b=a.match(/\bdeid=([\d,]+)/);w=b?b[1]:""}}catch(c){}}return w},A=function(a,b,c){var d=z;if(c?d.b.hasOwnProperty(c)&&""==d.b[c]:1){var e;e=(e=y())?(e=e.match(new RegExp("\\b("+a.join("|")+")\\b")))?e[0]:null:null;if(e)a=e;else a:{if(!(1E-4>Math.random())&&(e=Math.random(),e<b)){try{var f=new Uint32Array(1);h.crypto.getRandomValues(f);
e=f[0]/65536/65536}catch(g){e=Math.random()}a=a[Math.floor(e*a.length)];break a}a=null}a&&""!=a&&(c?d.b.hasOwnProperty(c)&&(d.b[c]=a):d.o[a]=!0)}},B=function(a){var b=z;return b.b.hasOwnProperty(a)?b.b[a]:""},pa=function(){var a=z,b=[];v(a.o,function(a,d){b.push(d)});v(a.b,function(a){""!=a&&b.push(a)});return b};var na={g:2,i:4,j:5,l:7,f:8,h:9},C={g:{c:"376635470",a:"376635471"},i:{c:"659234980",a:"659234981"},j:{a:"659235991"},l:{a:"659245992"},f:{c:"659238990",a:"659238991"},h:{c:"19501577",a:"19501578"}},z=null,qa=function(){var a=aa.apply([],r(t(C),function(a){return t(a)},void 0)),b=q(y().split(","),function(b){return""!=b&&!(0<=p(a,b))});return 0<b.length?"&debug_experiment_id="+b.join(","):""};var ra=/^UA-\d+-\d+%3A[\w-]+(?:%2C[\w-]+)*(?:%3BUA-\d+-\d+%3A[\w-]+(?:%2C[\w-]+)*)*$/,sa=/^[\w-]+(?:\.[\w-]+)*$/,D=/^\d+\.fls\.doubleclick\.net$/,ta=/;gac=([^;?]+)/,ua=/;gclaw=([^;?]+)/,E=function(a,b){if(D.test(a.location.host)){if((b=a.location.href.match(ua))&&2==b.length&&b[1].match(sa))return b[1]}else{var c=(b||"_gcl")+"_aw";b=[];a=a.cookie.split(";");c=new RegExp("^\\s*"+c+"=\\s*(.*?)\\s*$");for(var d=0;d<a.length;d++){var e=a[d].match(c);e&&b.push(e[1])}a=[];if(b&&0!=b.length)for(c=0;c<b.length;c++)d=
b[c].split("."),3==d.length&&"GCL"==d[0]&&d[1]&&a.push(d[2]);if(0<a.length)return a.join(".")}return""};var F=function(a,b,c,d){for(var e=c.length;0<=(b=a.indexOf(c,b))&&b<d;){var f=a.charCodeAt(b-1);if(38==f||63==f)if(f=a.charCodeAt(b+e),!f||61==f||38==f||35==f)return b;b+=e+1}return-1},G=/#|$/,va=function(a){var b=a.search(G),c=F(a,0,"fmt",b);if(0>c)return null;var d=a.indexOf("&",c);if(0>d||d>b)d=b;c+=4;return decodeURIComponent(a.substr(c,d-c).replace(/\+/g," "))},wa=/[?&]($|#)/,H=function(a,b,c){for(var d=a.search(G),e=0,f,g=[];0<=(f=F(a,e,b,d));)g.push(a.substring(e,f)),e=Math.min(a.indexOf("&",
f)+1||d,d);g.push(a.substr(e));a=g.join("").replace(wa,"$1");c=null!=c?"="+encodeURIComponent(String(c)):"";(b+=c)?(c=a.indexOf("#"),0>c&&(c=a.length),d=a.indexOf("?"),0>d||d>c?(d=c,e=""):e=a.substring(d+1,c),c=[a.substr(0,d),e,a.substr(c)],a=c[1],c[1]=b?a?a+"&"+b:b:a,b=c[0]+(c[1]?"?"+c[1]:"")+c[2]):b=a;return b};var xa=function(a,b){var c=va(b);c&&(b=H(b,"rfmt",c));b=H(b,"fmt",4);c=a.createElement("script");c.src=b;c.onload=function(){};a.getElementsByTagName("script")[0].parentElement.appendChild(c);return!0};var I="google_conversion_id google_conversion_format google_conversion_type google_conversion_order_id google_conversion_language google_conversion_value google_conversion_evaluemrc google_conversion_currency google_conversion_domain google_conversion_label google_conversion_color google_disable_viewthrough google_enable_display_cookie_match google_remarketing_only google_remarketing_for_search google_conversion_items google_conversion_merchant_id google_user_id google_custom_params google_conversion_date google_conversion_time google_conversion_js_version onload_callback opt_image_generator google_conversion_page_url google_conversion_referrer_url google_gtm google_gcl_cookie_prefix google_read_gcl_cookie_opt_out google_basket_merchant_id google_basket_feed_country google_basket_feed_language google_basket_discount google_basket_transaction_type".split(" "),
J=["google_conversion_first_time","google_conversion_snippets"],K=function(a){return null!=a?encodeURIComponent(a.toString()):""},L=function(a){if(null!=a){a=a.toString().substring(0,512);var b=a.indexOf("#");return-1==b?a:a.substring(0,b)}return""},M=function(a,b){b=K(b);return""!=b&&(a=K(a),""!=a)?"&".concat(a,"=",b):""},N=function(a){var b=typeof a;return null==a||"object"==b||"function"==b?null:String(a).replace(/,/g,"\\,").replace(/;/g,"\\;").replace(/=/g,"\\=")},ya=function(a){if((a=a.google_custom_params)&&
"object"==typeof a&&"function"!=typeof a.join){var b=[];for(g in a)if(Object.prototype.hasOwnProperty.call(a,g)){var c=a[g];if(c&&"function"==typeof c.join){for(var d=[],e=0;e<c.length;++e){var f=N(c[e]);null!=f&&d.push(f)}c=0==d.length?null:d.join(",")}else c=N(c);(d=N(g))&&null!=c&&b.push(d+"="+c)}var g=b.join(";")}else g="";return""==g?"":"&".concat("data=",encodeURIComponent(g))},za=function(a){if(null!=a){a=a.toString();if(2==a.length)return M("hl",a);if(5==a.length)return M("hl",a.substring(0,
2))+M("gl",a.substring(3,5))}return""};function O(a){return"number"!=typeof a&&"string"!=typeof a?"":K(a.toString())}
var Aa=function(a){if(!a)return"";a=a.google_conversion_items;if(!a)return"";for(var b=[],c=0,d=a.length;c<d;c++){var e=a[c],f=[];e&&(f.push(O(e.value)),f.push(O(e.quantity)),f.push(O(e.item_id)),f.push(O(e.adwords_grouping)),f.push(O(e.sku)),b.push("("+f.join("*")+")"))}return 0<b.length?"&item="+b.join(""):""},Ba=function(a,b){if(b.google_read_gcl_cookie_opt_out||b.google_remarketing_only||b.google_conversion_domain)return"";var c="";if(z&&B(7)==C.l.a){if(b.google_gcl_cookie_prefix&&/^[a-zA-Z0-9_]+$/.test(b.google_gcl_cookie_prefix))return c=
E(a,b.google_gcl_cookie_prefix),M("gclaw",c);(b=E(a))&&(c=M("gclaw",b))}if(z&&B(5)==C.j.a){if(D.test(a.location.host))var d=(d=a.location.href.match(ta))&&2==d.length&&d[1].match(ra)?decodeURIComponent(d[1]):"";else{b=[];a=a.cookie.split(";");for(var e=/^\s*_gac_(UA-\d+-\d+)=\s*(.+)\s*$/,f=0;f<a.length;f++){var g=a[f].match(e);g&&3==g.length&&b.push({m:g[1],value:g[2]})}a={};if(b&&0!=b.length){for(e=0;e<b.length;e++)f=b[e].value.split("."),"1"==f[0]&&3==f.length&&f[1]&&(a[b[e].m]||(a[b[e].m]=[]),
a[b[e].m].push({timestamp:f[1],s:f[2]}));Object.keys&&Object.keys(a)}b=[];for(d in a){e=[];f=a[d];for(g=0;g<f.length;g++)e.push(f[g].s);b.push(d+":"+e.join(","))}d=0<b.length?b.join(";"):""}c+=d?M("gac",d):""}return c},Ca=function(a,b,c){var d=[];if(a){var e=a.screen;e&&(d.push(M("u_h",e.height)),d.push(M("u_w",e.width)),d.push(M("u_ah",e.availHeight)),d.push(M("u_aw",e.availWidth)),d.push(M("u_cd",e.colorDepth)));a.history&&d.push(M("u_his",a.history.length))}c&&"function"==typeof c.getTimezoneOffset&&
d.push(M("u_tz",-c.getTimezoneOffset()));b&&("function"==typeof b.javaEnabled&&d.push(M("u_java",b.javaEnabled())),b.plugins&&d.push(M("u_nplug",b.plugins.length)),b.mimeTypes&&d.push(M("u_nmime",b.mimeTypes.length)));return d.join("")};function Da(a){a=a?a.title:"";if(void 0==a||""==a)return"";var b=function(a){try{return decodeURIComponent(a),!0}catch(e){return!1}};a=encodeURIComponent(a);for(var c=256;!b(a.substr(0,c));)c--;return"&tiba="+a.substr(0,c)}
var P=function(a,b,c,d){var e="";if(b){if(a.top==a)var f=0;else{var g=a.location.ancestorOrigins;if(g)f=g[g.length-1]==a.location.origin?1:2;else{g=a.top;try{var m;if(m=!!g&&null!=g.location.href)c:{try{u(g.foo);m=!0;break c}catch(x){}m=!1}f=m}catch(x){f=!1}f=f?1:2}}a=c?c:1==f?a.top.location.href:a.location.href;e+=M("frm",f);e+=M("url",L(a));e+=M("ref",L(d||b.referrer))}return e},Q=function(a,b){return!(ka||b&&Ea.test(navigator.userAgent))||a&&a.location&&a.location.protocol&&"https:"==a.location.protocol.toString().toLowerCase()?
"https:":"http:"},R=function(a,b,c){c=c.google_remarketing_only?"googleads.g.doubleclick.net":c.google_conversion_domain||"www.googleadservices.com";return Q(a,/www[.]googleadservices[.]com/i.test(c))+"//"+c+b},Fa=function(a,b,c,d){var e="/?";"landing"==d.google_conversion_type&&(e="/extclk?");e=[d.google_remarketing_only?"/pagead/viewthroughconversion/":"/pagead/conversion/",K(d.google_conversion_id),e,"random=",K(d.google_conversion_time)].join("");e=R(a,e,d);a=[M("cv",d.google_conversion_js_version),
M("fst",d.google_conversion_first_time),M("num",d.google_conversion_snippets),M("fmt",d.google_conversion_format),M("userId",d.google_user_id),M("value",d.google_conversion_value),M("evaluemrc",d.google_conversion_evaluemrc),M("currency_code",d.google_conversion_currency),M("label",d.google_conversion_label),M("oid",d.google_conversion_order_id),M("bg",d.google_conversion_color),za(d.google_conversion_language),M("guid","ON"),M("disvt",d.google_disable_viewthrough),M("eid",pa().join()),Ca(a,b,d.google_conversion_date),
ya(d),M("gtm",d.google_gtm),Ba(c,d),P(a,c,d.google_conversion_page_url,d.google_conversion_referrer_url),d.google_remarketing_for_search&&!d.google_conversion_domain?"&srr=n":"",Da(c)].join("")+qa();d.google_remarketing_only||d.google_conversion_domain?d=a:(S(d)&&!d.google_basket_transaction_type&&(d.google_basket_transaction_type="mrc"),b=[M("mid",d.google_basket_merchant_id),M("fcntr",d.google_basket_feed_country),M("flng",d.google_basket_feed_language),M("dscnt",d.google_basket_discount),M("bttype",
d.google_basket_transaction_type)].join(""),d=[a,b,Aa(d)].join(""),d=2E3<d.length?[a,M("item","elngth")].join(""):d);return e+d},T=function(a,b,c,d,e,f,g){return'<iframe name="'+a+'"'+(g?' id="'+g+'"':"")+' title="'+b+'" width="'+d+'" height="'+e+'"'+(c?' src="'+c+'"':"")+' frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true"'+(f?' style="display:none"':"")+' scrolling="no"></iframe>'},Ga=function(a){return{ar:1,bg:1,cs:1,da:1,de:1,el:1,en_AU:1,en_US:1,en_GB:1,
es:1,et:1,fi:1,fr:1,hi:1,hr:1,hu:1,id:1,is:1,it:1,iw:1,ja:1,ko:1,lt:1,nl:1,no:1,pl:1,pt_BR:1,pt_PT:1,ro:1,ru:1,sk:1,sl:1,sr:1,sv:1,th:1,tl:1,tr:1,vi:1,zh_CN:1,zh_TW:1}[a]?a+".html":"en_US.html"},Ea=/Android ([01]\.|2\.[01])/i,Ha=function(a,b){if(!b.google_remarketing_only||!b.google_enable_display_cookie_match||!z||B(2)!=C.g.a)return"";a=Q(a,!1)+"//bid.g.doubleclick.net/xbbe/pixel?d=KAE";return T("google_cookie_match_frame","Google cookie match frame",a,1,1,!0,null)};
function U(a,b){return'<img height="1" width="1" border="0" alt="" src="'+a.replace("gen204Type",b)+'" style="display:none" />'}
var Ia=function(a){if(z&&B(4)==C.i.a){var b=Math.floor(1E9*Math.random()),c=Q(a,!1)+"//pagead2.googlesyndication.com/pagead/gen_204?id=beacon-api-web-survey&type=gen204Type";c+=M("random",b);c+=M("time",l());if(a.navigator&&a.navigator.sendBeacon){try{var d=c.replace("gen204Type","send-beacon");a.navigator.sendBeacon(d,"")}catch(e){}return U(c,"img")}return U(c,"beacon-undefined")}return""},W=function(a,b,c,d){var e="";d.google_remarketing_only&&d.google_enable_display_cookie_match&&(z&&A([C.g.c,
C.g.a],ba,2),e=Ha(a,d));3==d.google_conversion_format&&d.google_remarketing_only&&!d.google_conversion_domain&&(z&&A([C.f.c,C.f.a],fa,8),z&&A([C.f.a],ha,8));1!=d.google_conversion_format&&2!=d.google_conversion_format||d.google_conversion_domain||z&&A([C.h.c,C.h.a],ia,9);d.google_remarketing_only||d.google_conversion_domain||(z&&A([C.j.a],da,5),d.google_read_gcl_cookie_opt_out||z&&A([C.l.a],ea,7));z&&A([C.i.c,C.i.a],ca,4);b=Fa(a,b,c,d);var f=function(a,b,c,d){return'<img height="'+c+'" width="'+b+
'" border="0" alt="" src="'+a+'"'+(d?' style="display:none"':"")+" />"};if(0==d.google_conversion_format&&null==d.google_conversion_domain)return'<a href="'+(Q(a,!1)+"//services.google.com/sitestats/"+Ga(d.google_conversion_language)+"?cid="+K(d.google_conversion_id))+'" target="_blank">'+f(b,135,27,!1)+"</a>"+e;if(1<d.google_conversion_snippets||3==d.google_conversion_format){var g=b;null==d.google_conversion_domain&&(g=3==d.google_conversion_format?b:H(b,"fmt",3));return V(c,d,g)?e:f(g,1,1,!0)+
e+Ia(a)}a=null;(z&&B(9)==C.h.a||!d.google_conversion_domain&&ja)&&V(c,d,b)&&(a="goog_conv_iframe",b="");return T("google_conversion_frame","Google conversion frame",b,2==d.google_conversion_format?200:300,2==d.google_conversion_format?26:13,!1,a)+e};function Ja(){return new Image}function V(a,b,c){if(b.google_conversion_domain)return!1;if(!b.google_remarketing_only||z&&B(8)===C.f.a||b.google_remarketing_only&&!b.google_conversion_domain&&ma)try{return xa(a,c)}catch(d){}return!1}
var Ka=function(a,b){var c=a.opt_image_generator&&a.opt_image_generator.call;b+=M("async","1");var d=Ja;c&&(d=a.opt_image_generator);a=d();a.src=b;a.onload=function(){}},X=function(a,b,c){var d=Math.floor(1E9*Math.random());d=[K(c.google_conversion_id),"/?random=",d].join("");d=Q(a,!1)+"//www.google.com/ads/user-lists/"+d;a=[M("label",c.google_conversion_label),M("fmt","3"),P(a,b,c.google_conversion_page_url,c.google_conversion_referrer_url)].join("");Ka(c,d+a)},La=function(a,b){for(var c=document.createElement("iframe"),
d=[],e=[],f=0;f<b.google_conversion_items.length;f++){var g=b.google_conversion_items[f];g&&g.quantity&&g.sku&&(d.push(g.sku),e.push(g.quantity))}f="";null!=b.google_conversion_language&&(g=b.google_conversion_language.toString(),5==g.length&&(f="&mrc_language="+g.substring(0,2)+"&mrc_country="+g.substring(3,5)));a=Q(a,!1)+"//www.google.com/ads/mrc";c.src=a+"?sku="+d.join(",")+"&qty="+e.join(",")+"&oid="+b.google_conversion_order_id+"&mcid="+b.google_conversion_merchant_id+f;c.style.width="1px";c.style.height=
"1px";c.style.display="none";return c},S=function(a){return!!a.google_conversion_merchant_id&&!!a.google_conversion_order_id&&!!a.google_conversion_items},Ma=function(a){if("landing"==a.google_conversion_type||!a.google_conversion_id||a.google_remarketing_only&&a.google_disable_viewthrough)return!1;a.google_conversion_date=new Date;a.google_conversion_time=a.google_conversion_date.getTime();a.google_conversion_snippets="number"==typeof a.google_conversion_snippets&&0<a.google_conversion_snippets?
a.google_conversion_snippets+1:1;"number"!=typeof a.google_conversion_first_time&&(a.google_conversion_first_time=a.google_conversion_time);a.google_conversion_js_version="8";0!=a.google_conversion_format&&1!=a.google_conversion_format&&2!=a.google_conversion_format&&3!=a.google_conversion_format&&(a.google_conversion_format=3);!1!==a.google_enable_display_cookie_match&&(a.google_enable_display_cookie_match=!0);z=new oa;la&&(a.google_remarketing_for_search=!1);return!0},Na=function(a){for(var b=0;b<
I.length;b++)a[I[b]]=null},Oa=function(a){for(var b={},c=0;c<I.length;c++)b[I[c]]=a[I[c]];for(c=0;c<J.length;c++)b[J[c]]=a[J[c]];return b},Pa=function(a){var b=document.getElementsByTagName("head")[0];b||(b=document.createElement("head"),document.getElementsByTagName("html")[0].insertBefore(b,document.getElementsByTagName("body")[0]));var c=document.createElement("script");c.src=R(window,"/pagead/conversion_debug_overlay.js",a);b.appendChild(c)};var Qa=function(a,b,c){a.addEventListener?a.addEventListener(b,c,void 0):a.attachEvent&&a.attachEvent("on"+b,c)};var Y=function(a){return{visible:1,hidden:2,prerender:3,preview:4,unloaded:5}[a.webkitVisibilityState||a.mozVisibilityState||a.visibilityState||""]||0},Ra=function(a){var b;a.mozVisibilityState?b="mozvisibilitychange":a.webkitVisibilityState?b="webkitvisibilitychange":a.visibilityState&&(b="visibilitychange");return b},Z=function(a,b){if(3==Y(b))return!1;a();return!0},Sa=function(a,b){if(!Z(a,b)){var c=!1,d=Ra(b),e=function(){if(!c&&Z(a,b)){c=!0;var f=e;b.removeEventListener?b.removeEventListener(d,
f,void 0):b.detachEvent&&b.detachEvent("on"+d,f)}};d&&Qa(b,d,e)}};(function(a,b,c){if(a)if(null!=/[\?&;]google_debug/.exec(document.URL))Pa(a);else{try{if(Ma(a))if(3==Y(c)){var d=Oa(a),e="google_conversion_"+Math.floor(1E9*Math.random());c.write('<span id="'+e+'"></span>');Sa(function(){try{var f=c.getElementById(e);f&&(f.innerHTML=W(a,b,c,d),d.google_remarketing_for_search&&!d.google_conversion_domain&&X(a,c,d))}catch(g){}},c)}else c.write(W(a,b,c,a)),a.google_remarketing_for_search&&!a.google_conversion_domain&&X(a,c,a);S(a)&&c.documentElement.appendChild(La(a,
a))}catch(f){}Na(a)}})(window,navigator,document);}).call(this);
