<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');

$this->title = $model->name;

?>
<h1> <?=$this->title ?> </h1>
<?php
 
 if(strlen($model->detail) > 3){ 
    echo $model->detail;
 }else{ 
 	 echo $model->description;
 }
 


/*/
 $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);

 echo $form->field($model, 'name')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' ,'onchange'=>'cc']
 	  ); 
  
 ActiveForm::end();

 */
 ?>
 
 