<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');

$this->title = '金准产品结构信息';

?>
<h1>金准产品结构信息</h1>
<?php
//var_dump($model);
$listData = ArrayHelper::map($modellist,'classname', 'name');
$model = $modellist[0];
//var_dump($listData);

 $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);

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