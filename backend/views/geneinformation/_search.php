<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\InformationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="information-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'class') ?>

    <?= $form->field($model, 'genecount') ?>

    <?= $form->field($model, 'sick') ?>

    <?php // echo $form->field($model, 'sick_en') ?>

    <?php // echo $form->field($model, 'gene') ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'omim') ?>

    <?php // echo $form->field($model, 'background') ?>

    <?php // echo $form->field($model, 'wide') ?>

    <?php // echo $form->field($model, 'DM') ?>

    <?php // echo $form->field($model, 'mutation') ?>

    <?php // echo $form->field($model, 'grosins') ?>

    <?php // echo $form->field($model, 'grosdel') ?>

    <?php // echo $form->field($model, 'complex') ?>

    <?php // echo $form->field($model, 'prom') ?>

    <?php // echo $form->field($model, 'deletion') ?>

    <?php // echo $form->field($model, 'insertion') ?>

    <?php // echo $form->field($model, 'indel') ?>

    <?php // echo $form->field($model, 'splice') ?>

    <?php // echo $form->field($model, 'amplet') ?>

    <?php // echo $form->field($model, 'OTHERS') ?>

    <?php // echo $form->field($model, 'refseq') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
