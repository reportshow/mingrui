<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model apps\models\GenelistSymptom */

$this->title = 'Create Genelist Symptom';
$this->params['breadcrumbs'][] = ['label' => 'Genelist Symptoms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genelist-symptom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
