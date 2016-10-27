<?php

use yii\grid\GridView;
use yii\helpers\Html;
use backend\models\MingruiPingjia;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiReportstoreResearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '外源报告';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-reportstore-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?=Html::a('上传外源报告', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '40']],

        'id',
        'uid',
        'sick',
        'product',
        'tel',
        'diagnose:ntext',
        'gene',
        ['attribute' => 'pingjia',
            'filter'     => MingruiPingjia::getSimpleArray(),
         'value'=>function($model){
            return $model->pingjia ? $model->pingjia : '-';
         }],
        // 'attachements:ntext',
        // 'createtime',

        ['class' => 'yii\grid\ActionColumn',
        'filterOptions'=>['data-toggle'=>'gridviewoprator'],
        ],
    ],
]);?>
</div>
