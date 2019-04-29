<?php
// 公共类
class CommonAction extends Action {
    protected $site_config = null;
    public function __construct() {
              
        header('Content-Type:text/html; charset=utf-8');
        $site_config = include WEB_ROOT . 'Common/systemConfig.php';
			$weburl = 'www'.$_SERVER['HTTP_HOST'];
			if(stripos($weburl,'hxzs1998.cn',TRUE)){
				$host1 = 'hxzs1998.cn';
				$host2 = 'www.hxzs1998.cn';
			}elseif(stripos($weburl,'hxdec.com.cn',TRUE)){
				$host1 = 'hxdec.com.cn';
				$host2 = 'www.hxdec.com.cn';
			}elseif(stripos($weburl,'hxdec.com',TRUE)){
				$host1 = 'hxdec.com';
				$host2 = 'www.hxdec.com';
			}elseif(stripos($weburl,'hxgw.com',TRUE)){
				$host1 = 'hxgw.com';
				$host2 = 'www.hxgw.com';
			}
            $this->host_domain="$host1";
            $this->host="$host2";
			
         $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
         // header("Location: /mobile.php");//访问手机版

		 //以防PHP5.5以下array_column方法报错后
		 if (!function_exists('array_column')) {
			function array_column($arr2, $column_key) {
				
				foreach ($arr2 as $key => $value) {
					$data[] = $value[$column_key];
				}
				return $data;
			}
		}
		 
		 
		 
		//获取域名前缀进行对比
		$url="http://".$_SERVER ['HTTP_HOST'];
		$url2=$_SERVER ['HTTP_HOST'];
		preg_match("#http://(.*?)\.#i",$url,$match);
		$domac = $match[1];
		//echo $_SERVER ['HTTP_HOST'];die;
		$yum = M('company')->field('c_domain')->select();
		$yum2 = array_column($yum, 'c_domain');

		$yum2=array_filter($yum2);
		//为每个前缀添加后面域名
		foreach($yum2 as $key){
			$yum2 .= $key.'.hxgw.com|'; 
		}
		//去除array的字符串
		$yum2 = str_replace('Array', ' ', $yum2);
		
		$yum2 = explode("|",$yum2);
		if(in_array($url2,$yum2)){
			
		}else{
			header("Location: http://www.hxdec.com");
			exit;
		}
		
		
		
        $uachar = "/(nokia|sony|ericsson|mot|samsung|sgh|lg|philips|panasonic|alcatel|lenovo|cldc|midp|mobile)/i";

        if(($ua == '' || preg_match($uachar, $ua))&& !strpos(strtolower($_SERVER['REQUEST_URI']),'wap'))
        {
            $Loaction = '/mobile';

            if (!empty($Loaction))
            {
                header("Location: /mobile.php");

                exit;
            }

        };
		/************************报名业主数据*****************************/
        $this->message = M('message')->where('type=1')->count();
       
        $this->message_num = $this->message+2048;
		
		
		
		
       //更新轮播图的状态
       $this->updatebannerstatus();
		
        //网站信息
        $this->site_info = $site_config['SITE_INFO'];
        $this->site_config = $site_config;
		
		//网站logo
		$this->logo=M('ads')->where('cat_id=5')->select();
        //底图推荐
        $this->tuijian=M('ads')->where('cat_id=6')->select();
        //公司简介
		$this->intro=M('articlecat')->where('parent_id=1')->select();
        //新闻动态
        $this->news=M('articlecat')->where('parent_id=2')->order('sort_order asc,cat_id asc')->select();
        //产品展示
        $this->product=M('goodscat')->where('parent_id=0')->order('sort_order asc,cat_id asc')->select();
        //友情链接
        //网站logo跟二维码
        $this->other_logo=M('ads')->where('cat_id=11 and title="网站logo"')->find();
        //print_R($this->other_logo);exit;
        $this->other_public=M('ads')->where('cat_id=11 and title="公众号二维码"')->find();
       $this->other_xinxi=M('ads')->where('cat_id=11 and title="信息化二维码"')->find();
        $link=$this->site_info['links'];

        $links=explode('|',$link);//print_r($links);
        // var_dump($links);die;

        $this->assign('links',$links);
        // var_dump($links);die;
        //分页设置
        $this->pageTheme = "%upPage% %first% %prePage% %linkPage%  %nextPage% %downPage%  %end%";

        $this->assign('action', ACTION_NAME);

        
        //所有分类
        $this->all_cats = $this->subCat(0);
       // print_r($this->all_cats);

        //获取ip
        $getip_out = $this->getip_out();
        $getip_out="59.41.202.57";
        $getIPLoc = "";
     

        //记录触发定位的动作参数
    
        $this->get_city_action = $_REQUEST['get_city_action']?intval($_REQUEST['get_city_action']):0;
        $this->is_action = $_REQUEST['is_action']?intval($_REQUEST['is_action']):0;
        //记录地址
        $REQUEST_URI = $_SERVER['REQUEST_URI'];

        $REQUEST_URI= str_replace("?get_city_action=1", "?get_city_action=1&is_action=1", $REQUEST_URI);
        $this->assign('REQUEST_URI', $REQUEST_URI);
        $this->assign('cookie_search_city', 0);

        if($getIPLoc){
                $city   = $getIPLoc;
                $iparea = $this->iparea($city);//查找记录数据

        }

        if($_REQUEST['search_city'] || $_COOKIE['cookie_search_city']){

                $this->assign('cookie_search_city', 1);
        }

        if($_COOKIE['cookie_a_id'] || $iparea){

                $a_id = $_COOKIE['cookie_a_id'];
                if($iparea) $a_id =$iparea['a_id'];
                $this->companydata = $this->getcompany_domain($a_id); //查询所在地区的二级域名分公司
                $this->companynum = count($this->companydata);
                $this->ipcity =$this->getareainfo($a_id);
           
                 
        }
         
              //先定义
        $this->company_id=0;//0为全国
        $this->com_where='1 AND company_id='.$this->company_id.' AND is_show=1'; //文章条件
        $this->com_where2='1 AND is_show=1'; //文章条件		
        $this->com_table_where='1 AND a.is_show=1'; //带命名文章条件
        $this->banner_where='1 AND company_id=0 '; //图片广告
        $this->company_sort ='sort_order asc,add_time desc';
        $this->company_table_sort ='a.sort_order asc,add_time desc';
        $this->company_recommend ='is_recommend=1';
        $domain = $this->getUrlRoot();//获取二级域名

        $company_id = $_REQUEST['company_id']?intval($_REQUEST['company_id']):0;
        //判断二级域名跳转
        if($domain == 'hxdec' || $domain == 'www')
        {
             $this->company_id=0;//0为全国
             $this->com_where='1  AND is_show=1'; //文章条件
             $this->com_where2='1 AND company_id='.$this->company_id.' AND is_show=1'; //文章条件
             $this->com_table_where='1 AND a.is_show=1'; //带命名文章条件
             $this->banner_where='1 AND company_id=0 '; //图片广告
             cookie('c_company_id',0,3600*24);
             cookie('quan',1,3600*24);

         }else{
    
           
            $company_id = $this->geturlcompany($domain); //获取二级域名公司
        }
        if($company_id==-1)
        {

             $this->company_id=0;//0为全国
             $this->com_where='1 AND is_show=1'; //文章条件
             $this->com_table_where='1 AND a.is_show=1'; //带命名文章条件
             $this->banner_where='1 AND company_id=0 '; //图片广告
             cookie('c_company_id',0,3600*24);
             cookie('quan',1,3600*24);
        }

        if($company_id>0)
        {
            $this->company_id=$company_id;//0为全国；

                   //记录地区id
           // $this->setcompanyid($company_id);
            if(!$_COOKIE['c_company_id'] || $company_id!=$_COOKIE['c_company_id']){
                 cookie('c_company_id',$company_id,3600*24);
            }    

             $this->com_where=' 1 AND company_id='.$this->company_id.' AND is_show=1'; //文章条件
             $this->com_table_where=' 1 AND a.company_id='.$this->company_id.' AND a.is_show=1'; //带命名文章条件
            $this->banner_where=' 1 AND company_id='.$this->company_id; //图片广告
            $this->company_sort ='f_sort_order asc,add_time desc';
             $this->company_table_sort ='a.f_sort_order asc,add_time desc';
            $this->company_recommend ='f_is_recommend=1';
        }
        elseif($_COOKIE['c_company_id']>0)
        {
            $this->company_id=$_COOKIE['c_company_id'];//0为全国；
            $this->com_where=' 1 AND company_id='.$this->company_id.' AND is_show=1'; //文章条件
            $this->com_table_where=' 1 AND a.company_id='.$this->company_id.' AND a.is_show=1'; //带命名文章条件
            $this->banner_where=' 1 AND company_id='.$this->company_id; //图片广告
            $this->company_sort ='f_sort_order asc,add_time desc';
             $this->company_table_sort ='a.f_sort_order asc,add_time desc';
            $this->company_recommend ='f_is_recommend=1';

        }

        //重新定义城市名及城市数据
        if($this->company_id>0)
        {
           $this->company_info =$this->getcompanyinfo($this->company_id);
           $this->ipcity =$this->getareainfo($this->company_info['c_city']);
           $this->companydata = $this->getcompany_domain($this->company_info['c_city']); //查询所在地区的分公司


        }
        $this->assign('quan', $_COOKIE['quan']);

        //重新定义网站信息
         $info           = M("webinfos")->where('w_companyid='.$this->company_id)->find();
		 
		 /***推广区分参数URL设置开始***/
			if(isset($_SESSION['qf'])){
				//如果有缓存的时候
				$qf = $_SESSION['qf'];
				$tgqf = M("tgqf")->where("shibie='$qf'")->find();
				//$sql = M('tgqf') -> getLastSql();
				//dump($qf);
				$data = json_decode($info['w_data'], true);
				$data['tel'] = $tgqf['tel'];
				$data['kefu'] = $tgqf['kefupc'];
				$data['kefuwap'] = $tgqf['kefuwap'];
				$info['w_data'] = json_encode($data);
			}else{
				//如果缓存不存在的时候
				if(!empty($_GET['qf'])){
				$_SESSION['qf'] = $_GET['qf'];
				$qf = $_SESSION['qf'];
				$tgqf = M("tgqf")->where("shibie='$qf'")->find();
				//$sql = M('tgqf') -> getLastSql();
				//dump($qf);
				$data = json_decode($info['w_data'], true);
				$data['tel'] = $tgqf['tel'];
				$data['kefu'] = $tgqf['kefupc'];
				$data['kefuwap'] = $tgqf['kefuwap'];
				$info['w_data'] = json_encode($data);
				}
			}
			
		/***推广区分参数URL设置结束***/
        $this->site_info = json_decode($info['w_data'],true);
		//dump($this->site_info);die;
        preg_match_all('/<a[^>]+>[^>]+a>/',$this->site_info['links'],$aout);

        $this->arr_links=array_chunk($aout[0],5);

       // print_R($this->site_info);

        //读取总站网站信息
         $com_info           = M("webinfos")->where('w_companyid=0')->find();
		 
		 /***推广区分参数URL设置开始***/
			if(isset($_SESSION['qf'])){
				$qf = $_SESSION['qf'];
				$tgqf = M("tgqf")->where("shibie='$qf'")->find();
				//$sql = M('tgqf') -> getLastSql();
				//dump($qf);
				$data = json_decode($com_info['w_data'], true);
				$data['tel'] = $tgqf['tel'];
				$data['kefu'] = $tgqf['kefupc'];
				$data['kefuwap'] = $tgqf['kefuwap'];
				$com_info['w_data'] = json_encode($data);
			}else{
				if(!empty($_GET['qf'])){
				$_SESSION['qf'] = $_GET['qf'];
				$qf = $_SESSION['qf'];
				$tgqf = M("tgqf")->where("shibie='$qf'")->find();
				//$sql = M('tgqf') -> getLastSql();
				//dump($qf);
				$data = json_decode($com_info['w_data'], true);
				$data['tel'] = $tgqf['tel'];
				$data['kefu'] = $tgqf['kefupc'];
				$data['kefuwap'] = $tgqf['kefuwap'];
				$com_info['w_data'] = json_encode($data);
				}
			}
			
		/***推广区分参数URL设置结束***/
		
        $this->site_info_com = json_decode($com_info['w_data'],true);
		//dump($this->site_info_com);die;
        //热门搜索
        $search_info = M("webinfos")->where('w_companyid=0')->find();
        $search_info = json_decode($search_info['w_data'],true);
        $this->search_info=explode(',',$search_info['search']);

         /************************省份数据*****************************/
        $this->provincelist      = M('area')->where('level=1')->select();

        /*companydata
        if(!empty($companydata))
        {
            $this->company_id=0;//0为全国；
            //$this->com_where=' company_id='.$this->company_id;
            $this->com_where=' 1 ';
        }else
        {
            
            $this->company_id=0;//0为全国
            $this->com_where='1';
        }*/

        //年
        $this->rightcase = M("Article")->where($this->com_where.' and cat_id=16')->order('counts desc,add_time desc')->limit(10)->select();

        $this->Year     = date('Y', time());
		
		
		
		
    }


     public function _empty(){
        // 空控制器和空操作
		
       // $this -> display();        //会自动调用配置里的 404 页面设置
    }
	
	
	
    //子孙树
    public function subCat($cat_id,$model='articlecat',$includeself=false){
        $cat_list = M($model)->where(array('parent_id'=>$cat_id))->order('sort_order asc')->select();
        $tree=array();
        foreach($cat_list as $cat){
            if($cat['parent_id'] == $cat_id){
                $cat['sub_cat'] = $this->subCat($cat['cat_id'],$model);
                $tree[$cat['cat_id']]=$cat;
            }
        }
        if($includeself){
            $temp = M($model)->where(array('cat_id'=>$cat_id))->find();
            $temp['sub_cat'] = $tree;
            $tree = $temp;
        }
        return $tree;
    }

    public function setcompanyid($company_id)
    {
     setcookie("c_company_id",$company_id, time()+3600*24);
    }
    //查询获取公司列表
    public function getcompany($a_id)
    {
        $company  = M('company')->where('c_city='.$a_id)->select();
        return $company;

    }
       //查询获取二级域名公司列表
    public function getcompany_domain($a_id)
    {
        $company  = M('company')->where('c_city='.$a_id.' and c_domain!=""')->order("c_sort asc")->select();
        return $company;

    }
    //查询获取公司详情
       public function getcompanyinfo($c_id)
    {
        $company  = M('company')->where('c_id='.$c_id)->find();
        return $company;

    }
    //查询获取城市
    public function getareainfo($a_id)
    {
        $area  = M('area')->where('a_id='.$a_id)->find();
        return $area;

    }
    //查询对应的地区
        public function citysublist($parent_id,$level)
    {
        if($level==2){
          $data = M()->table('tp_area')->where(" a_parentid=".$parent_id.' and level=2')->select();//城市数据
        }
        elseif($level==3){
          $data = M()->table('tp_area')->where(" parent_id=".$parent_id.' and level=3')->select();//地区
        }
        return $data;

    }

       //代码如下:
    public function getUrlRoot(){
        $domain = $_SERVER['HTTP_HOST'];  
        $host=explode('.',$domain);
        return $host[0];


    }
    //二级域名获取公司
    public function geturlcompany($domain)
    {

       

         if(!empty($domain)){
                $where = "c_domain = '$domain'";
                $company  = M('company')->where($where)->find();
                if($company){
                //记录地区id

                return $company['c_id'];
               }
               else
               {
                 return 0;
               }
                
         }

        return 0;
        exit;

    }

    //获取当前用户ip
  public function getip_out(){ 
     $ip=false;
      if(!empty($_SERVER["HTTP_CLIENT_IP"])){
       $ip = $_SERVER["HTTP_CLIENT_IP"];
      }
      if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
       if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
       for ($i = 0; $i < count($ips); $i++) {
       if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
       $ip = $ips[$i];
       break;
       }
     }
     }
     return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
 } 

 /*  public function getIPLoc_sina($queryIP){ 

    $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP; 
    // $url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP; 

    $ch = curl_init($url); 

    //curl_setopt($ch,CURLOPT_ENCODING ,'utf8'); 

    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回 

    $location = curl_exec($ch); 

    $location = json_decode($location); 

    curl_close($ch); 

     

    $loc = ""; 

    if($location===FALSE) return ""; 

    if (empty($location->desc)) { 

        $loc = $location->province.$location->city.$location->district.$location->isp; 

    }else{ 

        $loc = $location->desc; 
    } 
    return $location->city.$location; 

}  */
/* public function getIPLoc_QQ($queryIP){ 
    $url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP; 
    echo $url;exit;
    $ch = curl_init($url); 
    curl_setopt($ch,CURLOPT_ENCODING ,'gb2312'); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回 
    $result = curl_exec($ch); 
    $result = mb_convert_encoding($result, "utf-8", "gb2312"); // 编码转换，否则乱码 
    curl_close($ch); 
    preg_match("@<span>(.*)</span></p>@iU",$result,$ipArray); 
    $loc = $ipArray[1]; 
    return $loc; 
} 
 */
 public function updatebannerstatus(){ 
           
    $data['is_shelves']   = 1;
    $upwhere = 'cat_id in (2,3,4,5) and up_time<='.time().' and up_time>0';
    $updateId=M("ads")->where($upwhere)->save($data);

    $data['is_shelves']   = 2;
    $upwhere = 'cat_id in (2,3,4,5) and down_time<='.time().' and down_time>0';
    $updateId=M("ads")->where($upwhere)->save($data);

    //$this->banner_list      = M('ads')->where('cat_id=2 and cat_id=3 and cat_id=4 and cat_id=5')->order('ads_id asc')->select();
     
 } 
}

/* function returnhead($data){

      foreach($data as $key=>$val){
        if(!empty($val['head'])){
        $pos = strpos($val['head'],"ttp");

            if(!$pos)
            {
               $data[$key]['head']="/".$val['head'];

            }
        }
    }

    return $data;

} */
 function returnhead1($data,$k="")
{
   //$k=!empty($k)?$k:'original_img';
        if(!empty($data)){
        $pos = strpos($data,"ttp");

            if(!$pos)
            {
               $data="/".$data;

            }
        }
        return $data;
}



