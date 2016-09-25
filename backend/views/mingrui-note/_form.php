<?php

use backend\widgets\WechatRecord;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiNotes */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .inputdata{display: none}
    .inputdata.text{display: block}
</style>
<div class="mingrui-notes-form">

    <?php
$model->type = 'text';

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'upload', /*'onsubmit'=>'alert(666)'*/]]);?>

    <div class="btn-group" id='typetabs'>
          <button type="button" class="btn btn-info" datatype='text'>文字</button>
          <button type="button" class="btn btn-info" datatype='image'>图片</button>
          <button type="button" class="btn btn-info" datatype='voice'>声音</button>
    </div>

    <?=$form->field($model, 'type')->hiddenInput(['maxlength' => true, 'id' => 'type', 'value' => 'text'])->label(false)?>


    <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>
<div class='inputdata  image'>
   <?=$form->field($model, 'image[]')->widget(FileInput::classname(), [
    'options'       => ['multiple' => true, 'accept' => 'image/*'],
    'pluginOptions' => [
        'showUpload' => false,
    ],
])->label('选择图片');
?>
</div>
<div  class='inputdata text'>
  <?=$form->field($model, 'content')->textInput(['maxlength' => true])?>
</div>

<div  class='inputdata voice'> hiddenInput
 <?=$form->field($model, 'voice')->textInput(['maxlength' => true])->label(false)?>


 <button id='addmorevoice'  type="button" class='btn btn-warning hidden ' >增加语音</button>
</div>

<?=
WechatRecord::widget([]);
?>


    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? '提交' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>


    <?php ActiveForm::end();?>

</div>
<script type="text/javascript">
    $('#typetabs button').click(function(){
        var datatype = $(this).attr('datatype');
        $('.inputdata').hide();
        $('#typetabs button').removeClass('active');
        $('.inputdata.'+datatype).show();
        $('button[datatype='+datatype+']').addClass('active');
        $('#type').val(datatype);

        if(datatype=='voice'){
            $('body').trigger("voice_init");
        }else{
            recordDismiss();
        }
    });

    var allVoice = [];
    $('body').bind("voice",function(e,voice){
        $('#addmorevoice').removeClass('hidden');
       allVoice.push(voice);
       $('#mingruinotes-voice').val(JSON.stringify(allVoice) );
    });


    $('#addmorevoice').click(function(){
       $('body').trigger("voice_init");
    });
</script>


