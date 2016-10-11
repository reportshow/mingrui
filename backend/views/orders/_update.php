<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use backend\models\MingruiOrder;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiOrder */
/* @var $form yii\widgets\ActiveForm */

 
?>

<div class="mingrui-order-form">
   
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true,'class'=>'hide'])->label(false) ?>
 
    
    <?= $form->field($model, 'status')->dropDownList(MingruiOrder::$statutText); ?>

    <?= $form->field($model, 'assigned')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '   确 定   ', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<style type="text/css">
    .mingrui-order-form{width: 60%}
</style>