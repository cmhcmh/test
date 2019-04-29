if(typeof doyoo=='undefined' || !doyoo){
var d_genId=function(){
var id ='',ids='0123456789abcdef';
for(var i=0;i<34;i++){ id+=ids.charAt(Math.floor(Math.random()*16)); } return id;
};

var doyoo={
env:{
secure:false,
mon:'http://m2425.looyu.com/monitor',
chat:'http://looyuoms2431.looyu.com/chat',
file:'http://yun-static.soperson.com/131221',
compId:20000192,
confId:10039645,
workDomain:'',
vId:d_genId(),
lang:'',
fixFlash:1,
fixMobileScale:0,
subComp:5418,
_mark:'9e767623dfd70fa87a67340ee724899af20aa211a3db8f27627db597507d7f1a7598e5948b1a3d8a'
},
chat:{
mobileColor:'',
mobileHeight:80,
mobileChatHintBottom:0,
mobileChatHintMode:0,
mobileChatHintColor:'',
mobileChatHintSize:0
}

, monParam:{
index:-1,
preferConfig:0,

style:{mbg:'http://jscss.dyrs.cc/icon/ly.png',mh:244,mw:433,
elepos:'0 0 0 0 0 0 0 0 148 44 132 37 380 220 28 28 307 116 94 31',
mbabg:'',
mbdbg:'',
mbpbg:''},

title:'',
text:'\u60a8\u597d\uff0c\u6b22\u8fce\u5149\u4e34\uff0c\u6211\u662f\u4eca\u5929\u7684\u5728\u7ebf\u670d\u52a1\u4eba\u5458\uff0c\u5f88\u9ad8\u5174\u4e3a\u60a8\u670d\u52a1!&nbsp;',
auto:1,
group:'10059956',
start:'00:00',
end:'24:00',
mask:false,
status:true,
fx:4,
mini:0,
pos:1,
offShow:0,
loop:10,
autoHide:0,
hidePanel:0,
miniStyle:'#ff5f53',
miniWidth:'340',
miniHeight:'490',
showPhone:0,
monHideStatus:[0,0,0],
monShowOnly:'',
autoDirectChat:2,
allowMobileDirect:0,
minBallon:1,
chatFollow:1
}


, panelParam:{
mobileIcon:'',
mobileIconWidth:0,
mobileIconHeight:0,
category:'win',
preferConfig:0,
position:1,
vertical:120,
horizon:5

,mode:0,
index:1

,width:110



,title:'\u5728\u7ebf\u54a8\u8be2'


, headClr:'#FFFFFF',
headBgClr:'#ff5f53',
borderClr:'#ff5f53',
phone:''



,customers:{"mode":"1","groups":[{"mode":1,"phone":0,"name":"\u96c6\u56e2\u503c\u5b88","sms":0,"count":4,"online":1,"active":1,"id":10059956,"customers":[{"offline":0,"busy":0,"name":"\u62a5\u4ef7-\u804a\u6211","id":"jtkf04","status":0},{"offline":0,"busy":0,"name":"\u7535\u8bdd\u9884\u7ea6","id":"jtdyrs","status":0},{"offline":0,"busy":0,"name":"\u6848\u4f8b-\u804a\u6211","id":"jt201601k","status":1},{"offline":0,"busy":0,"name":"\u4f18\u60e0-\u804a\u6211","id":"jt201701","status":1}]}],"showRobot":0}



}



};

if(typeof talk99Init == 'function'){
talk99Init(doyoo);
}
if(!document.getElementById('doyoo_panel')){
var supportJquery=typeof jQuery!='undefined';
var doyooWrite=function(html){
document.writeln(html);
}

doyooWrite('<div id="doyoo_panel"></div>');


doyooWrite('<div id="doyoo_monitor"></div>');


doyooWrite('<div id="talk99_message"></div>')

doyooWrite('<div id="doyoo_share" style="display:none;"></div>');
doyooWrite('<lin'+'k rel="stylesheet" type="text/css" href="http://yun-static.soperson.com/131221/oms.css?170918"></li'+'nk>');
doyooWrite('<scr'+'ipt type="text/javascript" src="http://yun-static.soperson.com/131221/oms.js?170918" charset="utf-8"></scr'+'ipt>');
}
}
