<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RestSampleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rest-sample-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sample_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'ypkd_id') ?>

    <?= $form->field($model, 'barcode') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'birthday') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'tel1') ?>

    <?php // echo $form->field($model, 'tel2') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'symptom') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'has_project') ?>

    <?php // echo $form->field($model, 'report_type') ?>

    <?php // echo $form->field($model, 'guanlian') ?>

    <?php // echo $form->field($model, 'pdf') ?>

    <?php // echo $form->field($model, 'has_symptom') ?>

    <?php // echo $form->field($model, 'relation') ?>

    <?php // echo $form->field($model, 'related_sid') ?>

    <?php // echo $form->field($model, 'xianzhengzhe') ?>

    <?php // echo $form->field($model, 'yangbenruku') ?>

    <?php // echo $form->field($model, 'heshuanruku') ?>

    <?php // echo $form->field($model, 'heshuanruku2') ?>

    <?php // echo $form->field($model, 'yangbenweizi') ?>

    <?php // echo $form->field($model, 'heshuanweizi') ?>

    <?php // echo $form->field($model, 'heshuanweizi2') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'doctor_id') ?>

    <?php // echo $form->field($model, 'family_id') ?>

    <?php // echo $form->field($model, 'sales_id') ?>

    <?php // echo $form->field($model, 'shenhe_status') ?>

    <?php // echo $form->field($model, 'clinic_no') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'patient_no') ?>

    <?php // echo $form->field($model, 'clinic_symptom') ?>

    <?php // echo $form->field($model, 'report_template') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'xiedai') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <?php // echo $form->field($model, 'dengji_note') ?>

    <?php // echo $form->field($model, 'express') ?>

    <?php // echo $form->field($model, 'express_no') ?>

    <?php // echo $form->field($model, 'shouyang_date') ?>

    <?php // echo $form->field($model, 'shouyanged') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
