<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;


$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);


//var_dump($model);
$listData = ArrayHelper::map($modellist,'classname', 'name');
$model = $modellist[0];
//var_dump($listData);

 
 echo $form->field($model, 'name')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' ,'onchange'=>'cc']
 	  ); 
 

 
 ActiveForm::end();
 ?>

 <script>
$('#mainlist-name').change(function(){ 
	var key = ($(this).val());
	location.href= "?r=gene/class&class="+key;

});
 </script>