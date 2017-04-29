<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\DateInput;
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

        ['attribute' => 'state','options' => ['width' => '80px;']],
       [
            'attribute' => 'createtime',
            'value'     => function ($data) {
              return date('Y-m-d H:i',$data->createtime);

            },
            'filter'    => DateInput::widget(['attribute' => 'createtime', 'model' => $searchModel]),
            'options'   => ['width' => '140px;'],
        ],


            ['class' => 'yii\grid\ActionColumn','options' => ['width' => '100px;']],
            ['format'=>'raw',
             'value'=>function($model){
             	if($model->state=='done'){
                   return '已受理';
             	}
               $url = Yii::$app->urlManager->createUrl(['genelist-order/done', 'id' => $model->id]);
                return "<a class='btn btn-xs btn-success' href='$url'>受理</a>";
            },
            'options' => ['width' => '60px;']
            ]
        ],
    ]); ?>
</div>
