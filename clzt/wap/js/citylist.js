/*
 @ name:城市联动插件
 @ author：前端老徐
 @ date：2016-3-21
*/
;(function(w){
	function Fn(){
		this.node={
			prov:document.getElementById('prov'),
			city:document.getElementById('city'),
			area:document.getElementById('area')
		}
		this.data=null;
		this.def={prov:0,city:0,area:0}
		this.nodata=[{id:'',name:'市/区'}];
	}
	//初始化
	Fn.prototype.init=function(opt,d1,d2,d3){
		var _self=this;
		//默认值
		_self.def.prov=d1?d1:0
		_self.def.city=d2?d2:0
		_self.def.area=d3?d3:0
		//节点
		_self.node.prov=opt.prov
		_self.node.city=opt.city
		_self.node.area=opt.area;
		//获取省市
		this.getProv();
	}
	//创建表单
	Fn.prototype.create=function(data,def,key_id,key_name){
		var fra=document.createDocumentFragment();
		for(x in data){
			var opt=document.createElement('option');
			opt.appendChild(document.createTextNode(data[x][key_name]))
			opt.setAttribute('value',data[x][key_id]);
			opt.setAttribute('data-index',x);
			if(data[x][key_id]==def){
				opt.selected=true;
			}
			fra.appendChild(opt);
		}
		return fra;
	}
	//获取省市
	Fn.prototype.getProv=function(){
		var _self=this;
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","/api/common/address.php?action=getCityList",true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function(){
	  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
				var data=(eval('('+xmlhttp.responseText+')'));
				if(data.code==1000){
					//缓存数据
					_self.data=data.data;
					//创建DOM
					_self.node.prov.appendChild(_self.create(data.data,_self.def.prov,'province_id','provincename'));
					//绑定切换
					_self.node.prov.onchange=function(){
						_self.getCity.call(_self);
					}
					//获取城市
					_self.getCity();
				}
			}
	    }
	}
	//获取市
	Fn.prototype.getCity=function(){
		var _self=this;
		if(_self.node.prov.value){
			var index=_self.node.prov.options[_self.node.prov.selectedIndex].getAttribute('data-index');
			_self.node.city.innerHTML='';
			_self.node.city.appendChild(_self.create(_self.data[index].cityList,_self.def.city,'city_id','cityname'));
			//绑定切换
			_self.node.city.onchange=function(){
				_self.getArea.call(_self);
			}
			//获取区县
			_self.getArea();
		}else{
			_self.node.city.innerHTML='';
			_self.node.city.appendChild(_self.create(_self.nodata,_self.def.city,'id','name'));
			if(_self.node.area){
				_self.node.area.innerHTML='';
				_self.node.area.appendChild(_self.create(_self.nodata,_self.def.area,'id','name'));	
			}
		}
	}
	//获取区县
	Fn.prototype.getArea=function(){
		var _self=this;
		if(!_self.node.area){return}
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.open("GET","/api/common/address.php?action=getDistrictList&city="+_self.node.city.value,true);
		xmlhttp.send();
		xmlhttp.onreadystatechange=function(){
	  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
				var data=(eval('('+xmlhttp.responseText+')'));
				if(data.code==1000){
					_self.node.area.innerHTML='';
					_self.node.area.appendChild(_self.create(data.data,_self.def.area,'id','district_name'));
				}else{
					//alert(data.info);
					if(_self.node.area){
						_self.node.area.innerHTML='';
						_self.node.area.appendChild(_self.create(_self.nodata,_self.def.area,'id','name'));	
					}	
				}
			}
	    }
	},
	w.citySelect=Fn
})(window);