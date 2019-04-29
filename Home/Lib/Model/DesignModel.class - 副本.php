<?php

class DesignModel extends Model {
	

      public function list_special_style_data($article_list)
    {
         foreach($article_list as $k=>$v)
         {
         	if(!empty($v['special_style'])){
         			$special_style_arr = json_decode($article_list[$k]['special_style'],true);

         			$special_style_ids = implode(',',$special_style_arr);
                    $comcatdata =M('comcat')->where("com_id in ($special_style_ids)")->select();
         			$special_style_data[$v['article_id']] =$comcatdata;
         	}

         }

         return $special_style_data;
    }	

       public function one_special_style_data($article)
    {
  
            if(!empty($article)){
                    $special_style_arr = json_decode($article['special_style'],true);

                    $special_style_ids = implode(',',$special_style_arr);
                    $comcatdata =M('comcat')->where("com_id in ($special_style_ids)")->select();
                    $special_style_one =$comcatdata;
            }

         

         return $special_style_one;
    }   


}

?>
