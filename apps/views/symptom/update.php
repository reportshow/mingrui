<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model apps\models\GenelistSymptom */

$this->title = 'Update Genelist Symptom: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Genelist Symptoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="genelist-symptom-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
