
<br><br><br>本类案例：<ul style="padding-left:14px">
 <?php


foreach ($caselist as $key => $case) {
	 $url = Yii::$app->urlManager->createUrl(['gene/showcase', 'caseid' => $case->id ]) ;
	echo "<li ><a href='$url' style='color:#fff'>" . $case->title .'</a></li>';
}

 ?>
 </ul>