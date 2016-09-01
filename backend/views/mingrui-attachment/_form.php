<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiAttachment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-attachment-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]); ?>

   <?= $form->field($model, 'report_id')->hiddenInput(['value'=> $_GET['id']  ])->label(false);?>    
   <?=  $form->field($model, 'image[]')->widget(FileInput::classname(), [    
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'showUpload' => false,
            ]
        ])->label('选择报告图片'); 
    ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ' 创 建 ' : '更新',
         ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
         'style'=>'padding-left:30px;padding-right:30px;']
         ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
