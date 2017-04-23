<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model apps\models\GenelistOrder */

$this->title = 'Update Genelist Order: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Genelist Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="genelist-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
