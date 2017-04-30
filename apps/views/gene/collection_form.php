<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\GenelistCollection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genelist-collection-form">

    <?php $form = ActiveForm::begin(['action' => ['gene/add-collection'],'method'=>'post',]); ?>
<div class='hide'>
    <?= $form->field($model, 'omim')->hiddenInput(['maxlength' => true,'readonly'=>'readonly']) ?>
</div>
    <?= $form->field($model, 'zhenduan')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'zhiliao')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'creator_info')->textarea(['rows' => 3]) ?>

    <?php //= $form->field($model, 'used')->textInput(['maxlength' => true,'value'=>'1']) 
    ?>

    <?php //$form->field($model, 'createtime')->textInput(['maxlength' => true]) 
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
