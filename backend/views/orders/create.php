<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiOrder */

$this->title = '新建订单';
$this->params['breadcrumbs'][] = ['label' => '订单列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-order-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
