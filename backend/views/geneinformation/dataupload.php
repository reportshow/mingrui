<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model apps\models\Information */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="information-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true])->label('类关键字') ?>
 
    <?php 

        echo $form->field($model, 'OTHERS[]')->widget(FileInput::classname(), [
            'options'       => ['multiple' => true, 'accept' => '*/*'],
            'pluginOptions' => [
                'showUpload' => true,
            ],
        ])->label('选择文件');


    ?> 

    <div class="form-group">
        <?= Html::submitButton( '提交', ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
