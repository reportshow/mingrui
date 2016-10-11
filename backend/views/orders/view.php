<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-order-view"> 

    <p>
        <?= Html::a('修改/指派', ['update', 'id'           => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'doctor',
            'mydoctor.name',
            'mydoctor.tel',
            'mydoctor.hospital.name',
            'createtime',
            'statustxt:raw',
            'assigned',
            'notes:ntext',
        ],
    ]) ?>

</div>

<style type="text/css">
    .table{width: 60%}
</style>