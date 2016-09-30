<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstoreResearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-reportstore-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'sick') ?>

    <?= $form->field($model, 'product') ?>

    <?= $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'diagnose') ?>

    <?php // echo $form->field($model, 'attachements') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
