<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiScore */

$this->title = 'Update Mingrui Score: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mingrui Scores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mingrui-score-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
