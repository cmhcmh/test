<?php
class DownloadAction extends CommonAction {
	public function __construct() {
		parent::__construct();
	}

    public function index() {
        //导航索引ID
        $this->nid = 1;
        $cat_id=5;
        $cat_info=M('articlecat')->where('cat_id='.$cat_id)->find();
        //网站标题 关键字 描述
        $this->site_title       = $cat_info['cat_name']?$cat_info['cat_name']: $this->site_info['title'];
        $this->site_keywords    =$cat_info['keywords']?$cat_info['keywords']: $this->site_info['keyword'];
        $this->site_description = $cat_info['cat_desc']?$cat_info['cat_desc']:$this->site_info['description'];
        
        /************************轮播图*****************************/
        $this->banner           = M('ads')->where("cat_id=3 and title='文件下载'")->order('ads_id asc')->getField('original_img');
        // print_r($this->banner_list);die;

        // $this->download=M('article')->where('cat_id='.$cat_id)->select();

        //数据分页
        $where="is_open=1 and cat_id=".$cat_id;
        // echo $where;
        $limit      = $this->limit? $this->limit : 10;

        import('ORG.Util.Page2');// 导入分页类
        $count      = M('article')->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
        $Page       = new Page($count,$limit);// 实例化分页类 传入总记录数
        $Page->setConfig('theme',$this->pageTheme);

        $show       = $Page->show();
        $this->assign('page',$show);

        $this->download = M('article')->where($where)->order(SO)->limit($Page->firstRow.','.$Page->listRows)->select();
        
    
        $this->assign('totalPage',ceil($count/$limit));

        $this->display();
    }
}
?>