<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doctor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'createtime')->widget(
                        DatePicker::className(), [
                     /*'inline' => true, // inline too, not bad
                     // modify template for custom rendering
                     //'template' => '<div class='wellwell - sm' style='background - color: #fff; width:250px'>{input}</div>',
                     */
                    'language' => 'zh-cn',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format'    => 'yyyy-mm-dd',
                        'language'=>'zh-cn'
                    ],
                     
                ]); ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assigned')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
