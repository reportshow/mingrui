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
                      <button type='button' class='btn btn-info btn-flat'
                      style='border-top-left-radius: 0;border-bottom-left-radius: 0;'>获取</button>
                    </span>",
];

//echo Yii::$app->getSecurity()->generatePasswordHash('123456');
?>
    <style>
     .login-page{background: #222}
     .login-logo a{
        color:#fff;
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

        <div class="social-auth-links text-center" style='display: none'>
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                using Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a>
        </div>
        <!-- /.social-auth-links -->


    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
