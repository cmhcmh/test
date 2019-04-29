(function (evt) {

	//event util
	evt = evt || (function() {
			var ua = (function(){var o={ie:0,opera:0,gecko:0,webkit:0,mobile:null};var ua=navigator.userAgent,m;if((/KHTML/).test(ua)){o.webkit=1}m=ua.match(/AppleWebKit\/([^\s]*)/);if(m&&m[1]){o.webkit=parseFloat(m[1]);if(/ Mobile\//.test(ua)){o.mobile="Apple"}else{m=ua.match(/NokiaN[^\/]*/);if(m){o.mobile=m[0]}}}if(!o.webkit){m=ua.match(/Opera[\s\/]([^\s]*)/);if(m&&m[1]){o.opera=parseFloat(m[1]);m=ua.match(/Opera Mini[^;]*/);if(m){o.mobile=m[0]}}else{m=ua.match(/MSIE\s([^;]*)/);if(m&&m[1]){o.ie=parseFloat(m[1])}else{m=ua.match(/Gecko\/([^\s]*)/);if(m){o.gecko=1;m=ua.match(/rv:([^\s\)]*)/);if(m&&m[1]){o.gecko=parseFloat(m[1])}}}}}return o})();
			var doc = document.documentElement;
			var body = document.body;

			var evt = {
				getPageX: function(e) {
					return ('pageX' in e) ? e.pageX : e.clientX + (doc && doc.scrollLeft || body && body.scrollLeft || 0) - (doc && doc.clientLeft || body && body.clientLeft || 0);
				},

				getPageY: function(e) {
					return ('pageY' in e) ? e.pageY : e.clientY + (doc && doc.scrollTop  || body && body.scrollTop  || 0) - (doc && doc.clientTop  || body && body.clientTop  || 0);
				}
			};

			if (document.addEventListener) { // W3C
				evt.on = function(el, type, handler) {
					el.addEventListener(type, handler, false);
					return handler;
				};

				evt.on2 = evt.on;

				evt.un = function(el, type, handler) {
					el.removeEventListener(type, handler, false);
				};

				evt.stopPropagation = function(e) {
					e.stopPropagation();
				};

				evt.preventDefault = function(e) {
					e.preventDefault();
				};

				evt.getTarget = function(e) {
					return e.target;
				};

				evt.getRelTarget = function(e) {
					return e.relatedTarget;
				};
			} else { // IE
				evt.on = function(el, type, handler) {
					el.attachEvent('on' + type, handler);
				};

				evt.on2 = function(el, type, handler) {
					var actualHandler = function() {
						handler.call(el, window.event);
					};
					el.attachEvent('on' + type, actualHandler);
					// Return the 'actualHandler' reference, so that you can un it later.
					return actualHandler;
				};

				evt.un = function(el, type, handler) {
					el.detachEvent('on' + type, handler);
				};

				evt.stopPropagation = function(e) {
					e.cancelBubble = true;
				};

				evt.preventDefault = function(e) {
					e.returnValue = false;
				};

				evt.getTarget = function(e) {
					return e.srcElement;
				};
				evt.getRelTarget = function(e) {
					return e.fromElement === e.srcElement ? e.toElement : e.fromElement;
				};
			}

			evt.stop = function(e) {
				evt.stopPropagation(e);
				evt.preventDefault(e);
			};
		  return evt;
		})();

	function sendData(config) {
		var type = config.type || "IMAGE",
		cb = config.callback || function () {},
		url = reportUrl,
		param = paramObject2String(config.parameters);
		// console.log(config)
		if(typeof config.parameters.cpid !== 'undefined') {
			url = url.replace('p.l.qq.com','t.l.qq.com');
		}
		if (type == "IMAGE") {
      // var a = new Image(1, 1);
      // a.onload = function () {
      //     cb();
      // };
      // a.src = url + "?" + param;
      // 不需要onload回调
      _core_report(url+"?"+param)
		}
	}

  var _core_report = function (ping_url) {
    var isClientWebkit = window.webkit && window.webkit.messageHandlers && window.webkit.messageHandlers.TADPing && window.webkit.messageHandlers.TADPing.postMessage;
    // console.log(isClientWebkit);
    if(!isClientWebkit) {
      img = new Image(1,1)
      img.src = ping_url
    } else {
      window.webkit.messageHandlers.TADPing.postMessage(ping_url)
    }
  }

  // var ping = 'http://p.l.qq.com/ping?t=z&ttp=t&dtype=32&button=2223'
	function paramObject2String(param) {
		var s = "";
		if (typeof param === "object") {
			for (var k in param) {
				s += ( k + "=" + encodeURIComponent(param[k]) + "&" );
			}
		} else {
			s = param;
		}
		return s.substring(0, s.length-1);
	}

	function applyTo(to, from) {
		for(var p in from) {
			to[p] = from[p];
		}
	}

  var reportUrl = "http://p.l.qq.com/ping";
	var ASK = AdStatisticKit = {
			args: {},
			pageDurationPingDefaultData: {
				t: "m", // m表示活动，w表示腾果，z表示智汇推TCPA
				url: window.location.href,
				cpid: '',
				ref: document.referrer
			},
			initArgs: function () {
        // 根据script节点的arguments参数获取相关配置
				var script = document.getElementById('ad_statistic_kit');
				try {
					var input_args = eval('(' + script.getAttribute('arguments') + ')');
          // 循环赋值
					applyTo(this.pageDurationPingDefaultData, input_args);
				} catch(e) {
					// do nothing
				}
        // console.log(this.args)
        // 这个逻辑基本永远走不进来
				if (this.args.pageDurationPingUrl) {
					this.pageDurationPingUrl = this.args.pageDurationPingUrl;
				}
			},
			init: function () {
				this.initArgs();
			},

			getPageOpenHandler: function () {
				var t = this,
				p = {ttp:"o"};
				applyTo(p, t.pageDurationPingDefaultData);
        /**
         * ttp: o,
         * t: w
         * cpid: xxxxx
         * url: 脚本执行页面地址
         * ref: 来源页面
         */
				return function() {
					sendData({
						type: "IMAGE",
						parameters: p
					});
				};
			},

			getPageCloseHandler: function () {
				var t = this,
				p = {ttp:"c"};
				applyTo(p, t.pageDurationPingDefaultData);

				return function() {
					sendData({
						type: "IMAGE",
						parameters: p
					});
				};
			},

			startPageDurationJob: function () {
        // 离开页面的时候上报
				evt.on(window, "beforeunload", this.getPageCloseHandler());
        // 上报页面打开时的数据
        // console.log('this.getPageOpenHandler')
				this.getPageOpenHandler()();
			},
      buttonclick: function (params) {
        var t = params.t || "z";
        var ttp = params.ttp || "t";
        var dtype = params.dtype || 32;
        if(!params.button) {
          return;
        }
        var button = params.button;
        sendData({
          type: "IMAGE",
          parameters: {
            t: t,
            ttp: ttp,
            dtype: dtype,
            button: button
          }
        })
      }
	};

	ASK.init();
	ASK.startPageDurationJob();
  window.TencentMindASK = ASK
})();
