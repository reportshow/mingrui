<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiPingjia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mingrui-pingjia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'report_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pingjia')->textInput() ?>

    <?= $form->field($model, 'linchuang')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'createtime')->widget(
                        DatePicker::className(), [
                     /*'inline' => true, // inline too, not bad
                     // modify template for custom rendering
                     //'template' => '<div class='wellwell - sm' style='background - color: #fff; width:250px'>{input}</div>',
                     */
                    'clientOptions' => [
                        'autoclose' => true,
                        'format'    => 'yyyy-mm-dd',
                    ]
                ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
