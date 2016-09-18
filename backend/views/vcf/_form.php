<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiVcf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-vcf-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]);?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'notes')->textInput(['maxlength' => true])?>

     <?php
		echo $form->field($model, 'vcf[]')->widget(FileInput::classname(), [
		    'options'       => ['multiple' => true, 'accept' => '*/*'],
		    'pluginOptions' => [
		        'showUpload' => false,
		    ],
		])->label('选择vcf文件');
	?>


    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? '上传' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
