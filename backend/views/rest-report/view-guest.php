<?php

use backend\widgets\Comments;
use backend\widgets\Summary;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/site/index-guest-top'); 

?>
<div class="rest-report-view">

<div class="row"><!--row-->
    <div class="col-md-4">
      <?php
         echo Summary::widget(['model'=>$model]); 

      ?>
   </div>
   <div class="col-md-8"> 
      <?=Html::jsFile('@web/js/pdfobject.min.js')?>

      <div id="example1"></div> 
      <script>
      PDFObject.embed("<?=$model->pdfurl ?>", "#example1");
      /*PDFObject.embed("upload/NG16010024.pdf", "#example1");*/
      </script>
      <style>
      .pdfobject-container { height: 600px;}
      .pdfobject { border: 1px solid #666; }
      </style>
     
   </div>
</div><!--/row-->



</div>
 
