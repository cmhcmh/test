typeof _qha_data !== 'object' && (window._qha_data = {domain:4092,host:'s.union.360.cn',gu:'115896901.2298762999368900096.1512714878001.4265',e360:'248744509',pageClk:null,urlClk:0,idClk:null,mvid:'75333'});!function(t){function n(t){return Xt.call(t)}function e(t){return null!==t&&void 0!==t}function r(t){return"[object Array]"===n(t)}function i(t){return"[object Object]"===n(t)}function o(t){return"[object Function]"===n(t)}function u(t){if(void 0===t&&(t=null),"object"==typeof JSON&&JSON&&JSON.stringify)return JSON.stringify(t);if(null==t)return"null";if("boolean"==typeof t)return Ft(t);if("string"==typeof t)return'"'+t+'"';if("number"==typeof t)return isFinite(t)?Ft(t):"null";if("object"==typeof t){if(r(t)){for(var n=[],e=0;e<t.length;e++)n.push(u(t[e]));return"["+n.join(",")+"]"}var i=[];for(var o in t)if(t.hasOwnProperty(o)){var a=t[o];void 0!==a&&"function"!=typeof a&&i.push('"'+o+'":'+u(a))}return"{"+i.join(",")+"}"}return""}function a(t,n,e){for(var r in t)t.hasOwnProperty(r)&&(e=n(e,t[r],r,t));return e}function c(t,n){a(t,function(e,r,i){return n(r,i,t)})}function s(t,n){return a(t,function(e,r,i){return e.push(n(r,i,t)),e},[])}function f(t,n,e){for(var r=0;r<t.length;r++)e=n(e,t[r],r,t);return e}function l(t,n,e){f(t,function(e,r,i){return n(r,i,t)})}function p(t,n,e){return f(t,function(e,r,i){return e.push(n(r,i,t)),e},[])}function d(t){for(var n=[],e=arguments.length-1;e-- >0;)n[e]=arguments[e+1];if(!1===i(t))throw new Error(t+" is not an object");return l(n,function(n){n&&i(n)&&h(n,t)}),t}function h(t,n){c(t,function(t,e){n[e]=t})}function v(t){if(!1===i(t))throw new Error("target is not plain object");return s(t,function(t,n){return"object"==typeof t&&(t=u(t)),t=null==t?"":t,vt(n)+"="+vt(t)}).join("&")}function m(t){var n=t[bt]("?");if(n<0)return{base:t,param:{}};var e={};return f(t[wt](n+1).split("&"),function(t,n){var r=n[bt]("=");if(r>-1){var i=n[wt](0,r),o=n[wt](r+1);e[i]=o}else e[n]="";return t},e),{base:t[wt](0,n),param:e}}function g(t,n){return/^https?:\/\/[^/?]+$/[kt](t)&&(t+="/"),t===n||t[bt]("*")>-1&&y(t)[kt](n)}function y(t){return new Dt(_(t).replace("\\*",".*"))}function _(t){return t.replace(/([.*+?^=!:$}{()|[\]/\\])/g,"\\$&")}function w(n){if(n||(n=t.event),!n)throw new Error("`event` is not an object");return n.target||(n.target=n.srcElement||Wt),n.target.nodeType===en&&(n.target=n.target.parentNode),n}function b(t,n,e,r){void 0===r&&(r=!1);var i=function(t){t=w(t),e.call(this,t)};t.addEventListener?t.addEventListener(n,i,r):t.attachEvent?t.attachEvent("on"+n,i):t["on"+n]=i,e.__dlg=i}function k(t,n,e,r){var i=e.__dlg;t.removeEventListener?t.removeEventListener(n,i,r):t.attachEvent?t.detachEvent("on"+n,i):t["on"+n]=null,i=null,e.__dlg=null,e=null,t=null}function x(t,n,e){var r=[],i=function(t){var n=this;l(r,function(e){return e.call(n,t)})},u=!1,a=new Error("Pool has been destoryed.");return b(t,n,i,e),{append:function(t){if(u)throw a;o(t)&&r.push(t)},remove:function(t){if(u)throw a;var n=Yt(r,t);n>-1&&r.splice(n,1)},destroy:function(){if(u)throw a;k(t,n,i,e),r=null,t=null,i=null,u=!0}}}function E(){var t=-1,n=Wt.body,e=Wt[_t]("div");return e.innderHTML="&nbsp;",e.className="adsbox adwords",n&&(n.appendChild(e),t=0===e.offsetWidth?1:0,n.removeChild(e)),t}function j(n){var e="";try{e=n||t.top.document.referrer}catch(t){}if(""===e)return e;var r=/^https?:\/\/e\.so\.com\/search\/(eclk|mclick)\?/.exec(e);if(r){var i=m(e),o=i.base,u=i.param,a="mclick"===r[1]?"asin":"p";e=o+"?"+a+"="+(u[a]||"")}else e=e[wt](0,1e3);return e}function N(){var t=Kt.pixelDepth,n=Kt.colorDepth,e=Kt.width,r=Kt.height,i=Gt.language,o=Gt.browserLanguage;return{adb:E(),cl:t||n||0,ds:e+"x"+r,ln:i||o||"unknown"}}function O(){var n=Wt.documentElement||Wt.body;return{scrollX:"pageXOffset"in t?t.pageXOffset:n.scrollLeft,scrollY:"pageYOffset"in t?t.pageYOffset:n.scrollTop}}function S(){var t=Wt.documentElement||Wt.body;return{width:Zt.max(t.scrollWidth,t.clientWidth),height:Zt.max(t.scrollHeight,t.clientHeight)}}function C(){return void 0===Wt[an]?"":Wt[an]}function q(){return"preview"===Gt.loadPurpose}function P(){for(var t=[Gt.appName,Gt.version,Gt.language||Gt.browserLanguage,Gt.platform,Gt.userAgent,Kt.width,"x",Kt.height,Kt.colorDepth,Wt.referrer].join(""),n=t.length,e=Qt.length;e;)t+=e--^n++;return(2147483647*(Zt.round(2147483647*Zt.random())^A(t)))[xt]()}function A(t){var n=0,e=0,r=t.length-1;for(r;r>=0;r--){var i=tn(t.charCodeAt(r),10);0!=(e=4261412864&(n=(n<<6&4294967295)+i+(i<<14)))&&(n^=e>>21)}return n}function L(t){fn&&(ln.setAttribute("href",t),t=ln.href),ln.setAttribute("href",t);var n=ln.href,e=ln.protocol,r=ln.host,i=ln.search,o=ln.hash,u=ln.hostname,a=ln.port,c=ln.pathname;return{href:n,protocol:e?e.replace(/:$/,""):"",host:r,search:i?i.replace(/^\?/,""):"",hash:o?o.replace(/^#/,""):"",hostname:u,port:a,pathname:"/"===c.charAt(0)?c:"/"+c}}function I(t,n,e){if(!t||!t.length)return!1;var r=tn(t[t.length-1],10);return!(Zt.abs(n-r)>vn)&&!V(j(),e)}function V(t,n){var e=L(t).hostname,r=e[bt](n);return!(r>=0&&e[wt](r)===n)}function T(t,n,e){void 0===e&&(e="image");var r=v(n);if(r.length<=2048&&"beacon"!==e)return F(t,r);f(e in On?On[e]:[0,1,2],function(n,e){return n||Nn[e](t,r)},!1)}function F(n,e){var r="qha_log_"+Zt.floor(2147483648*Zt.random())[xt](36),i=new t.Image;t[r]=i,i.onload=i.onerror=i.onabort=function(){i.onload=i.onerror=i.onabort=null,i=t[r]=null},e=En&&e.length>8153?e[wt](8153):e;var o=jn(e,"im");return i.src=D(n,o),!0}function J(n,e){var r=t.XDomainRequest;if(!r)return!1;try{var i=new r,o=jn(e,"xdr");return i.open("POST",n),setTimeout(function(){return i.send(o)}),!0}catch(t){return!1}}function D(t,n){return t+(t[bt]("?")>-1?"&":"?")+n}function X(t){o(t)&&(Cn+=1,t.i=Cn,qn.push(t))}function M(t,n,e){l(qn,function(r){o(r)&&r.i>0&&r(t,n,r.i?e:void 0)})}function B(t){return!1===e(t)?"":Ln(""+t)}function H(t){var n=B(""+t);if("object"==typeof JSON&&JSON&&JSON.parse)return JSON.parse(n);var e,r=null,i=n.replace(In,function(t,n,i,o){return e&&n&&(r=0),0===r?t:(e=i||n,r+=!o-!i,"")});if(n&&!B(i))return new Vt[It]("return "+n)();throw new Error("Invalid JSON: "+t)}function Y(t,n,e){if("send"===t&&e&&0===e.index){var r=n[0];if((r&&r.et)>=Lt){var i=null;try{i=H(sn.get("mediav"))}catch(t){}d(r,i)}}}function $(t,n,e){if("send"===t&&e&&0===e.index){var r=n[0],i=r&&r.et;i!==Ot&&i!==St||d(r,R())}}function R(){var n={};return t._e360_uid&&d(n,{e_uid:t._e360_uid||"",e_cid:t._e360_campaignid||"",e_gid:t._e360_groupid||"",e_yid:t._e360_creativeid||"",e_kid:t._e360_keywordid||"",e_clkid:t._e360_clickid||"",e_type:t._e360_type||"",e_query:t._e360_query||"",e_mtype:t._e360_matchtype||"",e_smtype:t._e360_submatchtype||""}),t._e360_commerce&&(n.e_com=t._e360_commerce),t._e360_sip&&(n.e_sip=t._e360_sip),n}function U(n,e){t.postMessage&&t.top!==t&&t.top.postMessage(u({type:n,args:e}),"*")}function W(t,n){1===t?Vn.push(n):Tn.push(n)}function z(t,n){l(1===t?Vn:Tn,function(t){o(t)&&t(n)})}function G(t){for(var n=0;n<t.length;n+=1)t[n](Fn)}function K(){var t=Jn;Dn&&t.length&&(Jn=[],G(t))}function Q(){Dn||(Dn=!0,bn&&clearInterval(bn),K())}function Z(t){Dn?t(Fn):Jn.push(t)}function tt(t){Z(function(){return et(t)})}function nt(n){t[Nt]("send",{et:qt,msg:n})}function et(n){var e=n.currentPV,r=n.mvid,i=null;if(r&&!(e.index>0)){if(Xn)return nt("wx");1===E()&&nt("adb");try{i=Wt[_t]('<iframe name="'+r+'"></iframe>')}catch(t){(i=Wt[_t]("iframe")).name=r}i.height=0,i.width=0,i.border=0,i.style.display="none",i.src=Mn+"/mv.html",i.onload=null,rt(i,r),Wt.body?Wt.body.appendChild(i):b(t,"load",function(){Wt.body.appendChild(i)})}}function rt(n,e){var r=e.split(","),i=function(t){return t[bt](Mn)>-1},o=function(t,n){return t&&("mid"===t||Yt(r,t)>-1)},a=function(n,e){if("mid"===n)return t[Nt]("send",{et:At,mid:e});var r=e.split(","),i=r[0];void 0===i&&(i="");var o=r[1];void 0===o&&(o="");var a=r[2];void 0===a&&(a="");var c={eid:n,ep:i,vid:o,ctn:a};sn.set("mediav",u(c)),t[Nt]("send",d({et:Ct},c))},c=function(t){var n=t.origin,e=(""+t.data).split("|"),r=e[0],u=e[1];i(n)&&o(r)&&a(r,u)};"postMessage"in t?b(t,"message",c):Gt._qha_message=function(t){return c({origin:Mn,data:t})}}function it(n){var e=n.currentPV.start,r={et:St,ep:Rt()-e};t[Nt]("send",r,"beacon")}function ot(t){var n=!1;return function(){if(!n)return n=!0,t.apply(this,arguments)}}function ut(t,n,e){void 0===n&&(n=Vt),void 0===e&&(e=Vt);var r=Wt.getElementsByTagName("script")[0],i=Wt[_t]("script");i.type="text/javascript",i.defer=!0,i.async=!0,i.src=t,i.onerror=e,i.onload=n,i.onreadystatechange=function(t){var e=i.readyState;"loaded"!==e&&"complete"!==e||n(t)},r.parentNode.insertBefore(i,r)}function at(t,n){return Yn=p(t,function(t){var e=new t(n);return Hn.append(e.listener),e})}function ct(){Yn&&l(Yn,function(t){return t.update()})}function st(t,n){if(!t)return[];var e=a(t,function(t,e,r){return g(r,n)&&t.push(e),t},[]).join(",").split(",");return Ht(e)}function ft(t){for(var n=t.id;!n&&(t=t.parentNode);)n=t.id;return t}function lt(t){for(var n=t.target,e={t:n.nodeName},r=0;r<3&&n&&"A"!==n.nodeName;)r++,n=n.parentNode;return e.u=n&&"A"===n.nodeName?n.href:"",e}function pt(t){var n=t.pageX;void 0===n&&(n=0);var e=t.pageY;return void 0===e&&(e=0),{x:n,y:e}}function dt(t,n){var e=s(t,function(t,n){return n+":"+vt(t)}),r=s(n,function(t,n){return n+":"+vt(t)});return e.concat(r).join(",")}function ht(t,n){if(!t||0===t.length)return!1;for(var e=0;e<t.length;e++)if(g(t[e],n))return!0;return!1}var vt=t.encodeURIComponent,mt=t.decodeURIComponent,gt="__proto__",yt="constructor",_t="createElement",wt="slice",bt="indexOf",kt="test",xt="toString",Et={}[yt],jt="function"==typeof Et.create?Et.create:function(t){function n(){}return n.prototype=t,new n},Nt="_qha",Ot=0,St=3,Ct=20,qt=21,Pt=11,At=6,Lt=30,It=yt,Vt=function(){},Tt=function(t){return t},Ft=""[It],Jt=[][It],Dt=/s/[It],Xt={}[It].prototype[xt],Mt=Jt.prototype[wt],Bt=function(t){return r(t)?t:t.length&&t.item?p(t,Tt):Mt.call(t)},Ht=function(t){return f(t,function(t,n){return Yt(t,n)<0&&t.push(n),t},[])},Yt=o([].indexOf)?function(t,n){return t[bt](n)}:function(t,n){if(n!=n)return-1;for(var e=0;e<t.length;e++)if(t[e]===n)return e;return-1},$t=function(){return+new Date},Rt=function(){return+new Date/1e3|0},Ut=function(t){return new Date($t()+864e5*t)},Wt=t.document,zt=t.location,Gt=t.navigator,Kt=t.screen,Qt=t.history,Zt=t.Math,tn=t.parseInt,nn="https:"===zt.protocol?"https:":"http:",en=3,rn="";if(void 0===Wt.hidden)for(var on=["webkit","moz","ms","o"],un=0;un<on.length;un++)if(void 0!==Wt[on[un]+"Hidden"]){rn=on[un];break}for(var an=""===rn?"visibilityState":rn+"VisibilityState",cn=x(Wt,rn+"visibilitychange",!0),sn={get:function(t){t=vt(t);var n=Dt("(^| )"+t+"=([^;]*)(;|$)").exec(Wt.cookie);return mt(n?n[2]:"")},set:function(t,n,e){void 0===e&&(e={});var r=vt(t)+"="+vt(n),i=e.path,o=e.domain,u=e.expires;r+=u?";expires="+Ut(u).toUTCString():"",r+=i?";path="+i:"",r+=o?";domain="+o:"";try{Wt.cookie=r}catch(t){}},del:function(t,n){this.set(t,"",d({expires:-1},n))}},fn=/(msie|trident)/i[kt](Gt.userAgent),ln=Wt[_t]("a"),pn=Wt.domain.split("."),dn="."+pn.pop();pn.length;)if(dn="."+pn.pop()+dn,sn.set("__qhart","1",{domain:dn}),"1"===sn.get("__qhart")){sn.del("__qhart",{domain:dn});break}var hn=dn[wt](1),vn=28800,mn=0,gn=function(t){var n=t.referrer,e=t.domainId,r=t.url,i=t.conf,o=t.init;void 0===o&&(o=Vt),this.index=mn++,this.conf=i,this.url=r,this.domainId=e,this.start=Rt(),this.referrer=n,this.session=new xn({key:"qs_lvt_"+e,ident:Rt(),domain:hn}),this.page=new kn({key:"qs_pv_"+e,ident:P(),domain:hn}),o.call(this)};gn.prototype.getBaseInfo=function(){var t=function(t){return t[wt](-2).reverse()},n=this,e=n.url,r=n.start,i=n.referrer,o=n.domainId,u=n.page,a=n.session,c=n.conf,s=c.gu,f=c.version,l=t(u.list),p=l[0],d=l[1],h=t(a.list),v=h[0],m=h[1],g={url:e,si:o,su:i,flt:r,lt:v,pt:p,guid:s,v:f};return m&&(g.lt2=m),d&&(g.pt2=d),g};var yn=function(t){var n=t.key,e=t.ident,r=t.domain,i=t.expires;void 0===i&&(i=365);var o={path:"/",domain:"."+r};this.cfg=d({expires:i},o);var u=this.migrate(n,o);this.ident=""+e,this.key=u.key,this.list=u.list};yn.prototype.migrate=function(t,n){var e=sn.get(t),r=t.replace(/^[a-z]/,function(t){return t.toUpperCase()});""!==e&&""===sn.get(r)&&sn.set(r,e,this.cfg),sn.del(t,n);var i=sn.get(r);return{key:r,list:""===i?[]:i.split(",")}},yn.prototype.init=function(){var t=this,n=t.list,e=t.key,r=t.ident,i=t.cfg;this.list=n[wt](-4).concat(r),sn.set(e,this.list.join(","),i)};var _n,wn,bn,kn=function(t){function n(n){t.call(this,n),this.init()}return t&&(n[gt]=t),n.prototype=jt(t&&t.prototype),n.prototype[yt]=n,n}(yn),xn=function(t){function n(n){t.call(this,n);var e=!I(this.list,this.ident,hn);this.isNew=e,e&&this.init()}return t&&(n[gt]=t),n.prototype=jt(t&&t.prototype),n.prototype[yt]=n,n}(yn),En=/chrome/i[kt](Gt.userAgent),jn=function(t,n){return t+(t.length>0?"&":"")+"_mtd="+n},Nn=[function(t,n){return Sn&&Gt.sendBeacon(t,n&&jn(n,"bc"))},function(n,e){var r=t.XMLHttpRequest;if(!r)return!1;var i=new r;if("withCredentials"in i==0)return J(n,e);try{var o=jn(e,"xhr");return i.open("POST",n,!0),i.withCredentials=!0,i.setRequestHeader("Content-Type","text/plain"),i.send(o),!0}catch(t){return!1}},F],On={image:[2,0,1],xhr:[1,0,2],beacon:[0,2,1]},Sn=o(Gt.sendBeacon),Cn=0,qn=[],Pn=Ft.prototype.trim,An=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,Ln=o(Pn)?function(t){return Pn.call(t)}:function(t){return t.replace(An,"")},In=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g,Vn=[],Tn=[],Fn=Wt,Jn=[],Dn=!1;if(Wt.addEventListener)Wt.addEventListener("DOMContentLoaded",Q,!1),t.addEventListener("load",Q,!1);else if(t.attachEvent){t.attachEvent("onload",Q),wn=Wt[_t]("div");try{_n=null===t.frameElement}catch(t){}wn.doScroll&&_n&&t.external&&(bn=setInterval(function(){try{wn.doScroll(),Q()}catch(t){}},30)),"complete"===Wt.readyState&&Q()}var Xn=/micromessenger/[kt](Gt.userAgent.toLowerCase()),Mn=nn+"//360fenxi.mediav.com",Bn=function(n){var e=n.currentPV,r=e.index,i=e.session.isNew,o=n.e360,u=o&&0===r&&i,a=d({et:Ot,ck:0|!i},N()),c=ot(function(){return t[Nt]("send",a)});u?(ut(nn+"//e.so.com/search/c.js?u="+o,c,c),setTimeout(c,500)):c()},Hn=x(Wt,"mousedown",!0),Yn=null,$n=function(t){this.cf=t};$n.prototype.update=function(t){throw new Error("`update()` method not implemented")},$n.prototype.listener=function(t){throw new Error("`listener()` method not implemented")},$n.prototype.send=function(n,e){t[Nt]("send",n,e)};var Rn=function(t){function n(n){var e=this;t.call(this,n),n.idClk?(this.map=n.idClk,this.matches=[],this.listener=function(t){var n=ft(t.target),r=n&&n.id;r&&Yt(e.matches,r)>-1&&e.send({et:Pt,ep:r})}):this.listener=Vt}return t&&(n[gt]=t),n.prototype=jt(t&&t.prototype),n.prototype[yt]=n,n.prototype.update=function(){this.matches=st(this.map,this.cf.currentPV.url)},n}($n),Un=function(t){function n(n){var e=this;t.call(this,n),this.clk=1==+n.urlClk,this.listener=function(t){return e.clk&&e.resp(t)},this.update=Vt}return t&&(n[gt]=t),n.prototype=jt(t&&t.prototype),n.prototype[yt]=n,n.prototype.resp=function(t){var n=lt(t),e=n.u;e&&!/^\s*javascript:/[kt](e)&&this.send({et:2,ep:dt(n,pt(t))},"beacon")},n}($n),Wn=function(t){function n(n){var e=this;t.call(this,n),this.list=n.pageClk,this.trk=!1,this.listener=function(t){e.trk&&e.clk(t)}}return t&&(n[gt]=t),n.prototype=jt(t&&t.prototype),n.prototype[yt]=n,n.prototype.update=function(){this.trk=ht(this.list,this.cf.currentPV.url)},n.prototype.clk=function(t){var n=t.clientX,e=t.clientY,r=O(),i=r.scrollX,o=r.scrollY,u=S(),a=u.width,c=u.height;this.send({et:10,x:n+i,y:e+o,w:a,h:c})},n}($n),zn={},Gn=d({version:"3.0.1",currentPV:null},i(!1)&&!1||t._qha_data),Kn=Gn.domain,Qn=nn+"//"+Gn.host+"/s.gif";t._qha_ldt_=(t._qha_ldt_||0)+1,F(Qn,v({et:100,si:Kn,ldt:t._qha_ldt_,vis:C(),prv:+q(),guid:Gn.gu,t:$t(),v:"3.0.1"}));var Zn=function(t){var n=null==Gn.currentPV;!1===n&&z(-1,Gn),Gn.currentPV=new gn({referrer:n?j():Gn.currentPV.url,domainId:Kn,url:t?L(t).href:zt.href,conf:Gn}),z(1,Gn)},te=function(){W(-1,it),W(1,tt),W(1,Bn),W(1,function(){return ct()}),at([Un,Rn,Wn],Gn),X(Y),X($),X(U)},ne={set:function(t,n){zn[t]=n},send:function(){for(var t=[],n=arguments.length;n--;)t[n]=arguments[n];if("pageview"===t[0])return Zn(zn.page);var e=t[0],r=t[1],i=d(e,Gn.currentPV.getBaseInfo(),{t:$t()}),u=[Qn,i,r||zn.transport],a=zn.pingGuard;o(a)&&!0!==a.apply(null,u)||T.apply(null,u)}},ee=function(t){var n=Bt(t),e=n[0],r=n[wt](1),i=ne[e];M(e,r,Gn.currentPV),o(i)&&i.apply(null,r)};q()||function(t){var n=function(){return"prerender"===C()};n()?cn.append(function(){!1===n()&&(t(),cn.destroy())}):t()}(function(){if(!t[Nt]||1!==t[Nt].__){if(!1===o(t[Nt])){var n=function(){for(var t=[],e=arguments.length;e--;)t[e]=arguments[e];(n.c=n.c||[]).push(t)};t[Nt]=n}te(),t[Nt]("init",Kn);var e=t[Nt];e&&r(e.c)&&e.c.length&&(t[Nt].s||e.c.unshift(["send","pageview"]),l(e.c,ee)),t[Nt]=function(){for(var t=[],n=arguments.length;n--;)t[n]=arguments[n];return ee(t)},t[Nt].__=1,b(t,"unload",function(){return z(-1,Gn)})}})}(window);

