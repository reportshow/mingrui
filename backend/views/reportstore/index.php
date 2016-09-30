<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiReportstoreResearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '外源报告';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-reportstore-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('上传外源报告', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

             [
               'attribute'   => 'id','value'   => 'id',
               'headerOptions' => ['width' => '60']
            ],
            'uid',
            'sick',
            'product',
            'tel',
              'diagnose:ntext',
            // 'attachements:ntext',
            // 'createtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
