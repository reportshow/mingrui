<?php

use backend\widgets\Comments;
use backend\widgets\Summary;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\PdfShow;
/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('/site/index-guest-top'); 

?>
<div class="rest-report-view">

<div class="row"><!--row-->
    <div class="col-md-4">
      <?= Summary::widget(['model'=>$model]);       ?>
   </div>
   <div class="col-md-8"> 
      <?=PdfShow::widget(['pdfurl'=>$model->pdfurl]);?>
     
   </div>
</div><!--/row-->



</div>
 
