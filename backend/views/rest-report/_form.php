<?php
use dosamigos\datepicker\DatePicker;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rest-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'report_id')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assigner_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'complete')->textInput() ?>

    <?= $form->field($model, 'cnvsqlite')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snpsqlite')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cnvsave')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'snpsave')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'finish')->widget(
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

    <?= $form->field($model, 'xiafa')->widget(
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

    <?= $form->field($model, 'analysis_id')->textInput() ?>

    <?= $form->field($model, 'yidai_complete')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yidai_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'express')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'express_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sample_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pdf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conclusion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'explain')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jxyanzhen')->textInput() ?>

    <?= $form->field($model, 'mut_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'star')->textInput() ?>

    <?= $form->field($model, 'template')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gene_template')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ptype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csupload')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'family_id')->textInput(['maxlength' => true]) ?>

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

    <?= $form->field($model, 'abiresult')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'snpexplain')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'abiexported')->textInput() ?>

    <?= $form->field($model, 'final_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assigner_note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shenhe_date')->widget(
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

    <?= $form->field($model, 'locked')->textInput() ?>

    <?= $form->field($model, 'express_sent')->textInput() ?>

    <?= $form->field($model, 'sale_marked')->textInput() ?>

    <?= $form->field($model, 'time_stamp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'yidaifinished_date')->widget(
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

    <?= $form->field($model, 'kyupload')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yidai_marked')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
