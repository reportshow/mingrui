<?php
use dosamigos\datepicker\DatePicker;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RestSample */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rest-sample-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php  //= $form->field($model, 'sample_id')->textInput(['maxlength' => true]) ?>

    <?php  //= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php  //= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?php  //= $form->field($model, 'ypkd_id')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'barcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'symptom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->widget(
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

    <?= $form->field($model, 'has_project')->textInput() ?>

    <?= $form->field($model, 'report_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'guanlian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pdf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'has_symptom')->textInput() ?>

    <?= $form->field($model, 'relation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'related_sid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'xianzhengzhe')->textInput() ?>

    <?= $form->field($model, 'yangbenruku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heshuanruku')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heshuanruku2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yangbenweizi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heshuanweizi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heshuanweizi2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'doctor_id')->textInput() ?>

    <?= $form->field($model, 'family_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_id')->textInput() ?>

    <?= $form->field($model, 'shenhe_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clinic_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'clinic_symptom')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'report_template')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created')->widget(
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

    <?= $form->field($model, 'xiedai')->textInput() ?>

    <?= $form->field($model, 'updated')->widget(
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

    <?= $form->field($model, 'timestamp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dengji_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'express')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'express_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shouyang_date')->widget(
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

    <?= $form->field($model, 'shouyanged')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
