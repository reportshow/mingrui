<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiMypic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-mypic-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','class'=>'upload']]); ?> 

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

 
    <?=  $form->field($model, 'images[]')->widget(FileInput::classname(), [    
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'showUpload' => false,
            ]
        ])->label('选择报告图片'); 
    ?>
   <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
