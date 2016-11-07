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

    <?= $form->field($model, 'id'); ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'sick') ?>
    <?= $form->field($model, 'age') ?>
    <?= $form->field($model, 'sex') ?>
    <?= $form->field($model, 'product') ?>

    <?= $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'diagnose')
     ?>

    <?php // echo $form->field($model, 'gene')
     ?>

    <?php // echo $form->field($model, 'pingjia') 
    ?>

    <?php // echo $form->field($model, 'attachements')
     ?>

    <?php // echo $form->field($model, 'createtime') 
    ?>
   <?php // echo $form->field($model, 'extra1') ?>
   <?php // echo $form->field($model, 'extra2') ?>
   <?php // echo $form->field($model, 'extra3') ?>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
