<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');

$this->title = $model->class;

?>
<style>
	td{padding:8px 5px; overflow: hidden;text-overflow:ellipsis;
		/*white-space:nowrap;*/
	  max-width: 200px}
	tr{cursor:pointer;} 
 .keybg{background:#606}
 </style>
 

<div class="row"><div class="col-md-4">
<?php

 


 
 echo "<table class='table table-striped table-bordered'>";
 echo "<tr> <th class=ellipsis>疾病名 </th> <th>英文</th> <th>基因</th> <th>DM</th> </tr>";
 foreach ($infolist as   $m) {
 	    $sick = str_replace($keywords, '<i class=keybg>' . $keywords.'</i>', $m->sick);


 	 $sick_en = $m->sick_en;
 	 $gene = $m->gene;
 	 $id = $m->id;
 	 $dm = $m->DM; 
 	 echo "\n <tr onclick='showsub($id)'> <td class=ellipsis>$sick </td> <td>$sick_en</td> <td>$gene</td> <td>$dm</td> </tr>";
 }
 echo "</table>";


/*
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);

 $listData = ArrayHelper::map($infolist,'id', 'sick');
$model = $infolist[0]; 
 echo $form->field($model, 'sick')->dropDownList(
 	     $listData,  ['prompt'=>'选择产品...' ,'onchange'=>'cc']
 	  ); 
  
 
 ActiveForm::end();
 */
 ?>
</div></div>



 <script>
 function showsub(id){  
	location.href= "?r=gene/subinfo&subid="+id;

}
 </script>