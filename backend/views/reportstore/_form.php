<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-reportstore-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'sick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diagnose')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attachements')->textarea(['rows' => 6]) ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ' 提交 ' : ' 更新 ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
