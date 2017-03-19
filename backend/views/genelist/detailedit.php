<?php


use backend\widgets\CKeditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\Mainlist */
/* @var $form yii\widgets\ActiveForm */

if(empty( $onlyshow) || !$onlyshow){ 

?>

<div class="mainlist-form">
    
    <h1> <?= $model->name ?></h1>
    <?php $form = ActiveForm::begin(); ?>

    <?=CKeditor::widget(['name' => 'Mainlist[detail]', 'title' => '细节描述']);?>
     
    <div class="form-group">
        <?= Html::submitButton( '保存', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?> 
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 

}else{ 
 ?>
<h1> <?= $model->name ?></h1>
 <?=Html::a('编辑详细图文描述',['detailedit','id'=>$model->id],['class'=>'btn btn-success btn-detail ' ]) ?>

<?= $model->detail ?>

<?php  
} ?>


 