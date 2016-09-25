<?php

use backend\widgets\CKeditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-doc-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?php
    //=$form->field($model, 'description')->textarea(['rows' => 6])
    ?>

    <?=$form->field($model, 'doc')->textInput(['maxlength' => true])?>
 

    <?=CKeditor::widget(['name' => 'MingruiDoc[description]','title'=>'内容']);?>

    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>


    <?php ActiveForm::end();?>

</div>
