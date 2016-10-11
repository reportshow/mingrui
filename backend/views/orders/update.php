<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiOrder */

$this->title = '订单: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = '修改状态';
?>
<div class="mingrui-order-update">
 

    <?= $this->render('_update', [
        'model' => $model,
    ]) ?>

</div>
