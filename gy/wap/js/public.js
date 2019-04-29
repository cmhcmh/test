(function(){function e(o,n){var p;n=n||{};this.trackingClick=false;this.trackingClickStart=0;this.targetElement=null;this.touchStartX=0;this.touchStartY=0;this.lastTouchIdentifier=0;this.touchBoundary=n.touchBoundary||10;this.layer=o;this.tapDelay=n.tapDelay||200;this.tapTimeout=n.tapTimeout||700;if(e.notNeeded(o)){return}function q(l,i){return function(){return l.apply(i,arguments)}}var j=["onMouse","onClick","onTouchStart","onTouchMove","onTouchEnd","onTouchCancel"];var m=this;for(var k=0,h=j.length;k<h;k++){m[j[k]]=q(m[j[k]],m)}if(d){o.addEventListener("mouseover",this.onMouse,true);o.addEventListener("mousedown",this.onMouse,true);o.addEventListener("mouseup",this.onMouse,true)}o.addEventListener("click",this.onClick,true);o.addEventListener("touchstart",this.onTouchStart,false);o.addEventListener("touchmove",this.onTouchMove,false);o.addEventListener("touchend",this.onTouchEnd,false);o.addEventListener("touchcancel",this.onTouchCancel,false);if(!Event.prototype.stopImmediatePropagation){o.removeEventListener=function(l,s,i){var r=Node.prototype.removeEventListener;if(l==="click"){r.call(o,l,s.hijacked||s,i)}else{r.call(o,l,s,i)}};o.addEventListener=function(r,s,l){var i=Node.prototype.addEventListener;if(r==="click"){i.call(o,r,s.hijacked||(s.hijacked=function(t){if(!t.propagationStopped){s(t)}}),l)}else{i.call(o,r,s,l)}}}if(typeof o.onclick==="function"){p=o.onclick;o.addEventListener("click",function(i){p(i)},false);o.onclick=null}}var b=navigator.userAgent.indexOf("Windows Phone")>=0;var d=navigator.userAgent.indexOf("Android")>0&&!b;var f=/iP(ad|hone|od)/.test(navigator.userAgent)&&!b;var a=f&&(/OS 4_\d(_\d)?/).test(navigator.userAgent);var g=f&&(/OS [6-7]_\d/).test(navigator.userAgent);var c=navigator.userAgent.indexOf("BB10")>0;e.prototype.needsClick=function(h){switch(h.nodeName.toLowerCase()){case"button":case"select":case"textarea":if(h.disabled){return true}break;case"input":if((f&&h.type==="file")||h.disabled){return true}break;case"label":case"iframe":case"video":return true}return(/\bneedsclick\b/).test(h.className)};e.prototype.needsFocus=function(h){switch(h.nodeName.toLowerCase()){case"textarea":return true;case"select":return !d;case"input":switch(h.type){case"button":case"checkbox":case"file":case"image":case"radio":case"submit":return false}return !h.disabled&&!h.readOnly;default:return(/\bneedsfocus\b/).test(h.className)}};e.prototype.sendClick=function(h,i){var j,k;if(document.activeElement&&document.activeElement!==h){document.activeElement.blur()}k=i.changedTouches[0];j=document.createEvent("MouseEvents");j.initMouseEvent(this.determineEventType(h),true,true,window,1,k.screenX,k.screenY,k.clientX,k.clientY,false,false,false,false,0,null);j.forwardedTouchEvent=true;h.dispatchEvent(j)};e.prototype.determineEventType=function(h){if(d&&h.tagName.toLowerCase()==="select"){return"mousedown"}return"click"};e.prototype.focus=function(i){var h;if(f&&i.setSelectionRange&&i.type.indexOf("date")!==0&&i.type!=="time"&&i.type!=="month"){h=i.value.length;i.setSelectionRange(h,h)}else{i.focus()}};e.prototype.updateScrollParent=function(h){var j,i;j=h.fastClickScrollParent;if(!j||!j.contains(h)){i=h;do{if(i.scrollHeight>i.offsetHeight){j=i;h.fastClickScrollParent=i;break}i=i.parentElement}while(i)}if(j){j.fastClickLastScrollTop=j.scrollTop}};e.prototype.getTargetElementFromEventTarget=function(h){if(h.nodeType===Node.TEXT_NODE){return h.parentNode}return h};e.prototype.onTouchStart=function(j){var i,k,h;if(j.targetTouches.length>1){return true}i=this.getTargetElementFromEventTarget(j.target);k=j.targetTouches[0];if(f){h=window.getSelection();if(h.rangeCount&&!h.isCollapsed){return true}if(!a){if(k.identifier&&k.identifier===this.lastTouchIdentifier){j.preventDefault();return false}this.lastTouchIdentifier=k.identifier;this.updateScrollParent(i)}}this.trackingClick=true;this.trackingClickStart=j.timeStamp;this.targetElement=i;this.touchStartX=k.pageX;this.touchStartY=k.pageY;if((j.timeStamp-this.lastClickTime)<this.tapDelay){j.preventDefault()}return true};e.prototype.touchHasMoved=function(h){var j=h.changedTouches[0],i=this.touchBoundary;if(Math.abs(j.pageX-this.touchStartX)>i||Math.abs(j.pageY-this.touchStartY)>i){return true}return false};e.prototype.onTouchMove=function(h){if(!this.trackingClick){return true}if(this.targetElement!==this.getTargetElementFromEventTarget(h.target)||this.touchHasMoved(h)){this.trackingClick=false;this.targetElement=null}return true};e.prototype.findControl=function(h){if(h.control!==undefined){return h.control}if(h.htmlFor){return document.getElementById(h.htmlFor)}return h.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")};e.prototype.onTouchEnd=function(j){var m,l,i,k,n,h=this.targetElement;if(!this.trackingClick){return true}if((j.timeStamp-this.lastClickTime)<this.tapDelay){this.cancelNextClick=true;return true}if((j.timeStamp-this.trackingClickStart)>this.tapTimeout){return true}this.cancelNextClick=false;this.lastClickTime=j.timeStamp;l=this.trackingClickStart;this.trackingClick=false;this.trackingClickStart=0;if(g){n=j.changedTouches[0];h=document.elementFromPoint(n.pageX-window.pageXOffset,n.pageY-window.pageYOffset)||h;h.fastClickScrollParent=this.targetElement.fastClickScrollParent}i=h.tagName.toLowerCase();if(i==="label"){m=this.findControl(h);if(m){this.focus(h);if(d){return false}h=m}}else{if(this.needsFocus(h)){if((j.timeStamp-l)>100||(f&&window.top!==window&&i==="input")){this.targetElement=null;return false}this.focus(h);this.sendClick(h,j);if(!f||i!=="select"){this.targetElement=null;j.preventDefault()}return false}}if(f&&!a){k=h.fastClickScrollParent;if(k&&k.fastClickLastScrollTop!==k.scrollTop){return true}}if(!this.needsClick(h)){j.preventDefault();this.sendClick(h,j)}return false};e.prototype.onTouchCancel=function(){this.trackingClick=false;this.targetElement=null};e.prototype.onMouse=function(h){if(!this.targetElement){return true}if(h.forwardedTouchEvent){return true}if(!h.cancelable){return true}if(!this.needsClick(this.targetElement)||this.cancelNextClick){if(h.stopImmediatePropagation){h.stopImmediatePropagation()}else{h.propagationStopped=true}h.stopPropagation();h.preventDefault();return false}return true};e.prototype.onClick=function(h){var i;if(this.trackingClick){this.targetElement=null;this.trackingClick=false;return true}if(h.target.type==="submit"&&h.detail===0){return true}i=this.onMouse(h);if(!i){this.targetElement=null}return i};e.prototype.destroy=function(){var h=this.layer;if(d){h.removeEventListener("mouseover",this.onMouse,true);h.removeEventListener("mousedown",this.onMouse,true);h.removeEventListener("mouseup",this.onMouse,true)}h.removeEventListener("click",this.onClick,true);h.removeEventListener("touchstart",this.onTouchStart,false);h.removeEventListener("touchmove",this.onTouchMove,false);h.removeEventListener("touchend",this.onTouchEnd,false);h.removeEventListener("touchcancel",this.onTouchCancel,false)};e.notNeeded=function(j){var h;var l;var k;var i;if(typeof window.ontouchstart==="undefined"){return true}l=+(/Chrome\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1];if(l){if(d){h=document.querySelector("meta[name=viewport]");if(h){if(h.content.indexOf("user-scalable=no")!==-1){return true}if(l>31&&document.documentElement.scrollWidth<=window.outerWidth){return true}}}else{return true}}if(c){k=navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/);if(k[1]>=10&&k[2]>=3){h=document.querySelector("meta[name=viewport]");if(h){if(h.content.indexOf("user-scalable=no")!==-1){return true}if(document.documentElement.scrollWidth<=window.outerWidth){return true}}}}if(j.style.msTouchAction==="none"||j.style.touchAction==="manipulation"){return true}i=+(/Firefox\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1];if(i>=27){h=document.querySelector("meta[name=viewport]");if(h&&(h.content.indexOf("user-scalable=no")!==-1||document.documentElement.scrollWidth<=window.outerWidth)){return true}}if(j.style.touchAction==="none"||j.style.touchAction==="manipulation"){return true}return false};e.attach=function(i,h){return new e(i,h)};if(typeof define==="function"&&typeof define.amd==="object"&&define.amd){define(function(){return e})}else{if(typeof module!=="undefined"&&module.exports){module.exports=e.attach;module.exports.FastClick=e}else{window.FastClick=e}}}());

/* Copyright (c) 2010-2016 Marcus Westin */
(function(f){if(typeof exports==="object"&&typeof module!=="undefined"){module.exports=f()}else if(typeof define==="function"&&define.amd){define([],f)}else{var g;if(typeof window!=="undefined"){g=window}else if(typeof global!=="undefined"){g=global}else if(typeof self!=="undefined"){g=self}else{g=this}g.store = f()}})(function(){var define,module,exports;return (function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function (global){
"use strict";module.exports=function(){function e(){try{return o in n&&n[o]}catch(e){return!1}}var t,r={},n="undefined"!=typeof window?window:global,i=n.document,o="localStorage",a="script";if(r.disabled=!1,r.version="1.3.20",r.set=function(e,t){},r.get=function(e,t){},r.has=function(e){return void 0!==r.get(e)},r.remove=function(e){},r.clear=function(){},r.transact=function(e,t,n){null==n&&(n=t,t=null),null==t&&(t={});var i=r.get(e,t);n(i),r.set(e,i)},r.getAll=function(){},r.forEach=function(){},r.serialize=function(e){return JSON.stringify(e)},r.deserialize=function(e){if("string"==typeof e)try{return JSON.parse(e)}catch(t){return e||void 0}},e())t=n[o],r.set=function(e,n){return void 0===n?r.remove(e):(t.setItem(e,r.serialize(n)),n)},r.get=function(e,n){var i=r.deserialize(t.getItem(e));return void 0===i?n:i},r.remove=function(e){t.removeItem(e)},r.clear=function(){t.clear()},r.getAll=function(){var e={};return r.forEach(function(t,r){e[t]=r}),e},r.forEach=function(e){for(var n=0;n<t.length;n++){var i=t.key(n);e(i,r.get(i))}};else if(i&&i.documentElement.addBehavior){var c,u;try{u=new ActiveXObject("htmlfile"),u.open(),u.write("<"+a+">document.w=window</"+a+'><iframe src="/favicon.ico"></iframe>'),u.close(),c=u.w.frames[0].document,t=c.createElement("div")}catch(l){t=i.createElement("div"),c=i.body}var f=function(e){return function(){var n=Array.prototype.slice.call(arguments,0);n.unshift(t),c.appendChild(t),t.addBehavior("#default#userData"),t.load(o);var i=e.apply(r,n);return c.removeChild(t),i}},d=new RegExp("[!\"#$%&'()*+,/\\\\:;<=>?@[\\]^`{|}~]","g"),s=function(e){return e.replace(/^d/,"___$&").replace(d,"___")};r.set=f(function(e,t,n){return t=s(t),void 0===n?r.remove(t):(e.setAttribute(t,r.serialize(n)),e.save(o),n)}),r.get=f(function(e,t,n){t=s(t);var i=r.deserialize(e.getAttribute(t));return void 0===i?n:i}),r.remove=f(function(e,t){t=s(t),e.removeAttribute(t),e.save(o)}),r.clear=f(function(e){var t=e.XMLDocument.documentElement.attributes;e.load(o);for(var r=t.length-1;r>=0;r--)e.removeAttribute(t[r].name);e.save(o)}),r.getAll=function(e){var t={};return r.forEach(function(e,r){t[e]=r}),t},r.forEach=f(function(e,t){for(var n,i=e.XMLDocument.documentElement.attributes,o=0;n=i[o];++o)t(n.name,r.deserialize(e.getAttribute(n.name)))})}try{var v="__storejs__";r.set(v,v),r.get(v)!=v&&(r.disabled=!0),r.remove(v)}catch(l){r.disabled=!0}return r.enabled=!r.disabled,r}();
}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[1])(1)
});

 /*   @..@
	 (\--/)
	(.>__<.)
	^^^  ^^^    codewa/(version:1.0)(fn:)*/

/*!art-template - Template Engine | http://aui.github.com/artTemplate/*/
!function(){function a(a){return a.replace(t,"").replace(u,",").replace(v,"").replace(w,"").replace(x,"").split(y)}function b(a){return"'"+a.replace(/('|\\)/g,"\\$1").replace(/\r/g,"\\r").replace(/\n/g,"\\n")+"'"}function c(c,d){function e(a){return m+=a.split(/\n/).length-1,k&&(a=a.replace(/\s+/g," ").replace(/<!--[\w\W]*?-->/g,"")),a&&(a=s[1]+b(a)+s[2]+"\n"),a}function f(b){var c=m;if(j?b=j(b,d):g&&(b=b.replace(/\n/g,function(){return m++,"$line="+m+";"})),0===b.indexOf("=")){var e=l&&!/^=[=#]/.test(b);if(b=b.replace(/^=[=#]?|[\s;]*$/g,""),e){var f=b.replace(/\s*\([^\)]+\)/,"");n[f]||/^(include|print)$/.test(f)||(b="$escape("+b+")")}else b="$string("+b+")";b=s[1]+b+s[2]}return g&&(b="$line="+c+";"+b),r(a(b),function(a){if(a&&!p[a]){var b;b="print"===a?u:"include"===a?v:n[a]?"$utils."+a:o[a]?"$helpers."+a:"$data."+a,w+=a+"="+b+",",p[a]=!0}}),b+"\n"}var g=d.debug,h=d.openTag,i=d.closeTag,j=d.parser,k=d.compress,l=d.escape,m=1,p={$data:1,$filename:1,$utils:1,$helpers:1,$out:1,$line:1},q="".trim,s=q?["$out='';","$out+=",";","$out"]:["$out=[];","$out.push(",");","$out.join('')"],t=q?"$out+=text;return $out;":"$out.push(text);",u="function(){var text=''.concat.apply('',arguments);"+t+"}",v="function(filename,data){data=data||$data;var text=$utils.$include(filename,data,$filename);"+t+"}",w="'use strict';var $utils=this,$helpers=$utils.$helpers,"+(g?"$line=0,":""),x=s[0],y="return new String("+s[3]+");";r(c.split(h),function(a){a=a.split(i);var b=a[0],c=a[1];1===a.length?x+=e(b):(x+=f(b),c&&(x+=e(c)))});var z=w+x+y;g&&(z="try{"+z+"}catch(e){throw {filename:$filename,name:'Render Error',message:e.message,line:$line,source:"+b(c)+".split(/\\n/)[$line-1].replace(/^\\s+/,'')};}");try{var A=new Function("$data","$filename",z);return A.prototype=n,A}catch(B){throw B.temp="function anonymous($data,$filename) {"+z+"}",B}}var d=function(a,b){return"string"==typeof b?q(b,{filename:a}):g(a,b)};d.version="3.0.0",d.config=function(a,b){e[a]=b};var e=d.defaults={openTag:"<%",closeTag:"%>",escape:!0,cache:!0,compress:!1,parser:null},f=d.cache={};d.render=function(a,b){return q(a,b)};var g=d.renderFile=function(a,b){var c=d.get(a)||p({filename:a,name:"Render Error",message:"Template not found"});return b?c(b):c};d.get=function(a){var b;if(f[a])b=f[a];else if("object"==typeof document){var c=document.getElementById(a);if(c){var d=(c.value||c.innerHTML).replace(/^\s*|\s*$/g,"");b=q(d,{filename:a})}}return b};var h=function(a,b){return"string"!=typeof a&&(b=typeof a,"number"===b?a+="":a="function"===b?h(a.call(a)):""),a},i={"<":"&#60;",">":"&#62;",'"':"&#34;","'":"&#39;","&":"&#38;"},j=function(a){return i[a]},k=function(a){return h(a).replace(/&(?![\w#]+;)|[<>"']/g,j)},l=Array.isArray||function(a){return"[object Array]"==={}.toString.call(a)},m=function(a,b){var c,d;if(l(a))for(c=0,d=a.length;d>c;c++)b.call(a,a[c],c,a);else for(c in a)b.call(a,a[c],c)},n=d.utils={$helpers:{},$include:g,$string:h,$escape:k,$each:m};d.helper=function(a,b){o[a]=b};var o=d.helpers=n.$helpers;d.onerror=function(a){var b="Template Error\n\n";for(var c in a)b+="<"+c+">\n"+a[c]+"\n\n";"object"==typeof console&&console.error(b)};var p=function(a){return d.onerror(a),function(){return"{Template Error}"}},q=d.compile=function(a,b){function d(c){try{return new i(c,h)+""}catch(d){return b.debug?p(d)():(b.debug=!0,q(a,b)(c))}}b=b||{};for(var g in e)void 0===b[g]&&(b[g]=e[g]);var h=b.filename;try{var i=c(a,b)}catch(j){return j.filename=h||"anonymous",j.name="Syntax Error",p(j)}return d.prototype=i.prototype,d.toString=function(){return i.toString()},h&&b.cache&&(f[h]=d),d},r=n.$each,s="break,case,catch,continue,debugger,default,delete,do,else,false,finally,for,function,if,in,instanceof,new,null,return,switch,this,throw,true,try,typeof,var,void,while,with,abstract,boolean,byte,char,class,const,double,enum,export,extends,final,float,goto,implements,import,int,interface,long,native,package,private,protected,public,short,static,super,synchronized,throws,transient,volatile,arguments,let,yield,undefined",t=/\/\*[\w\W]*?\*\/|\/\/[^\n]*\n|\/\/[^\n]*$|"(?:[^"\\]|\\[\w\W])*"|'(?:[^'\\]|\\[\w\W])*'|\s*\.\s*[$\w\.]+/g,u=/[^\w$]+/g,v=new RegExp(["\\b"+s.replace(/,/g,"\\b|\\b")+"\\b"].join("|"),"g"),w=/^\d[^,]*|,\d[^,]*/g,x=/^,+|,+$/g,y=/^$|,+/;e.openTag="{{",e.closeTag="}}";var z=function(a,b){var c=b.split(":"),d=c.shift(),e=c.join(":")||"";return e&&(e=", "+e),"$helpers."+d+"("+a+e+")"};e.parser=function(a){a=a.replace(/^\s/,"");var b=a.split(" "),c=b.shift(),e=b.join(" ");switch(c){case"if":a="if("+e+"){";break;case"else":b="if"===b.shift()?" if("+b.join(" ")+")":"",a="}else"+b+"{";break;case"/if":a="}";break;case"each":var f=b[0]||"$data",g=b[1]||"as",h=b[2]||"$value",i=b[3]||"$index",j=h+","+i;"as"!==g&&(f="[]"),a="$each("+f+",function("+j+"){";break;case"/each":a="});";break;case"echo":a="print("+e+");";break;case"print":case"include":a=c+"("+b.join(",")+");";break;default:if(/^\s*\|\s*[\w\$]/.test(e)){var k=!0;0===a.indexOf("#")&&(a=a.substr(1),k=!1);for(var l=0,m=a.split("|"),n=m.length,o=m[l++];n>l;l++)o=z(o,m[l]);a=(k?"=":"=#")+o}else a=d.helpers[c]?"=#"+c+"("+b.join(",")+");":"="+a}return a},"function"==typeof define?define(function(){return d}):"undefined"!=typeof exports?module.exports=d:this.template=d}();

var notie=function(){function e(e){for(var t in e)h[t]=e[t]}function t(e,t,i){h.colorText.length>0&&(C.style.color=h.colorText),f(),H++,setTimeout(function(){H--},h.animationDelay+10),1===H&&(D?(clearTimeout(x),clearTimeout(E),n(function(){o(e,t,i)})):o(e,t,i))}function o(e,t,o){D=!0;var i=0;if("undefined"==typeof o||0===o)var i=864e5;else i=o>0&&1>o?1e3:1e3*o;switch(y(k,"notie-background-success"),y(k,"notie-background-warning"),y(k,"notie-background-error"),y(k,"notie-background-info"),e){case 1:h.colorSuccess.length>0?k.style.backgroundColor=h.colorSuccess:p(k,"notie-background-success");break;case 2:h.colorWarning.length>0?k.style.backgroundColor=h.colorWarning:p(k,"notie-background-warning");break;case 3:h.colorError.length>0?k.style.backgroundColor=h.colorError:p(k,"notie-background-error");break;case 4:h.colorInfo.length>0?k.style.backgroundColor=h.colorInfo:p(k,"notie-background-info")}C.innerHTML=t,k.style.top="-10000px",k.style.display="table",k.style.top="-"+k.offsetHeight-5+"px",x=setTimeout(function(){p(k,"notie-transition"),k.style.top=0,E=setTimeout(function(){n(function(){})},i)},20)}function n(e){k.style.top="-"+k.offsetHeight-5+"px",setTimeout(function(){y(k,"notie-transition"),k.style.top="-10000px",D=!1,e&&e()},h.animationDelay+10)}function i(e,t,o,i,l){h.colorInfo.length>0&&(L.style.backgroundColor=h.colorInfo),h.colorSuccess.length>0&&(M.style.backgroundColor=h.colorSuccess),h.colorError.length>0&&(S.style.backgroundColor=h.colorError),h.colorText.length>0&&(I.style.color=h.colorText,A.style.color=h.colorText,N.style.color=h.colorText),f(),D?(clearTimeout(x),clearTimeout(E),n(function(){c(e,t,o,i,l)})):c(e,t,o,i,l)}function c(e,t,o,n,i){function c(){I.innerHTML=e,A.innerHTML=t,N.innerHTML=o,w.style.top="-10000px",w.style.display="table",w.style.top="-"+w.offsetHeight-5+"px",W.style.display="block",setTimeout(function(){p(w,"notie-transition"),w.style.top=0,W.style.opacity="0.75",setTimeout(function(){V=!0},h.animationDelay+10)},20)}g(),M.onclick=function(){l(),n&&setTimeout(function(){n()},h.animationDelay+10)},S.onclick=function(){l(),i&&setTimeout(function(){i()},h.animationDelay+10)},V?(l(),setTimeout(function(){c()},h.animationDelay+10)):c()}function l(){w.style.top="-"+w.offsetHeight-5+"px",W.style.opacity="0",setTimeout(function(){y(w,"notie-transition"),w.style.top="-10000px",W.style.display="none",b(),V=!1},h.animationDelay+10)}function r(e,t,o,i,c,l){h.colorInfo.length>0&&(z.style.backgroundColor=h.colorInfo),h.colorSuccess.length>0&&(R.style.backgroundColor=h.colorSuccess),h.colorError.length>0&&($.style.backgroundColor=h.colorError),h.colorText.length>0&&(q.style.color=h.colorText,F.style.color=h.colorText,G.style.color=h.colorText),f(),"undefined"!=typeof e.type&&e.type?O.setAttribute("type",e.type):O.setAttribute("type","text"),"undefined"!=typeof e.placeholder&&e.placeholder&&O.setAttribute("placeholder",e.placeholder),"undefined"!=typeof e.prefilledValue&&e.prefilledValue?O.value=e.prefilledValue:O.value="",D?(clearTimeout(x),clearTimeout(E),n(function(){a(t,o,i,c,l)})):a(t,o,i,c,l)}function a(e,t,o,n,i){function c(){q.innerHTML=e,F.innerHTML=t,G.innerHTML=o,j.style.top="-10000px",j.style.display="table",j.style.top="-"+j.offsetHeight-5+"px",B.style.display="block",setTimeout(function(){p(j,"notie-transition"),j.style.top=0,B.style.opacity="0.75",setTimeout(function(){J=!0,O.focus()},h.animationDelay+10)},20)}g(),R.onclick=function(){d(),n&&setTimeout(function(){n(O.value)},h.animationDelay+10)},$.onclick=function(){d(),i&&setTimeout(function(){i(O.value)},h.animationDelay+10)},J?(d(),setTimeout(function(){c()},h.animationDelay+10)):c()}function d(){j.style.top="-"+j.offsetHeight-5+"px",B.style.opacity="0",setTimeout(function(){y(j,"notie-transition"),B.style.display="none",j.style.top="-10000px",b(),J=!1},h.animationDelay+10)}function u(e,t){h.colorInfo.length>0&&(P.style.backgroundColor=h.colorInfo),h.colorNeutral.length>0&&(Y.style.backgroundColor=h.colorNeutral),h.colorText.length>0&&(Q.style.color=h.colorText,Y.style.color=h.colorText);for(var o=[],i=0;i<arguments.length-2;i++)o[i]=arguments[i+2];if(o.length!==t.length)throw"notie.select number of choices must match number of functions";f(),D?(clearTimeout(x),clearTimeout(E),n(function(){s(e,t,o)})):s(e,t,o)}function s(e,t,o){function n(e){Q.innerHTML=e,K.style.bottom="-10000px",K.style.display="table",K.style.bottom="-"+K.offsetHeight-5+"px",U.style.display="block",setTimeout(function(){p(K,"notie-transition"),K.style.bottom=0,U.style.opacity="0.75",setTimeout(function(){ee=!0},h.animationDelay+10)},20)}g(),document.getElementById("notie-select-choices").innerHTML="";for(var i,c=0;c<t.length;c++){var l=document.createElement("div");if(l.innerHTML=t[c].title,p(l,"notie-select-choice"),X.appendChild(l),l.style.backgroundColor=window.getComputedStyle(l).backgroundColor,h.colorText.length>0&&(l.style.color=h.colorText),t[c].type)switch(t[c].type){case 1:h.colorSuccess.length>0?l.style.backgroundColor=h.colorSuccess:p(l,"notie-background-success");break;case 2:h.colorWarning.length>0?l.style.backgroundColor=h.colorWarning:p(l,"notie-background-warning");break;case 3:h.colorError.length>0?l.style.backgroundColor=h.colorError:p(l,"notie-background-error");break;case 4:h.colorInfo.length>0?l.style.backgroundColor=h.colorInfo:p(l,"notie-background-info")}else t[c].color&&(l.style.backgroundColor=t[c].color);c>0&&l.style.backgroundColor===i.style.backgroundColor&&(i.style.borderBottom="1px solid rgba(255, 255, 255, 0.2)"),l.onclick=function(e){return function(){m(),setTimeout(function(){o[e]()},h.animationDelay+10)}}(c),i=l}ee?(m(),setTimeout(function(){n(e)},h.animationDelay+10)):n(e)}function m(){K.style.bottom="-"+K.offsetHeight-5+"px",U.style.opacity="0",setTimeout(function(){y(K,"notie-transition"),K.style.bottom="-10000px",U.style.display="none",b(),ee=!1},h.animationDelay+10)}function p(e,t){e.classList?e.classList.add(t):e.className+=" "+t}function y(e,t){e.classList?e.classList.remove(t):e.className=e.className.replace(new RegExp("(^|\\b)"+t.split(" ").join("|")+"(\\b|$)","gi")," ")}function f(){document.activeElement.blur()}function g(){Z=document.body.style.height,_=document.body.style.overflow,document.body.style.height="100%",document.body.style.overflow="hidden"}function b(){document.body.style.height=Z,document.body.style.overflow=_}var h={colorSuccess:"",colorWarning:"",colorError:"",colorInfo:"",colorNeutral:"",colorText:"",animationDelay:300,backgroundClickDismiss:!0},k=document.createElement("div");k.id="notie-alert-outer",k.onclick=function(){clearTimeout(x),clearTimeout(E),n()},document.body.appendChild(k);var v=document.createElement("div");v.id="notie-alert-inner",k.appendChild(v);var T=document.createElement("div");T.id="notie-alert-content",v.appendChild(T);var C=document.createElement("span");C.id="notie-alert-text",T.appendChild(C);var x,E,D=!1,H=0,w=document.createElement("div");w.id="notie-confirm-outer";var L=document.createElement("div");L.id="notie-confirm-inner",w.appendChild(L);var I=document.createElement("span");I.id="notie-confirm-text",L.appendChild(I);var M=document.createElement("div");M.id="notie-confirm-yes",w.appendChild(M);var S=document.createElement("div");S.id="notie-confirm-no",w.appendChild(S);var A=document.createElement("span");A.id="notie-confirm-text-yes",M.appendChild(A);var N=document.createElement("span");N.id="notie-confirm-text-no",S.appendChild(N);var W=document.createElement("div");W.id="notie-confirm-background",p(W,"notie-transition"),W.onclick=function(){h.backgroundClickDismiss&&l()},document.body.appendChild(w),document.body.appendChild(W);var V=!1,j=document.createElement("div");j.id="notie-input-outer";var B=document.createElement("div");B.id="notie-input-background",p(B,"notie-transition");var z=document.createElement("div");z.id="notie-input-inner",j.appendChild(z);var O=document.createElement("input");O.id="notie-input-field",O.setAttribute("autocomplete","off"),O.setAttribute("autocorrect","off"),O.setAttribute("autocapitalize","off"),O.setAttribute("spellcheck","false"),j.appendChild(O);var R=document.createElement("div");R.id="notie-input-yes",j.appendChild(R);var $=document.createElement("div");$.id="notie-input-no",j.appendChild($);var q=document.createElement("span");q.id="notie-input-text",z.appendChild(q);var F=document.createElement("span");F.id="notie-input-text-yes",R.appendChild(F);var G=document.createElement("span");G.id="notie-input-text-no",$.appendChild(G),document.body.appendChild(j),document.body.appendChild(B),B.onclick=function(){h.backgroundClickDismiss&&d()};var J=!1,K=document.createElement("div");K.id="notie-select-outer";var P=document.createElement("div");P.id="notie-select-inner",K.appendChild(P);var Q=document.createElement("span");Q.id="notie-select-text",P.appendChild(Q);var U=document.createElement("div");U.id="notie-select-background",p(U,"notie-transition");var X=document.createElement("div");X.id="notie-select-choices",K.appendChild(X);var Y=document.createElement("div");Y.id="notie-select-cancel",Y.innerHTML="Cancel",K.appendChild(Y),document.body.appendChild(K),document.body.appendChild(U),U.onclick=function(){h.backgroundClickDismiss&&m()},Y.onclick=function(){m()};var Z,_,ee=!1;return window.addEventListener("keydown",function(e){var t=13==e.which||13==e.keyCode,o=27==e.which||27==e.keyCode;D?(t||o)&&(clearTimeout(x),clearTimeout(E),n()):V?t?M.click():o&&l():J?t?R.click():o&&d():ee&&o&&m()}),{setOptions:e,alert:t,confirm:i,input:r,select:u}}();"object"==typeof module&&module.exports&&(module.exports=notie);

!function(c,b,d,f){var a=c(b);c.fn.lazyload=function(h){function i(){var k=0;e.each(function(){var l=c(this);if(!j.skip_invisible||l.is(":visible")){if(c.abovethetop(this,j)||c.leftofbegin(this,j)){}else{if(c.belowthefold(this,j)||c.rightoffold(this,j)){}else{l.trigger("appear"),k=0}}}})}var g,e=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:1,appear:null,load:null};return h&&(f!==h.failurelimit&&(h.failure_limit=h.failurelimit,delete h.failurelimit),f!==h.effectspeed&&(h.effect_speed=h.effectspeed,delete h.effectspeed),c.extend(j,h)),g=j.container===f||j.container===b?a:c(j.container),0===j.event.indexOf("scroll")&&g.bind(j.event,function(){return i()}),this.each(function(){var k=this,l=c(k);k.loaded=!1,l.one("appear",function(){if(!this.loaded){if(j.appear){var m=e.length;j.appear.call(k,m,j)}c("<img />").bind("load",function(){l.hide().attr("src",l.data(j.data_attribute))[j.effect](j.effect_speed),k.loaded=!0;var p=c.grep(e,function(n){return !n.loaded});if(e=c(p),j.load){var o=e.length;j.load.call(k,this.width,this.height)}}).attr("src",l.data(j.data_attribute))}}),0!==j.event.indexOf("scroll")&&l.bind(j.event,function(){k.loaded||l.trigger("appear")})}),a.bind("resize",function(){i()}),/iphone|ipod|ipad.*os 5/gi.test(navigator.appVersion)&&a.bind("pageshow",function(k){k.originalEvent&&k.originalEvent.persisted&&e.each(function(){c(this).trigger("appear")})}),c(d).ready(function(){i()}),this},c.belowthefold=function(h,e){var g;return g=e.container===f||e.container===b?a.height()+a.scrollTop():c(e.container).offset().top+c(e.container).height(),g<=c(h).offset().top-e.threshold},c.rightoffold=function(h,e){var g;return g=e.container===f||e.container===b?a.width()+a.scrollLeft():c(e.container).offset().left+c(e.container).width(),g<=c(h).offset().left-e.threshold},c.abovethetop=function(h,e){var g;return g=e.container===f||e.container===b?a.scrollTop():c(e.container).offset().top,g>=c(h).offset().top+e.threshold+c(h).height()},c.leftofbegin=function(h,e){var g;return g=e.container===f||e.container===b?a.scrollLeft():c(e.container).offset().left,g>=c(h).offset().left+e.threshold+c(h).width()},c.inviewport=function(e,g){return !(c.rightoffold(e,g)||c.leftofbegin(e,g)||c.belowthefold(e,g)||c.abovethetop(e,g))},c.extend(c.expr[":"],{"below-the-fold":function(e){return c.belowthefold(e,{threshold:0})},"above-the-top":function(e){return !c.belowthefold(e,{threshold:0})},"right-of-screen":function(e){return c.rightoffold(e,{threshold:0})},"left-of-screen":function(e){return !c.rightoffold(e,{threshold:0})},"in-viewport":function(e){return c.inviewport(e,{threshold:0})},"above-the-fold":function(e){return !c.belowthefold(e,{threshold:0})},"right-of-fold":function(e){return c.rightoffold(e,{threshold:0})},"left-of-fold":function(e){return !c.rightoffold(e,{threshold:0})}})}(jQuery,window,document);

/*
 @ Name：jQuery表单验证插件
 @ Author：前端老徐
 @ Date：2015/11/20
 @ GitHub:https://github.com/waihaolaoxu
 @ Address:http://www.loveqiao.cn/dom/plugin/validate.html
 */
!function(a){a.fn.validate=function(b){function f(){var d,b=a(this).attr("validate").split("|"),c=b.length;for(d=0;c>d;d++)if(e.hasOwnProperty(b[d])&&0==e[b[d]](a(this)))return!1}function g(){var b=!0;return a(this).find("[validate]").each(function(a,d){return 0==f.call(d)&&(b=!1,c)?!1:void 0}),b&&d.flag&&d.id.val(d.txt),b}var c=b.isone?!0:!1,d={flag:!1,id:a(this).find("input[type='submit']"),txt:"提交中..."},e={required:function(a){return""==a.val()||0==a.val()?(_error(a,"required"),!1):void 0},email:function(a){var b=/^\w+@([0-9a-zA-Z]+[.])+[a-z]{2,4}$/,c=a.val();return c&&!b.test(c)?(_error(a,"email"),!1):void 0},tel:function(a){var b=/^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,8}$/,c=a.val();return c&&!b.test(c)?(_error(a,"tel"),!1):void 0},phone:function(a){var b=/^1[3|5|8|7]\d{9}$/,c=a.val();return c&&!b.test(c)?(_error(a,"phone"),!1):void 0},number:function(a){var b=a.val();return b&&isNaN(a.val())?(_error(a,"number"),!1):void 0},idcard:function(a){var b=/(^\d{15}$)|(^\d{17}([0-9]|X|x)$)/,c=a.val();return c&&!b.test(c)?(_error(a,"idcard"),!1):void 0}};return messages={required:"不能为空！",email:"格式不正确！",tel:"格式不正确！",phone:"格式不正确！",number:"请输入数字！",idcard:"格式不正确"},b&&(b.messages&&(messages=a.extend(messages,b.messages)),b.validate&&(e=a.extend(e,b.validate)),b.submitBtn&&(d=a.extend(d,b.submitBtn))),_error=function(a,c){return b.error?(b.error(a,messages[c]),void 0):(alert(messages[c]),void 0)},g.call(this)}}(jQuery);

/**
 * Created by weiweiyuan on 16/7/19.
 */

$().ready(function(){
    var arr = getusercookieValue();
    var url=window.location.href;
    var uid= arr[0];
    if(uid > 0){
//      $("#js-head").html('<a href = "/home" class="text-red" target="_blank">欢迎您，'+arr[1]+'</a> | <a href="http://www.dyrs.com.cn/user/loginout.php?backurl='+url+'"  target = "_self"> 退出 </a>');
        $('.has_login').addClass('visibility').html('<div class="lazy go_ing"><img id="js-userlogo" data-original="'+''+'" src="http://icon.dyrs.cc/m/blank.gif" class="lazy_img auto"></div><span class="flex1"><em class="ellipsis"><i class="go_ing">'+arr[1]+'</i><a class="button" href="/user/user_loginout.php?backurl='+url+'" target = "_self">[退出]</a></em></span><a href="/home" class="color_red">个人中心</a>');
        $('#userlogo').lazyload(my.lazy);
        $(window).scroll();
        $('.no_login').hide();
    }else{
    	$('.no_login').addClass('visibility');
//      $("#js-head").html('<a href="/user/register" class="text-red">注册送1000家装抵用券！</a> <a href="http://www.dyrs.com.cn/user/login_sns.php?source=weibo&backurl='+url+'" class="sion" target="_blank">微博登录</a> <a href="http://www.dyrs.com.cn/user/login_sns.php?source=qq&backurl='+url+'" class="qq" target="_blank">QQ登录</a> <a href="http://www.dyrs.com.cn/user/login_sns.php?source=weixin&backurl='+url+'" class="weixin" target="_blank">微信登录</a> <a href="http://www.dyrs.com.cn/user/register?backurl='+url+'">注册</a> <span class="line">|</span> <a href="http://www.dyrs.com.cn/user/login?backurl='+url+'">登录</a>');
    }
    getLogo();
});

function getusercookieValue(){
    var cookieValue = readck('dyrs_userinfo');
    var cookie_s = base64decode_user(cookieValue);
    var arr = cookie_s.split("\t");
    return arr;
}
function base64decode_user(data) {
    var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
    var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, dec = "", tmp_arr = [];
    if (!data) {
        return data;
    }
    data += '';
    while (i < data.length){
        h1 = b64.indexOf(data.charAt(i++));
        h2 = b64.indexOf(data.charAt(i++));
        h3 = b64.indexOf(data.charAt(i++));
        h4 = b64.indexOf(data.charAt(i++));
        bits = h1<<18 | h2<<12 | h3<<6 | h4;
        o1 = bits>>16 & 0xff;
        o2 = bits>>8 & 0xff;
        o3 = bits & 0xff;
        if (h3 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1);
        } else if (h4 == 64) {
            tmp_arr[ac++] = String.fromCharCode(o1, o2);
        } else {
            tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
        }
    }

    dec = tmp_arr.join('');
    dec = utf8_decode(dec);
    return dec;
}
function utf8_decode(str_data){
    var tmp_arr = [], i = 0, ac = 0, c1 = 0, c2 = 0, c3 = 0;
    str_data += '';
    while ( i < str_data.length ) {
        c1 = str_data.charCodeAt(i);
        if (c1 < 128) {
            tmp_arr[ac++] = String.fromCharCode(c1);
            i++;
        } else if ((c1 > 191) && (c1 < 224)) {
            c2 = str_data.charCodeAt(i+1);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
            i += 2;
        } else {
            c2 = str_data.charCodeAt(i+1);
            c3 = str_data.charCodeAt(i+2);
            tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }
    }
    return tmp_arr.join('');
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
function getLogo(){

    $.get('/api/user/user.php', {action: 'logo'}, function (data) {
        $('#js-userlogo').attr('data-original',data.data);
    }, 'json')

}


// @koala-prepend "../../common/fastclick.min.js"
// @koala-prepend "../../common/store.min.js"
// @koala-prepend "../../common/template.js"
// @koala-prepend "../../common/notie.min.js"
// @koala-prepend "../../common/jquery.lazyload.min.js"
// @koala-prepend "../../common/jquery.validate.min.js"
// @koala-prepend "../../../js/title.js"
window.addEventListener('load', function() {
	FastClick.attach(document.body);
}, false);
var my = {
	api: '',
	count: 0,
	uid: '',
	title_h: 40,
	scroll: 0,
	system: 'ios',
	post: function(api, obj_json, fn) {
		//		my.show_loading();
		$.post(my.api + api, obj_json, function(data) {
			my.hide_loading();
			if(data.status == 1) {
				if(fn) {
					fn(data);
				}
			} else {
				my.tips({
					type: 'wrong',
					content: data.msg
				});
			}
		}, 'json');
	},
	getcode: function(obj) { //获取验证码
		var t = obj.innerHTML,
			n = 60;
		(function() {
			if(n > 0) {
				obj.disabled = true
				obj.innerHTML = '倒计时' + (n--) + '秒';
				setTimeout(arguments.callee, 1000);
			} else {
				obj.disabled = false;
				obj.innerHTML = t;
			}
		})();
	},
	get: function(api, obj_json, fn) {
		//		my.show_loading();
		$.get(my.api + api, obj_json, function(data) {
			my.hide_loading();
			if(data.status == 1) {
				if(fn) {
					fn(data);
				}
			} else {
				my.tips({
					type: 'wrong',
					content: data.msg
				});
			}
		}, 'json');
	},
	url_attr: function(name) {
		var pattern = new RegExp("[?&]" + name + "\=([^&]+)", "g");
		var matcher = pattern.exec(location.href);
		var items = null;
		if(null != matcher) {
			try {
				items = decodeURIComponent(decodeURIComponent(matcher[1]));
			} catch(e) {
				try {
					items = decodeURIComponent(matcher[1]);
				} catch(e) {
					items = matcher[1];
				}
			}
		}
		return items;
	},
	url0_attr: function(name) {
		var pattern = new RegExp("[#&]" + name + "\=([^&]+)", "g");
		var matcher = pattern.exec(location.href);
		var items = null;
		if(null != matcher) {
			try {
				items = decodeURIComponent(decodeURIComponent(matcher[1]));
			} catch(e) {
				try {
					items = decodeURIComponent(matcher[1]);
				} catch(e) {
					items = matcher[1];
				}
			}
		}
		return items;
	},
	tips: function(obj) {
		var $warn = $('#warn')
		$warn.find('em').html(obj.content);
		$warn.find('i')[0].className = "icon icon-" + obj.type;
		$warn.show();
		var time = obj.time ? obj.time : 2000;
		var tt = setTimeout(function() {
			$('#warn').hide();
			if(obj.fn) {
				obj.fn();
			}
			clearTimeout(tt);
		}, time);
	},
	share: function($jsons) {
		var share_obj = new nativeShare({
            url:'',
            title:$jsons.title,
            desc:$jsons.description,
            img:$jsons.image,
            img_title:'华浔品味装饰',
            from:'华浔品味装饰'
       })
		$('<div class="share_body change_fixed"><div class="socials icon_h5"></div></div><section class=erweima><div><img src="http://icon.dyrs.cc/zxsj/blank.gif"><span>微信里点“发现”，扫一下<br>二维码便可将本文分享至朋友圈。</span></div></section>').appendTo('body');
		share_fn();
		$('.socials').share($jsons);
		$(document).on('click', '.shares', function() {
			if(!my.share_flag){
				$('.share_body').show().find('social-share').addClass('normal');
			}
		});
		$('.social-share').on('click', '.icon-wechat', function() {
			$('.erweima').show();
			$('.erweima img').attr('src', $(this).find('.wechat-qrcode img').attr('src'))

		});
		$('.erweima div,.social-share').click(function(e) {
			e.stopPropagation();
		})
		$('.erweima,.share_body').click(function() {
			$(this).hide();
		})
	},
	email: /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
	tel_test: /^1[3|4|5|7|8][0-9]\d{8,8}$/,
	regPhone: /^(^0\d{2}-?\d{8}$)|(^0\d{3}-?\d{7}$)|(^\(0\d{2}\)-?\d{8}$)|(^\(0\d{3}\)-?\d{7}$)$/,
	scroll_ajax_flag: true,
	page: function(txt, ajax_fn) {
		var $win = $(window);
		var $txt = $(txt);
		if($txt.length<=0){
			return false;
		}
		$win.scroll(function() {
			if($win.scrollTop() + 100 > $txt.offset().top - $win.height()) {
				if(my.scroll_ajax_flag) {
					$txt.html(my.load[0]);
					ajax_fn();
				}
			}
		});
	},
	need_login_flag: true,
	load: ['<img src="http://icon.dyrs.cc/m/loading.gif"> 正在加载中', '加载已完成！'],
	show_loading: function() {
		$('#ajax_loading').show();
	},
	hide_loading: function() {
		$('#ajax_loading').hide();
	},
	view_no_scroll: function() {
		my.scroll = $(window).scrollTop();
		$('html,body').addClass('no_scroll');
	},
	view_scroll: function() {
		$('html,body').removeClass('no_scroll');
		$(window).scrollTop(my.scroll)
		my.scroll = 0;
	},
	location_href: 'public/location.html',
	location_flag: false,
	shape: function() {
		$('<div>').load('public/header.html', function() {
			//			alert(1)
			$('.title_icons').append('<section id="view_num">');
		}).prependTo('body');
		$('<div class="footer_empty"></div><footer class="color_content1 pd bg_f border_t f12 text-center m_top footer_">华浔品味装饰集团有限公司<br/> ©Copyright 京ICP备15089103号-1</footer>').appendTo('body');
	},
	public: function() {
		my.photo_cookie=GetCookie('dyrs_user_collect_photo');
		if(my.photo_cookie){
			my.photo_cookie=(my.photo_cookie.replace(/"/g,'').slice(1,-1)).split(',');
//			console.log(my.photo_cookie[0]);
		}
		template.helper('arr',function(id,name){
			var photo_cookie_flag=false;
			if(my.photo_cookie){
				for (var c=0;c<my.photo_cookie.length;c++) {
					if(id==my.photo_cookie[c]){
						photo_cookie_flag=true;
						break;
					}
				}
			}
			if(photo_cookie_flag){
				return name;
			}
		});
		template.helper('key_word',function(content){
			return content.replace(new RegExp(my.key,'ig'),'<b style="color:red">'+my.key+'</b>')
		});
		my.case_cookie=GetCookie('dyrs_user_collect_subject');
		if(my.case_cookie){
			my.case_cookie=(my.case_cookie.replace(/"/g,'').slice(1,-1)).split(',');
//			console.log(my.case_cookie[0]);
		}
		template.helper('arr1',function(id,name){
			var photo_cookie_flag=false;
			if(my.case_cookie){
				for (var c=0;c<my.case_cookie.length;c++) {
					if(id==my.case_cookie[c]){
						photo_cookie_flag=true;
						break;
					}
				}
			}
			if(photo_cookie_flag){
				return name;
			}
		});
		$('.footer_empty').height($('.footer_').outerHeight());
		$('.has_login').on('click','.go_ing',function(){
			location.href=$('.has_login a.color_red').attr('href');
		})
		if(typeof(title_title) != 'undefined') {
			$('#public_title div#title_title1,#public_title i.title_h2').html(title_title!='null'?title_title:'华浔品味装饰');
		} else {
//			console.log(2)
			$('#public_title div#title_title1,#public_title i.title_h2').html('华浔品味装饰');
		}
		//添加loading模块/S
		$("<section id='ajax_loading'><div><i></i></div></section>").appendTo('body');
		document.getElementById("ajax_loading").addEventListener('touchmove', function(e) {
			e.preventDefault();
		}, false);
		//添加loading模块/E
		//返回顶部s
		$('<div class="go_top icon icon-zhiding"></div>').appendTo('body').click(function() {
			$('html,body').stop().animate({
				scrollTop: 0
			}, 500);
		}); //返回顶部e
		var $go_top = $('.go_top');
		$(window).scroll(function() {
			if($(this).scrollTop() > 200) {
				$go_top.show();
			} else {
				$go_top.hide();
			}
		});
		$('body').on('click', '.url_back', function() {
				history.go(-1);
				return false;
			});
			//警告框
		$('<section id="warn" class="change_fixed no_touch"><span class="warn"><i class=" icon"></i><em></em></span></section>').appendTo('body');
		$('<section id="input_bug">').appendTo('body');
		$('.no_touch').each(function(index, obj) {
			obj.addEventListener('touchmove', function(e) {
				e.preventDefault();
			}, false);
		});
		//懒加载
		var setTime = setTimeout(function() {
			$(".lazy_img").lazyload(my.lazy);
			clearTimeout(setTime);
		}, 300);
		//菜单/s
		var img_flag = true;
		my.meun_flag = false;
		$('body').on('click', '#meun_icon', function() {
			if(my.meun_flag) {
				return false;
			}
			var $_this = $(this);
			if($_this.hasClass('on')) {
				$_this.removeClass('on')
				$('#public_meun').removeClass('zoom_big').addClass('zoom_small');
				$('div.black_block').stop().fadeOut();
				my.view_scroll();
				my.meun_flag = true;
				var tt = setTimeout(function() {
					$('#public_meun').hide();
					$('#public_meun').addClass('zoom_big').removeClass('zoom_small');
					my.meun_flag = false;
					clearTimeout(tt);
				}, 500)
			} else {
				$('#public_meun').show(); 
				$('div.black_block').stop().fadeIn();

				my.meun_flag = true;
				var tts = setTimeout(function() {
					my.view_no_scroll();
					my.meun_flag = false;
					clearTimeout(tts);
				}, 500);
				if(img_flag) {
					img_flag = false;
					$('#public_meun .lazy_img').lazyload(my.lazy);
				}
				$_this.addClass('on');
			}
		});
		//菜单/e
		//input_close/s
		$(document).on('click', '.input i.icon', function() {
			$(this).removeClass('has_close').siblings('input').val('');
		});
		$(document).on('input', '.input input', function() {
			if($(this).val()) {
				$(this).siblings('i.icon').addClass('has_close');
			} else {
				$(this).siblings('i.icon').removeClass('has_close');
			}
		}).on('focus', '.input input', function() {
			if($(this).val()) {
				$(this).siblings('i.icon').addClass('has_close');
			} else {
				$(this).siblings('i.icon').removeClass('has_close');
			}
		}).on('blur','.input input',function(){
			$(this).siblings('i.icon').removeClass('has_close');
		});
		$(document).on('click', '.search_select', function() {
			$('.select_list_body').show();
		})
		$(document).on('click', '.select_list_body', function() {
			$(this).hide();
		}).on('click', '.public_share', function() {});
		$(document).on('click', '.search_select_list span', function() {
			$('.search_select i.selected').html($(this).html());
			$('#public_search_input').attr('action', $(this).attr('data-href')).find('#search_select option').val($(this).attr('data-action'));
			$('input#word').focus();
			$('section.search_hot div').stop().hide().eq($(this).index()).fadeIn();
		});
		$('#public_search_input').submit(function(e){
			if($.trim($('#word').val())==''){
				e.preventDefault();
			}
		});
		//input_close/e
		$(document).on('click', '.ajax_location', function() {
			var $_this = $(this);
			var tts = setTimeout(function() {
				my.view_no_scroll();
				clearTimeout(tts);
			}, 500);
			if(my.location_flag) {
				$('#public_location').show();
				if(my.map) {
					$('#city_cur').html('定位中...');
					my.map();
				}
			} else {
				my.location_flag = true;
				my.show_loading();
				try {
					var location_now = location_href;
				} catch(e) {
					var location_now = my.location_href;
				}
				$('<section id="public_location" class="change_fixed fadeInUp">').load(location_now, function() {
					my.hide_loading();
				}).appendTo('body').show();
			}
		}).on('click', '.ajax_location1', function() {
			if($('#public_location').length<=0){
				return false;
			}
			var $_this = $(this);
			var tts = setTimeout(function() {
				my.view_no_scroll();
				clearTimeout(tts);
			}, 500);
			$('#public_location').show();
		}).on('click', '.close_location', function() {
			my.view_scroll();
			$('#public_location').removeClass('fadeInUp').addClass('fadeOutDown');
			var tts = setTimeout(function() {
				$('#public_location').hide().addClass('fadeInUp').removeClass('fadeOutDown');
				clearTimeout(tts);
			}, 500);
		}).on('focus', '#word', function(e) {
			$('#input_bug').show();
			$('section.search_hot').addClass('search_font');
			my.view_no_scroll();
			window.scrollTo(0, 0);
			$('#public_title').css('position', 'absolute');
			var $this = $(this);
		}).on('blur', '#word', function() {
			$('#public_title').css('position', 'fixed');
			my.view_scroll();
			$('#input_bug').hide();
			$('section.search_hot').removeClass('search_font');
		});
	},
	//懒加载
	lazy: {
		effect: "fadeIn",
		threshold: 200,
		load: function(w1, h1) {
			var load_this = $(this);
			if(load_this.hasClass('auto')) {
				var _this_parent_width = load_this.parent().width();
				var _this_parent_height = load_this.parent().height();
				var _this_width = w1;
				var _this_height = h1;
				//				console.log(_this_width+"}"+_this_height)
				if(_this_parent_width / _this_parent_height < _this_width / _this_height) {
					load_this.css({
						width: 'auto',
						height: '100%'
					});
					_this_width = _this_parent_height * w1 / h1;
					load_this.css({
						left: -(((_this_width - _this_parent_width) / 2) / _this_parent_width) * 100 + '%',
						top: 0
					})
				} else {
					load_this.css({
						width: '100%',
						height: 'auto'
					});
					_this_height = _this_parent_width * h1 / w1;
					load_this.css({
						top: -(((_this_height - _this_parent_height) / 2) / _this_parent_height) * 100 + '%',
						left: 0
					})
				}
			} else if(load_this.hasClass('auto_height')) {
				load_this.css({
					height: 'auto'
				});
			}
		}
	}
	//懒加载/e
};
my.public();
//临时js
if(window.location.href.indexOf('.html') >= 0) {
	my.shape();
}
if(!(navigator.userAgent).match(/\(i[^;]+;( U;)? CPU.+Mac OS X/)) {
	my.system = 'android';
}
$(window).scroll(function(){
	if($(window).scrollTop()>45){
		$('.tabTit .active').click();
	}
})
