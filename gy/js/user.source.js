$(document).ready(function () {
	function GetQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if (r != null)
			return decodeURI(r[2]);
		else
			return null;
	}

	var utm_source = GetQueryString("utm_source");
	if (utm_source != null && utm_source.toString().length > 0) {
		setCookie("utm_source", utm_source);
	}

	var utm_medium = GetQueryString("utm_medium");
	if (utm_medium != null && utm_medium.toString().length > 0) {
		setCookie("utm_medium", utm_medium);
	}

	var utm_city = GetQueryString("utm_city");
	if (utm_city != null && utm_city.toString().length > 0) {
		setCookie("utm_city", utm_city);
	}

	var utm_keyword = GetQueryString("utm_keyword");
	if (utm_keyword != null && utm_keyword.toString().length > 0) {
		setCookie("utm_keyword", utm_keyword);
	}

});