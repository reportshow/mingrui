<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\Information */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="information-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'genecount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sick')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sick_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gene')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'omim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'background')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wide')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'DM')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mutation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grosins')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grosdel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'complex')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prom')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deletion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'insertion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'splice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amplet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OTHERS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refseq')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
