<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiQa */

$this->title = 'Update Mingrui Qa: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mingrui Qas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mingrui-qa-update">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
