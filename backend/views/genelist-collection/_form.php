<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\GenelistCollection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genelist-collection-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'omim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zhenduan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'zhiliao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'creator_info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'used')->textInput(['maxlength' => true,'value'=>'1']) ?>

    <?php //$form->field($model, 'createtime')->textInput(['maxlength' => true]) 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
