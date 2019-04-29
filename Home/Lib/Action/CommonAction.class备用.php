<?php
// 公共类
class CommonAction extends Action {
    protected $site_config = null;
    public function __construct() {
              
        header('Content-Type:text/html; charset=utf-8');
        $site_config = include WEB_ROOT . 'Common/systemConfig.php';
            $this->host_domain="hxdec.com";
            $this->host='www.hxdec.com';
         $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
         // header("Location: /mobile.php");//访问手机版

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
		//$this->logo=M('ads')->where('cat_id=5')->select();
        //底图推荐
        $this->tuijian=M('ads')->where('cat_id=6')->select();
        //公司简介
		//$this->intro=M('articlecat')->where('parent_id=1')->select();
        //新闻动态
        //$this->news=M('articlecat')->where('parent_id=2')->order('sort_order asc,cat_id asc')->select();
        //产品展示
        //$this->product=M('goodscat')->where('parent_id=0')->order('sort_order asc,cat_id asc')->select();
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

        //来源页
        $this->back_url = $_SERVER['HTTP_REFERER'];
        if(strpos($this->back_url, 'logout') || strpos($this->back_url, 'change_password')) $this->back_url = '/';

        //用户信息
        $userInfo = session('userInfo');
        if(empty($userInfo)){
            $user_id = cookie('user_id');
            if($user_id) $this->update_userInfo($user_id);
        }
        //if(empty($userInfo['head'])) $userInfo['head'] = "Public/Home/images/defaulthead.gif";
        $this->assign('userInfo', $userInfo);

        //所有分类
        $this->all_cats = $this->subCat(0);
       // print_r($this->all_cats);

        //获取ip
        $getip_out = $this->getip_out();
       // $getip_out="59.41.202.57";
        $getIPLoc = $this->getIPLoc_sina($getip_out);
       //$getIPLoc_QQ="59.41.202.57";
       //$getIPLoc_QQ= $this->getIPLoc_QQ($getIPLoc_QQ);
      // var_dump( $getIPLoc_QQ);
        //$ip=file_get_contents("http://fw.qq.com/ipaddress");
       // print_R($ip);

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
        $this->com_where='1 AND is_show=1'; //文章条件
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
             $this->com_where='1 AND is_show=1'; //文章条件
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
        $this->site_info = json_decode($info['w_data'],true);

        preg_match_all('/<a[^>]+>[^>]+a>/',$this->site_info['links'],$aout);

        $this->arr_links=array_chunk($aout[0],5);

       // print_R($this->site_info);

        //读取总站网站信息
         $com_info           = M("webinfos")->where('w_companyid=0')->find();
        $this->site_info_com = json_decode($com_info['w_data'],true);

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
        // 这样写就够了
         header("Location: /index.php");
       // $this -> display();        //会自动调用配置里的 404 页面设置
    }
	
	

    //检查是否登录
    public function check_login(){
        $userInfo = session('userInfo');
        if(!$userInfo){
            echo "<script>location.href='". U('User/login') ."';</script>";
            exit;
        }
    }

    //家谱树
    public function supCat($cat_id,$includeself=true,$model = 'articlecat'){
        $tree = array();
        $url = array();
        while($cat_id){
            $cat = M($model)->where(array('cat_id'=>$cat_id))->find();
            $tree[] = $cat;
            $cat_id = $cat['parent_id'];
        }
        if(!$includeself)array_shift($tree);
        return array_reverse($tree);
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

    //查找子孙树2
    public function subCat2($model='articlecat',$list,$cat_id=0,$includeself=false,$level=0){
        $level++;
        $tree = array();
        foreach($list as $key=>$value){
            if($value['parent_id']==$cat_id){
                $value['level'] = $level;
                $tree[] = $value;
                $tree = array_merge($tree,$this->subCat2($model,$list,$value['cat_id'],false,$level));
            }
        }
        if($includeself){
            $temp = M($model)->where(array('cat_id'=>$cat_id))->find();
            array_unshift($tree, $temp);
        }
        return $tree;
    }


    //子类ID
    public function sub_cat_ids($cat_id,$model='articlecat',$array=false){
        $sub_cat_tree = is_array($cat_id)? $cat_id : $this->subCat($cat_id,$model);
        $cat_ids = $this->get_sub_cat_ids($sub_cat_tree);
        array_unshift($cat_ids, $cat_id);
        return $cat_ids?($array? $cat_ids : implode(',',$cat_ids)) : ($array? array($cat_id) : $cat_id);
    }

    //递归求子类cat_id
    private function get_sub_cat_ids($sub_cat_tree){
        $cat_ids = array();
        foreach($sub_cat_tree as $value){
            $cat_ids[] = $value['cat_id'];
            if($value['sub_cat'])$cat_ids = array_merge($cat_ids,$this->get_sub_cat_ids($value['sub_cat']));
        }
        return $cat_ids;
    }

    //搜索中转
    public function search(){
        $keyword    = trim($_REQUEST['keyword']);
		$url        = U('Info/search', array('keyword'=>$keyword));
        exit("<script>location.href = '$url';</script>");
    }

    //友情链接
    public function get_friendly_link(){
        $link_str = $this->site_config['OTHER']['friendly_link'];
        $link_arr = explode("\n",$link_str);
        $friendly_link = array();
        foreach($link_arr as $key=>$value){
            $arr = explode('|',$value);
            $friendly_link[$key]['name'] = $arr[0];
            $friendly_link[$key]['link'] = $arr[1]; 
        }
        return $friendly_link;
    }

    //网站地图
    public function sitemap(){
        //banner图
        $this->banner = M('ads')->where("ads_id=15")->find();
        $all_cats = $this->subCat(0,'articlecat');
        $this->all_cats = $all_cats;
        $this->display('Public:sitemap');
    }

    
  
    /**
      +----------------------------------------------------------
     * 文件上传
      +----------------------------------------------------------
     */
    function upload($allowExts=array('jpg', 'gif', 'png', 'jpeg'),$savePath,$saveRule,$thumb=false,$thumbPath,$thumbMaxWidth,$thumbMaxHeight,$thumbPrefix){
        import("ORG.Util.UploadFile");
        import("ORG.Util.File");
        $upload = new UploadFile(); // 实例化上传类 
        if(!is_dir($savePath)){
            File::make_dir('./'.$savePath);
        }
        $smPath = explode(',',$thumbPath);
        foreach($smPath as $key => $value){
            if(!is_dir($value)){
                File::make_dir('./'.$value);
            }
        }
        
        $upload->maxSize = 3145728 ; // 设置附件上传大小 
        $upload->allowExts = $allowExts; // 设置附件上传类型 
        $upload->savePath = $savePath; // 设置附件上传目录 
        $upload->saveRule = $saveRule; // 上传文件的保存规则 
        $upload->thumb = $thumb; // 是否需要对图片文件进行缩略图处理，默认为false       
        $upload->thumbPath = $thumbPath;  //缩略图的保存路径，留空的话取文件上传目录本身
        $upload->thumbMaxWidth = $thumbMaxWidth;   //缩略图的最大宽度，多个使用逗号分隔
        $upload->thumbMaxHeight = $thumbMaxHeight;   //缩略图的最大高度，多个使用逗号分隔
        $upload->thumbPrefix = $thumbPrefix;   //缩略图的文件前缀，默认为thumb_  （如果你设置了多个缩略图大小的话，请在此设置多个前缀）
        // $upload->autoSub=true;   //是否使用子目录保存上传文件
        // $upload->subType='date';
        //$upload->is_fixed = true;   //是否生成固定比例的缩略图
        
        
        if(!$upload->upload()) { // 上传错误 提示错误信息 
            $this->error($upload->getErrorMsg(), $this->back_url);
        }else{ // 上传成功 获取上传文件信息 
            $info = $upload->getUploadFileInfo(); 
        }
        
        return $info;
    }

    //下载附件
    public function download($file_name=''){
        $file_name = base64_decode($file_name);
        $file_name = iconv('utf-8', 'gbk', $file_name);
        $file_dir = 'Uploads/download/';
        $file = fopen($file_dir . $file_name,"r"); // 打开文件
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length: ".filesize($file_dir . $file_name));
        Header("Content-Disposition: attachment; filename=" . $file_name);
        // 输出文件内容
        echo fread($file,filesize($file_dir . $file_name));
        fclose($file);
        exit;
    }

    //更新用户信息
    public function update_userInfo($user_id=0){
        if(!$user_id) $user_id = $this->userInfo['user_id'];
        $userInfo = M('users')->find($user_id);
        $userInfo['city_name'] = M('region')->where("region_id=".$userInfo['city'])->getField('region_name');
        session('userInfo',$userInfo);
        session('user_id' ,$userInfo['user_id']);
        session('user_name' ,$userInfo['user_name']);
    }

    //查询获取地区
    public function iparea($search_city)
    {
        if($search_city==1)
        {
            //表示已经访问过ip百度接口
            setcookie("cookie_search_city",'1', time()+3600*24);
        }
       
        //$city=isset($_REQUEST['ipcity'])?addslashes(htmlspecialchars($_REQUEST['ipcity'])):'';
        $city = $search_city;
         if(!empty($city)){
                $where = "area_name like '%$city%'";
                $area  = M('area')->where($where)->find();
                //记录地区id
                setcookie("cookie_a_id",$area['a_id'], time()+3600*24);
                return $area;
                
         }

        return false;
        exit;

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

  public function getIPLoc_sina($queryIP){ 

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

} 
public function getIPLoc_QQ($queryIP){ 
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

function returnhead($data){

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

}
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

