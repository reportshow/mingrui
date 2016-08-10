<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RestSample */

$this->title = 'Update Rest Sample: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rest Samples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id'           => $model->sample_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rest-sample-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
