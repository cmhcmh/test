var svpano = '';

var SDK_SVPano = {
	'data' : [],
	'panoId' : "krpano",
    'PointData': "",
	'SDK_Receive_Data': "",
	initializtionPano: function(data){
		embedpano({swf:data['swf'], xml:data['xml'], target:data['div_id'], html5:data['html5'],wmode:data['wmode'], id:this.panoId,initvars:{
			Data_Path:data['Data_Path'],	//data.xml文件所在的路径
			mypath:data['mypath'],	//data.xml文件所在的路径
			Pano_Path:data['Pano_Path'],	//全景图像目录
			Plugin_Path:data['Plugin_Path'],//全景图像目录
			Edit_Path:data['Edit_Path'],	//编辑器所在目录
			praise:data['praise'],			//本套全景点赞量
			user_title:data['title'],		//用户公司名称
			user_tel:data['tel'],			//用户公司联系方式
			user_add:data['address'], 		//用户公司联系地址
			works:"0"
		}, mobilescale:0.5, passQueryParameters:true});
		svpano = eval(this.panoId);
		console.log(data);
	},
	//新增热点
	AddHot: function(data) {
		console.log(data);	//取回结果
		svpano.call("addhotspot(" + data['name'] + ");set(hotspot[" + data['name'] + "].onloaded,svrvrtxt(););set(hotspot[" + data['name'] + "].wz," + data['position'] + ");set(hotspot[" + data['name'] + "].html," + data['title'] + ");set(hotspot[" + data['name'] + "].ath," + data['ath'] + ");set(hotspot[" + data['name'] + "].atv," + data['atv'] + ");set(hotspot[" + data['name'] + "].js," + data['js'] + ");set(hotspot[" + data['name'] + "].url," + data['img'] + ");");
		svpano.call("looktohotspot(" + data['name'] + ",get(view.fov));");
	},
	//删除热点
	DelHot: function(data) {
		svpano.call("removehotspot("+ data +");");
	},
	//获取热点属性
	ObtainHot: function(data) {
		svpano.call("SV_SDK(SDK_Hot_Property,"+ data +");");
		
	},
	//获取所有JS热点属性
	AllHot: function() {
		svpano.call("SV_SDK(SDK_Hot_Property,all);");
		
	},
	//获取参数
	get: function(x) {
		return svpano.get(x);
	},
	//设置参数
	set: function(x,y) {
		svpano.set(x,y);
	},
	//显示隐藏皮肤
	skin_Setting: function(x) {
		
		if(x == true){		//显示皮肤
				svpano.call("skin_fullscreen_btn(out);");
			}
			else
			{	//隐藏皮肤
				svpano.call("skin_fullscreen_btn(enter);");
			}
	},
	//进入、退出全屏
	skin_fullscreen: function(x) {
		if(x == true){		//进入全屏
				svpano.call("set(fullscreen,true);");
			}
			else
			{	//退出全屏
				svpano.call("set(fullscreen,false);");
			}
	},
	//生成时间催
	timeStamp: function(){
		var timestamp = Date.parse(new Date());
		timestamp = timestamp / 1000;
		svpano.set("timestamp",timestamp);
	}
}