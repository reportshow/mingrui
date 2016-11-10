<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\MingruiPingjia;

/* @var $this yii\web\View */
/* @var $model backend\models\RestSampleSearch */
/* @var $form yii\widgets\ActiveForm */

$model->name = '';
?>

<div class="rest-sample-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index-report', 'RestSampleSearch[name]'=>''],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sample_id') ?>

    <?=$form->field($model, 'report_id')->label('项目编号')?>
    <?= $form->field($model, 'name') ?>

    <?php //= $form->field($model, 'type') ?>

    <?php //= $form->field($model, 'ypkd_id') ?>

    <?php  //= $form->field($model, 'barcode') ?>


     <?= $form->field($model, 'sex')->dropDownList(    
         [''=>'未知','male'=>'男','female'=>'女'], ['style' => 'width-:300px;']
         );
     ?>

    <?php // echo $form->field($model, 'birthday') ?>
    <?= $form->field($model, 'age')->textInput(['style' => 'width-:300px;']) ?>

    <?= $form->field($model, 'product_name')->label('检测项目') ?>
  

    <?=  $form->field($model, 'gene')->label('基因型') ?>
    
    <?= $form->field($model, 'pingjia')->dropDownList( MingruiPingjia::getSimpleArray())->label('星级评价');
     ?>


     <?php
    //  echo  $form->field($model, 'pingjia')->radioList(MingruiPingjia::getTextArray(),['class'=>'label-group',
    //  'item'=>function($index, $label, $name, $checked, $value) {
    //     $checked=$checked?"checked":"";
    //     $return = '<div class="md-radio">';
    //     $return .= '<input type="radio" id="' . $name . $value . '" name="' . $name . '" value="' . $value . '" class="md-radiobtn"  '.$checked.'>';
    //     $return .= '<label for="' . $name . $value . '">
    //                 <span></span>
    //                 <span class="check"></span>
    //                 <span class="box"></span>' . ucwords($label) . '</label>';
    //     $return .= '</div>';
    //     return $return;
    // }])->label('评价'); 

    ?>

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
        <?= Html::submitButton(' 搜索 ', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('  重置 ', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
