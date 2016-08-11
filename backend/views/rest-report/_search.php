<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rest-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'report_id') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'updated') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'assigner_id') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'complete') ?>

    <?php // echo $form->field($model, 'cnvsqlite') ?>

    <?php // echo $form->field($model, 'snpsqlite') ?>

    <?php // echo $form->field($model, 'cnvsave') ?>

    <?php // echo $form->field($model, 'snpsave') ?>

    <?php // echo $form->field($model, 'finish') ?>

    <?php // echo $form->field($model, 'xiafa') ?>

    <?php // echo $form->field($model, 'analysis_id') ?>

    <?php // echo $form->field($model, 'yidai_complete') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'yidai_note') ?>

    <?php // echo $form->field($model, 'express') ?>

    <?php // echo $form->field($model, 'express_no') ?>

    <?php // echo $form->field($model, 'sample_id') ?>

    <?php // echo $form->field($model, 'pdf') ?>

    <?php // echo $form->field($model, 'conclusion') ?>

    <?php // echo $form->field($model, 'explain') ?>

    <?php // echo $form->field($model, 'jxyanzhen') ?>

    <?php // echo $form->field($model, 'mut_type') ?>

    <?php // echo $form->field($model, 'star') ?>

    <?php // echo $form->field($model, 'template') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'gene_template') ?>

    <?php // echo $form->field($model, 'ptype') ?>

    <?php // echo $form->field($model, 'csupload') ?>

    <?php // echo $form->field($model, 'family_id') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'abiresult') ?>

    <?php // echo $form->field($model, 'snpexplain') ?>

    <?php // echo $form->field($model, 'abiexported') ?>

    <?php // echo $form->field($model, 'final_note') ?>

    <?php // echo $form->field($model, 'assigner_note') ?>

    <?php // echo $form->field($model, 'shenhe_date') ?>

    <?php // echo $form->field($model, 'locked') ?>

    <?php // echo $form->field($model, 'express_sent') ?>

    <?php // echo $form->field($model, 'sale_marked') ?>

    <?php // echo $form->field($model, 'time_stamp') ?>

    <?php // echo $form->field($model, 'yidaifinished_date') ?>

    <?php // echo $form->field($model, 'kyupload') ?>

    <?php // echo $form->field($model, 'yidai_marked') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
