<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model apps\models\Mainlist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mainlist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_en')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //= $form->field($model, 'hassub')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'hassub')->radioList(['1'=>'基因子类','0'=>'图文描述']) ?>

    <?= $form->field($model, 'classname' )->textInput(['maxlength' => true ,'readonly' => 'true'])  ?>
    
    <?=Html::a('编辑详细图文描述',['detailedit','id'=>$model->id],['class'=>'btn btn-success btn-detail ' . ($model->hassub ? 'hide':'') ]) ?>

    <?= $form->field($model, 'caselist' )->textInput(['maxlength' => true ])  ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    	
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
	//var showClassname = <?=$model->hassub ? 'block' : 'hidden' ?>;
	//var showDesc =  <?=$model->hassub ? 'hidden' : 'block' ?>;
	$('#mainlist-hassub').click(function(){ 
		 
		var v =  $('#mainlist-hassub input:radio:checked').val();
		v = parseInt(v);
		showkeyname(v);  

	});

	function showkeyname(v){ 
        if(v){  
            $('.field-mainlist-classname').removeClass('hide');
            $('.btn-detail').addClass('hide');
        }else{ 
			$('.field-mainlist-classname').addClass('hide');
			$('.btn-detail').removeClass('hide');
        }
	}
	
	showkeyname(<?=$model->hassub ?>);  
</script>
