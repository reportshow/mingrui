<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestSample */

$this->title = 'Create Rest Sample';
$this->params['breadcrumbs'][] = ['label' => 'Rest Samples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-sample-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
