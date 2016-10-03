<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\MingruiPingjia;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-reportstore-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    //$form->field($model, 'uid')->Input(['maxlength' => true,'value'=>1])
    ?>

    <?= $form->field($model, 'sick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnose')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gene')->textInput(['maxlength' => true]) ?>
 
     <?= $form->field($model, 'pingjia')->radioList(MingruiPingjia::getTextArray(),['class'=>'label-group'])->label('评价'); ?>

     <?php 
         echo $form->field($model, 'attachements[]')->widget(FileInput::classname(), [
                'options'       => ['multiple' => true, 'accept' => '*/*'],
                'pluginOptions' => [
                    'showUpload' => false,
                ],
            ])->label('选择文件');        

     ?> 

    <?php
     // $form->field($model, 'createtime')->textInput(['maxlength' => true])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ' 提 交 ' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
