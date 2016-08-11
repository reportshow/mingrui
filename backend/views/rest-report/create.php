<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title = 'Create Rest Report';
$this->params['breadcrumbs'][] = ['label' => 'Rest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
