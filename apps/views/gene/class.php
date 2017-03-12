<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');
?>

<h1><?=$classname?> 大类</h1>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);


//var_dump($model);
$listData = ArrayHelper::map($infolist,'id', 'class');
$model = $infolist[0];
//var_dump($listData);

 
 echo $form->field($model, 'class')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' ,'onchange'=>'cc']
 	  ); 
 

 
 ActiveForm::end();
 ?>

 <script>
$('#information-class').change(function(){ 
	var key = ($(this).val());
	location.href= "?r=gene/subclass&subclass="+key;

});
 </script>