<?php

use backend\widgets\CKeditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-doc-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'upload']]);?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

    <?php
//=$form->field($model, 'description')->textarea(['rows' => 6])
?>


     <?php
        $type = $_GET['type'];
        if ($type == 'article') {
            echo CKeditor::widget(['name' => 'MingruiDoc[description]', 'title' => '内容']);
        } else if ($type == 'doc') {
            echo $form->field($model, 'doc[]')->widget(FileInput::classname(), [
                'options'       => ['multiple' => true, 'accept' => '*/*'],
                'pluginOptions' => [
                    'showUpload' => false,
                ],
            ])->label('选择文件');
        }

?>




    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>


    <?php ActiveForm::end();?>

</div>
