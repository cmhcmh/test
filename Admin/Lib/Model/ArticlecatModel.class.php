<?php

class ArticlecatModel extends Model {
	/**
      +----------------------------------------------------------
     * 文章分类列表
      +----------------------------------------------------------
     */
    public function listArticlecat($pid=0,$prefix) {
		$catList=get_article_categories_tree($pid,$prefix);
		return $catList;               //获取分类结构
    }
}

?>
