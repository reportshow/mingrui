<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

$this->title = $mainclass->name;

include_once('header.php');
?>

<h1><?=$this->title?> 大类</h1>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);


//var_dump($model);
$listData = ArrayHelper::map($infolist,'id', 'class');
$model = $infolist[0];
//var_dump($listData);

 
 echo $form->field($model, 'class')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' /*,'onchange'=>'cc'*/
 	     ]
 	  ); 
 

 
 ActiveForm::end();
 ?>

 <br>搜相关中文名
  <div class="input-group  ">
    <input type="text"   name='keyword' placeholder='搜相关中文名'  class="form-control">
        <span class="input-group-btn">
          <button type="button" class="btn btn-info btn-flat"  id='search'>搜相关中文名</button>
        </span>
  </div>
 

案例：

 <script>
$('#information-class').change(function(){ 
	var key = ($(this).val());
	location.href= "?r=gene/subclass&subclass="+key;
});

$('#search').click(function(){ 
	var keyword = $("input[name='keyword']").val();
	location.href= "?r=gene/subclass2&key=<?=$mainclass->classname?>&keyword="+keyword;
});

 </script>