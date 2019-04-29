<?php
require_once('conn.php');
session_start();

/*栏目ID预设*/

/*栏目ID预设*/
//获取IP
function GetIp() {
	if (isSet($_SERVER)) {
		if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$IP = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} elseif (isSet($_SERVER["HTTP_CLIENT_ip"])) {
			$IP = $_SERVER["HTTP_CLIENT_ip"];
		} else {
			$IP = $_SERVER["REMOTE_ADDR"];
		}

	} else {
		if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
			$IP = getenv( 'HTTP_X_FORWARDED_FOR' );
		} elseif ( getenv( 'HTTP_CLIENT_ip' ) ) {
			$IP = getenv( 'HTTP_CLIENT_ip' );
		} else {
			$IP = getenv( 'REMOTE_ADDR' );
		}
	}
	return $IP; 
}

//获得指定表数据总记录数
function GetCount($tbname)
{
	if($tbname == '') return false;
	
	$sql = mysql_query("select * from `$tbname`");
	$rs = mysql_num_rows($sql);
	return $rs;

}


//获得单页表数据总记录数
function GetPage($tbname)
{
	if($tbname == '') return false;
	
	$sql = mysql_query("select * from `$tbname` where ctypes=0");
	$rs = mysql_num_rows($sql);
	return $rs;

}

/**
 *  短消息函数,可以在某个动作处理后友好的提示信息
 *
 * @param     string  $msg      消息提示信息
 * @param     string  $gourl    跳转地址
 * @param     int     $onlymsg  仅显示信息
 * @param     int     $limittime  限制时间
 * @return    void
 */
function ShowMsg($msg, $gourl, $onlymsg=0, $limittime=0)
{
    
    $htmlhead  = "<html>\r\n<head>\r\n<title>提示信息</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n";
    $htmlhead .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0' bgcolor='#FFFFFF'>".(isset($GLOBALS['ucsynlogin']) ? $GLOBALS['ucsynlogin'] : '')."\r\n<center>\r\n<script>\r\n";
    $htmlfoot  = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";

    $litime = ($limittime==0 ? 5000 : $limittime);
    $func = '';

    if($gourl=='-1')
    {
        if($limittime==0) $litime = 5000;
        $gourl = "javascript:history.go(-1);";
    }

    if($gourl=='' || $onlymsg==1)
    {
        $msg = "<script>alert(\"".str_replace("\"","“",$msg)."\");</script>";
    }
    else
    {
        //当网址为:close::objname 时, 关闭父框架的id=objname元素
        if(preg_match('/close::/',$gourl))
        {
            $tgobj = trim(preg_replace('/close::/', '', $gourl));
            $gourl = 'javascript:;';
            $func .= "window.parent.document.getElementById('{$tgobj}').style.display='none';\r\n";
        }
        
        $func .= "      var pgo=0;
      function JumpUrl(){
        if(pgo==0){ location='$gourl'; pgo=1; }
      }\r\n";
        $rmsg = $func;
        $rmsg .= "document.write(\"<br /><div style='width:450px; margin-top:200px;padding:0px;border:1px solid #DADADA;'>";
        $rmsg .= "<div style='padding:6px;font-size:12px;  color:#FFF; font-weight:bold; border-bottom:1px solid #DADADA;background:#0088d1 url(../images/tip_top.png)';'><b>提示信息！</b></div>\");\r\n";
        $rmsg .= "document.write(\"<div style='height:auto;font-size:10pt;background:#ffffff'><br />\");\r\n";
        $rmsg .= "document.write(\"".str_replace("\"","“",$msg)."\");\r\n";
        $rmsg .= "document.write(\"";
        
        if($onlymsg==0)
        {
            if( $gourl != 'javascript:;' && $gourl != '')
            {
                $rmsg .= "<br /><br /><a style='color:#999; font-weight:bold; text-decoration:none;' href='{$gourl}'>如果你的浏览器没反应，请点击这里...</a>";
                $rmsg .= "<br/></div>\");\r\n";
                $rmsg .= "setTimeout('JumpUrl()',$litime);";
            }
            else
            {
                $rmsg .= "<br/></div>\");\r\n";
            }
        }
        else
        {
            $rmsg .= "<br/><br/></div>\");\r\n";
        }
        $msg  = $htmlhead.$rmsg.$htmlfoot;
    }
    echo $msg;
}


//序列化
function encode($str) {
	return urldecode(json_encode(url_encode($str)));	
}

function url_encode($str) {
	if(is_array($str)) {
		foreach($str as $key=>$value) {
			$str[urlencode($key)] = url_encode($value);
		}
	} else {
		$str = urlencode($str);
	}
	
	return $str;
}

//检查外部传递的值并转义
function _RunMagicQuotes(&$svar)
{
	//PHP5.4已经将此函数移除
    if(@!get_magic_quotes_gpc())
    {
        if(is_array($svar))
        {
            foreach($svar as $_k => $_v) $svar[$_k] = _RunMagicQuotes($_v);
        }
        else
        {
            if(strlen($svar)>0 &&
			   preg_match('#^(cfg_|GLOBALS|_GET|_POST|_SESSION|_COOKIE)#',$svar))
            {
				exit('不允许请求的变量值!');
            }

            $svar = addslashes($svar);
        }
    }
    return $svar;
}


//直接应用变量名称替代
foreach(array('_GET','_POST') as $_request)
{
	foreach($$_request as $_k => $_v)
	{
		if(strlen($_k)>0 &&
		   preg_match('#^(GLOBALS|_GET|_POST|_SESSION|_COOKIE)#',$_k))
		{
			exit('不允许请求的变量名!');
		}

		${$_k} = _RunMagicQuotes($_v);
	}
}
//清除HTML
if(!function_exists('ClearHtml'))
{
	function ClearHtml($str)
	{
		$str = strip_tags($str);

		//首先去掉头尾空格
		$str = trim($str);

		//接着去掉两个空格以上的
		$str = preg_replace('/\s(?=\s)/', '', $str);

		//最后将非空格替换为一个空格
		$str = preg_replace('/[\n\r\t]/', ' ', $str);

		return $str;
	}
}




?>