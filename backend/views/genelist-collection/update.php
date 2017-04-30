<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model apps\models\GenelistCollection */

$this->title = '更新: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '词条列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="genelist-collection-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
