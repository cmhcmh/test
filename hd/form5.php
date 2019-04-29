<style>
#div6{
z-index:9999999;
display: none;
position: absolute;
left:40%;
top:30%;
width:450px;
height:250px;
background-color:#fff;
text-align: center;
padding-bottom:2%;
}
#div6 label{font-size:16px;color:#000;}	 
#div6 input{border:1px gray solid;font-size:16px;}	 
.mx{width:300px;line-height:35px;}
#div6 form{padding:5px 5px; margin:0px auto;     padding-left: 12%;
    background-color: #fff;}
</style>
<script>
function OpenDiv5(){
document.getElementById("div6").style.display="block";
document.getElementById("open5").style.display="none";
}
//给div层中的关闭添加onclick事件：
function CloseDiv5(){
document.getElementById("div6").style.display="none";
document.getElementById("open5").style.display="block";
}
</script>
<div id="div6">
<div style="color:#000;font-size:28px;">立即报名</div>
<div style="clear:both;"></div>
<form id="form_tan" method="post">

<div class="mx">
<label><i>* </i>所在城市：</label>
	<input type="text" value=""/>  
</div>
<div class="mx">
<label><i>* </i>楼盘名字：</label>
<input type="text" name="hourse" id="hourse_tan">
</div>
<div class="mx">
<label><i>* </i>您的名字：</label>
<input type="text" name="name" id="name_tan">
</div>
<div class="mx">
<label><i>* </i>联系电话：</label>
<input type="tel" name="mobile" id="mobile_tan">
</div>
<div class="mx" style="padding-left:10%">

	<div style="float:left;"><label><i>* </i>验 证 码：</label>
		<input type="text" class="text text2" placeholder="验证码" name="verify" id="verify_tan" style="width:80px;" />
	</div>
	<div style="float:left;">
		<img  src="code.php" onclick="this.src+='?rand='+Math.random();" />
	</div>
</div>
<input type="hidden" name="company_id" value="0">
<div style="clear:both;"></div>
<p class="mx"><font style="text-align: center;" color="red" size="-1" id="cmresult_tan"></font></p>

<input style="font-size:14px;padding:3px;margin-top:2%;" type="submit" name="submit" class="submit" value="立即提交" />
<a style="margin-left:2%;" href="javascript:CloseDiv5();"><input style="font-size:14px;padding:3px;margin-top:2%;" type="button" name="guanbi" value="关闭" /></a>
</form>
</div>