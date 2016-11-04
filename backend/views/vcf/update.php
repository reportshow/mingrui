<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiVcf */

$this->title =   $model->title;
$this->params['breadcrumbs'][] = ['label' => '外源数据分析', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="mingrui-vcf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
