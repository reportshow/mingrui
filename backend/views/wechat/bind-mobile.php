<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '手机号确认';

$fieldOptions1 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-phone form-control-feedback'></span>",
];

$fieldOptions2 = [
    'options'       => ['class' => 'input-group input-group-sm'],
    'inputTemplate' => "{input} <span class='input-group-btn'>
                      <button id=getsms type='button' class='btn btn-info btn-flat'
                      style='border-top-left-radius: 0;border-bottom-left-radius: 0;'><i id='getsmsIcon' class='fa fa-refresh '></i> 获取</button>
                    </span>",
];

//echo Yii::$app->getSecurity()->generatePasswordHash('123456');
?>
    <style>
     .login-page{background: #222}
     .login-logo a{
        color:#fff;
     }
    .loop{
        animation: loop 2s linear infinite;
       -webkit-animation: loop 2s linear infinite;
    }
    @keyframes loop {
     from {transform: rotate(0deg);}
     to {transform: rotate(360deg);}
    }
    @-webkit-keyframes loop {
     from {-webkit-transform: rotate(0deg);}
     to {-webkit-transform: rotate(360deg);}
    }
    </style>
<div class="login-logo" style='margin-top:7%'>
        <a href="#"><b>Wisdom</b> Report Management System  </a>
</div>

<div class="login-box " style='margin-top:0%;'>

    <!-- /.login-logo -->
    <div class="login-box-body" style='border-radius: 5px; border-top: 4px solid #00c0ef;box-shadow: 2px 2px 5px;'>
        <p class="login-box-msg">手机号确认</p>

        <?php $form = ActiveForm::begin(['action' => $bindMobileUrl, 'id' => 'login-form', 'enableClientValidation' => false]);?>

        <?=$form
->field($model, 'mobile', $fieldOptions1)
->label(false)
->textInput(['placeholder' => '手机号'])?>

        <?=$form
->field($model, 'smscode', $fieldOptions2)
->label(false)
->textInput(['placeholder' => '验证码'])?>

        <?=$form
->field($model, 'openid')
->label(false)
->hiddenInput()?>

        <div class="row" >

            <div class="col-xs-4"></div>
            <div class="col-xs-4" style="margin-top:10px;">
                <?=Html::submitButton(' 确 认 ',
    [
        'class' => 'btn btn-info btn-block btn-flat',
        'style' => 'margin:0px auto;',
        'name'  => 'login-button',
    ]
);
?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end();?>




    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
<script type="text/javascript">
    var disabled = false;
    $('#getsms').click(function(){
       if(disabled) return;
       disabled = true;
       var url =  '<?=Yii::$app->urlManager->createUrl(['wechat-oauth/getsms']);?>';
        $(this).addClass('disabled');
        $('#getsmsIcon').addClass('fa-refresh').addClass('loop').removeClass('fa-check');
        $.ajax({
             type: "GET",
             url: url ,
             data: {mobile:$("#wechatuser-mobile").val() },
             dataType: "json",
             success: function(data){
                $('#getsmsIcon').removeClass('fa-refresh').removeClass('loop').addClass('fa-check');
                console.log(data);
             }

         });
        setTimeout(function(){
           disabled = false;
           $('#getsmsIcon').removeClass('fa-refresh').removeClass('loop');
            $(this).removeClass('disabled');
        },20*1000);
    });
</script>

