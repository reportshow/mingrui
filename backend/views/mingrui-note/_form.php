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

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'upload' ,'id'=>'noteform']]);?>

    <div class="btn-group" id='typetabs'>
          <button type="button" class="btn btn-info active" datatype='text'>文字</button>
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

<div  class='inputdata voice'> 
 <?=$form->field($model, 'voice')->hiddenInput(['maxlength' => true])->label(false)?>

<?=
WechatRecord::widget([]);
?>

</div>




<div class="form-group " style="margin-top:10px">
 
  <button type="button" id='submitbtn' class="btn btn-success btn-block">提交</button>    
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


/*******语音******/
    if(!isWeixin()){
      $('#typetabs button[datatype="voice"]').hide();
    }

   
    $('body').bind("voiceUpdate",function(e,voices){       
       
       $('#mingruinotes-voice').val(JSON.stringify(voices) );
    });


$("#submitbtn").click(function(e){
  var datatype =  $('#typetabs .active').attr('datatype');
  if(datatype=='voice'){
     voiceUpload(function(voices){        
        $('#mingruinotes-voice').val(JSON.stringify(voices) );
        $('#noteform').submit();
     });
  }else{
     $('#noteform').submit();
  }
  
});
   
/*语音*/    

    
</script>


