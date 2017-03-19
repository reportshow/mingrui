<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model apps\models\Mainlist */

$this->title = 'Update Mainlist: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mainlists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mainlist-update">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
