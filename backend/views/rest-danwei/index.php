<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestDanweiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '合作医院';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-danwei-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('添加 合作医院', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'id',
            'options'   => ['width' => '60px;'],
        ],
        'name',
        'sales_id',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>
</div>
