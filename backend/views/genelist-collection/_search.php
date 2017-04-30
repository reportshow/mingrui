<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\GenelistCollectionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genelist-collection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'omim') ?>

    <?= $form->field($model, 'zhenduan') ?>

    <?= $form->field($model, 'zhiliao') ?>

    <?= $form->field($model, 'creator_info') ?>

    <?php // echo $form->field($model, 'used') ?>

    <?php // echo $form->field($model, 'createtime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
