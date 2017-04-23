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
 
 
<?php

 


  
 //echo "<tr> <th class=ellipsis>疾病名 </th> <th>英文</th> <th>基因</th> <th>DM</th> </tr>";
 foreach ($infolist as   $m) {
        $sick =   $m->sick ;
        $count = 0;
 	    if(is_array($keywords)){
 	    	foreach ($keywords as $key ) {
	 	    	if(strpos('=='.$sick,$key) > 0){ 
					$sick = str_replace($key , '<i class=keybg>' . $key .'</i>', $sick);
					$count++;
	 	    	} 
 	       }
 	       if($count == count($keywords) ){ 
               $sick = "<font color='#ee0'> $sick </font>";
 	       }
 	   }
 	    


 	 $sick_en = $m->sick_en;
 	 $gene = $m->gene;
 	 $id = $m->id;
 	 $dm = $m->DM; 

 	// echo "\n <tr onclick='showsub($id)'> <td class=ellipsis>$sick </td> <td>$sick_en</td> <td>$gene</td> <td>$dm</td> </tr>";

 	 ?>

 <div class="row">
    <div class="col-md-4" onclick='showsub(<?=$id ?>)'>
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
           <b class='btn btn-success pull-right'><?=$gene?></b>
          <!-- /.widget-user-image -->
          <h4 class="widget-user-username-x"><?=$sick?></h4>
          <h5 class="widget-user-desc-x"><?=$sick_en?></h5>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked"> 
            <li><a href="#">DM <span class="pull-right badge-x bg-red-x"><?=$dm ?></span></a></li>

          </ul>
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
</div>


 	 <?
 }
 //echo "</table>";
//echo "</ul>";

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