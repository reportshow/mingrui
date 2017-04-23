<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel apps\models\GenelistOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '基因分类之订单';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genelist-order-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('下单', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'id','options' => ['width' => '60px;']],
            'name',
            'tel',
            'city',
            'state',
            ['attribute' => 'createtime',
			'format' =>  ['date', 'php:Y-m-d h/i','currencyCode' => 'PRC',]
			], 
           // 'createtime',
             

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
