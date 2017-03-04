<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstore */

$this->title = '外源报告 ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '外源报告', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="mingrui-reportstore-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'hideattachment'=>'hide',
    ]) ?>

</div>
