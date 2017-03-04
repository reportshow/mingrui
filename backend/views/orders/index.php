<?php

use backend\models\MingruiOrder;
use yii\grid\GridView;
use yii\helpers\Html;
use backend\widgets\DateInput;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '订单列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-order-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);
     ?>

    <p>
        <?=Html::a('新建订单', ['create'], ['class' => 'hide btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '40']],

        ['attribute' => 'id', 'options' => ['width' => '60']],
        ['attribute' => 'docotr_name', 'label' => '医生姓名', 'value' => 'mydoctor.name', 'options' => ['width' => '100']],
        ['attribute' => 'doctor_tel', 'label' => '联系方式', 'value' => 'mydoctor.tel','options' => ['width' => '160']],
        ['attribute'=>'doctor_area','label' => '医院','value' =>'mydoctor.hospital.name' ],
        ['attribute'=>'createtime',
         'filter'    => DateInput::widget(['attribute' => 'createtime', 'model' => $searchModel]),
         'options' => ['width' => '180']
         ],
        ['attribute' => 'status',
            'filter'     => MingruiOrder::$statutText,
            'format'     => 'raw',
            'value'      => 'statustxt',
            'options' => ['width' => '100']
        ], 
        ['attribute' =>'assigned',
        'options' => ['width' => '100']
        ],
        // 'notes:ntext',

        ['class' => 'yii\grid\ActionColumn','options' => ['width' => '100']],
    ],
]);?>
</div>
