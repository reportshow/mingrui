<?php

use common\components\Statistics;

$catch = Statistics::getCache('statistics'); ;
$menu = require "../views/layouts/left-admin.php";
  


global $labels; $labels = [];
 getLabel($menu );
 
echo "<h2>模块统计</h2> 
<section class='content col-lg-12 ' style='height:120px;background:#fff;'>
<div style='max-width:900px'>";
foreach ($labels as $key => $item) {
		$label = $item['label'];
		$icon ='';
		if(!empty($item['icon'])) $icon = $item['icon'] ;
	  $key = substr($key,1);
	  $count = 0;
	  if(!empty($catch[$key])){ 
	  	 $count = $catch[$key];
	  }

	  echo "<div class='col-md-3 '><i class='{$icon}'></i> {$label} : <b> $count </b></div>";
	 
}
echo "</div></section>";

function getLabel($menus){ 
   global $labels;

   foreach ($menus as   $item) {
   		if(empty($item['url'])) continue;


		 $url = $item['url'];
		 if(is_array($url)){ 
		 	$key = $url[0];
		 	$labels[$key] = $item;//['lable'=>$item['label'], 'icon'=>$item['icon']]; 
		 	continue;
		 }
		 if(!empty($item['items']) && count($item['items']) >0){ 
		 	   getLabel($item['items']);
		 }

	}  

}