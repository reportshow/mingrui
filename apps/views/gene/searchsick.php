<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;


include_once('header.php');

if(!is_array($keywords)) $keywords = [$keywords];
$tag = $type!='gene' ? '基因的相关表型' :'表型的相关基因';

$this->title = strtoupper( join(' ',$keywords))  .' ' .$tag;




    if(!is_array($models)  ){

       echo " <div class='row'>没有相关数据</div>";
       return;
    }

    $orderedList = [];

    foreach ($models as $index => $info) {

	    $info->chpo = HighLight( 'CHPO表型:  &nbsp;'.$info->chpo, $keywords);

	    $models[$index] = $info;

	    $orderedList[$index] = $count;

   }

   if(count($keywords) > 1){
     arsort($orderedList);
   }




function HighLight($chpo, $keywords){
    $count = 0;
        foreach ($keywords as $key ) {
            if(strpos('=='.$chpo,$key) > 0){
                $chpo = str_replace($key , '<i class=keybg>' . $key .'</i>', $chpo);
                $count++;
            }
       }
        if($count == count($keywords) && $count >1){
           $chpo = "<b class='fa  fa-graduation-cap text-red' style='font-size:18pt'> </b>  " . $chpo ;
        }

    return $chpo;

}
?>

 <style type="text/css">
 .keybg{background:#ff9}
 </style>

 <div class="row">
		<div class="col-md-4">
          <div class="box box-blue box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">疾病搜索</h3></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <ul class="nav nav-stacked"> <?php
              if(count($models) < 1) {
              	echo "没有相关数据";
              }else{
                foreach ($orderedList as $key => $count) {
                    $info = $models[$key];


					$url = Yii::$app->urlManager->createUrl(['gene/subinfo-bygene', 'gene' => $info->gene ]) ;
                	?>
		            <li style="display:block;border:none">
		               <a href="<?=$url?>"> <?=$info->gene ?> <span class="pull-right"> <?=$info->diseaseID ?> </span></a>
		            </li>
		            <li style="padding:0px 5px 15px 15px;color:#666;">
		               <a href="<?=$url?>">  <?= $info->chpo ?></a>
		            </li>


             <?php

                }//for
             }//if
              ?>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>



 <script>
 function showsub(id){
	location.href= "?r=gene/subinfo&subid="+id;

}
 </script>