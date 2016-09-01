<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiDocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '案例分享';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-doc-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建案例', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            'doc',
            'createtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
