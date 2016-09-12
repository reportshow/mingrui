<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\TimeLine;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiNoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '记事本';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-notes-index">
     <p style="text-align: right;padding-right:26px; ">
        <?= Html::a(' <i class="fa  fa-edit"></i>新建记事  ', ['create'], ['class' => 'btn btn-social btn-danger']) ?>
    </p>
    <?=TimeLine::widget(['dataProvider'=>$dataProvider]); ?>

     
</div>
