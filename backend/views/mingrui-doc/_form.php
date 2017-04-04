<?php

use backend\widgets\CKeditor;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */
/* @var $form yii\widgets\ActiveForm */

$type = $_GET['type'];
if(Yii::$app->user->Identity->role_text=='guest'){
    $type = 'article';
}
?>

<div class="mingrui-doc-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'upload']]);?>

    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'type')->hiddenInput(['value' => $type ])->label(false)?>
    <?php
//=$form->field($model, 'description')->textarea(['rows' => 6])
?>


     <?php
        $type = $_GET['type'];
        if (1 || $type != 'doc') { 
            echo CKeditor::widget(['name' => 'MingruiDoc[description]', 'title' => '内容', 'placehoder'=>$model->description  ]);
        } 
        if ($type == 'doc') {
            echo $form->field($model, 'doc[]')->widget(FileInput::classname(), [
                'options'       => ['multiple' => true, 'accept' => '*/*'],
                'pluginOptions' => [
                    'showUpload' => false,
                ],
            ])->label('选择文件');
        }

?>




    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? '提交' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>


    <?php ActiveForm::end();?>

</div>
