if(typeof(re_pv)=="undefined"){
	var re_pv=true;
	function utf8to16(str) {
		var out, i, len, c;
		var char2, char3;
	
		out = "";
		len = str.length;
		i = 0;
		while(i < len) {
			c = str.charCodeAt(i++);
			switch(c >> 4){ 
			  case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
				// 0xxxxxxx
				out += str.charAt(i-1);
				break;
			  case 12: case 13:
				// 110x xxxx   10xx xxxx
				char2 = str.charCodeAt(i++);
				out += String.fromCharCode(((c & 0x1F) << 6) | (char2 & 0x3F));
				break;
			  case 14:
				// 1110 xxxx  10xx xxxx  10xx xxxx
				char2 = str.charCodeAt(i++);
				char3 = str.charCodeAt(i++);
				out += String.fromCharCode(((c & 0x0F) << 12) |
											   ((char2 & 0x3F) << 6) |
											   ((char3 & 0x3F) << 0));
				break;
			}
		}
		return out;
	}
	var base64DecodeChars = new Array(
		-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
		-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
		-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63,
		52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1,
		-1,  0,  1,  2,  3,  4,  5,  6,  7,  8,  9, 10, 11, 12, 13, 14,
		15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1,
		-1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
		41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);
	function base64decode(str) {
		var c1, c2, c3, c4;
		var i, len, out;
		len = str.length;
		i = 0;
		out = "";
		while(i < len) {
			/* c1 */
			do {
				c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
			} while(i < len && c1 == -1);
			if(c1 == -1)
				break;
			/* c2 */
			do {
				c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff];
			} while(i < len && c2 == -1);
			if(c2 == -1)
				break;
			out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));
			/* c3 */
			do {
				c3 = str.charCodeAt(i++) & 0xff;
				if(c3 == 61)
					return out;
				c3 = base64DecodeChars[c3];
			} while(i < len && c3 == -1);
			if(c3 == -1)
				break;
			out += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));
			/* c4 */
			do {
				c4 = str.charCodeAt(i++) & 0xff;
				if(c4 == 61)
					return out;
				c4 = base64DecodeChars[c4];
			} while(i < len && c4 == -1);
			if(c4 == -1)
				break;
			out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
		}
		return out;
	}
	/*-----------------------------------------------------------------------*/	
   function getDomain(hn){
		  str=hn.replace(/\.(com|net|org|cn)\.?.*/,"");
		  if(str.lastIndexOf(".") == -1)
			  dm = "." + hn;
		  else
		  {
			  str = str.substring(str.lastIndexOf("."));
			  dm = hn.substring(hn.lastIndexOf(str));
		  }
		  dm = dm.split('/');
		  return dm[0];
	 }	
	function readck(name){
		var cookieValue = "";
		var search_s = name + "=";
		if(document.cookie.length > 0)
		{ 
			var offset = document.cookie.indexOf(search_s);
			if (offset != -1)
			{ 
				offset += search_s.length;
				end = document.cookie.indexOf(";", offset);
				if (end == -1) end = document.cookie.length;
				cookieValue = unescape(document.cookie.substring(offset, end));
			}
		}
		return cookieValue;
	}
	function writeck(name, value, hours)
	{
		var expire = "";
		if(hours != null)
		{
			expire = new Date((new Date()).getTime() + hours * 3600000);
			expire = "; expires=" + expire.toGMTString();
		}
		document.cookie = name + "=" + escape(value) + expire + ";domain=.dyrs.com.cn;path=/; ";
	}
	
	function randck(){
		var now = new Date().getTime();
		return now+Math.floor(Math.random()*999);
	}
	function strdecode(str){
		return utf8to16(base64decode(str));
	}
	
	function pv_d(){
		var now = new Date().getTime();
	
		var datestr=escape(now*1000+Math.round(Math.random()*1000));
		var pvuserid = "";  
		var pv_uid = 0;
		var v_n = parseInt(readck('vn'));
		if(isNaN(v_n)) v_n = 0;
		var vn = v_n;
		var l_v = parseInt(readck('lv'));
		if(isNaN(l_v)) l_v = 0;
		var lv = l_v;

		if((+new Date()/1000)-l_v > 7200)
		{
			lv = parseInt(+new Date()/1000);
			vn++;
			writeck('lv',lv,24*365);
			writeck('vn',vn,24*365);
		} 
	    if(window.screen.width && window.screen.height){
		    xy_screen = window.screen.width+"x"+window.screen.height;
	   }	
		var imgsrc='';
     	var ref = document.referrer == '' ? '-' : document.referrer;
		var host = window.location.host;

		var checkurl = host.indexOf('dyrs.com.cn')>=0||host.indexOf('ycgj.cc')>=0||host.indexOf('dyrsbj.com')>=0||host.indexOf('dyrsbs.com')>=0;

		if(checkurl > 0){
			if(top.location == self.location){
				imgsrc='http://pv.dyrs.com.cn/images/dyrspv0001.gif?pvuserid='+pvuserid+'&r='+datestr+'&ref='+ref; 
			}else {
				imgsrc='http://pv.dyrs.com.cn/images/dyrspv0002.gif?pvuserid='+pvuserid+'&r='+datestr+'&ref='+ref;				
			}
		}else{
			imgsrc='http://pv.dyrs.com.cn/images/dyrspv0003.gif?pvuserid='+pvuserid+'&r='+datestr+'&ref='+ref;
		}
		
		if(imgsrc!='')
		{
			pv_uid = readck('pv_uid');
			if(!pv_uid){
			  pv_uid = randck();
			  writeck('pv_uid',pv_uid,24*365);
			}
			var cs_source = '';
			var pv_source = getDomain(document.referrer);
			var pv_ck_source= readck('pv_source');
			if(pv_source != '.dyrs.com.cn'){
				cs_source = document.referrer;
				writeck('pv_source',document.referrer,1);
			}else{
				cs_source = pv_ck_source;
			}
			imgsrc += '&pv_uid=' + pv_uid +'&vn='+vn + '&lv='+lv+'&xy_screen='+xy_screen+"&cs_source="+cs_source+"&host="+host;
			document.write('<img border="0" width="0" height="0" src="'+imgsrc+'">');
		}  
	} 
	
pv_d();

}

var _ja = _ja || [];
_ja.push(['userid',readck("dyrs_useridx")]);
(function() {
var ja = document.createElement("script");
ja.src = "//ja.jiajuol.com/ja.js?2002";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(ja, s);
})();
