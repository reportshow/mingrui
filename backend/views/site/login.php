<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-user form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

 //echo Yii::$app->getSecurity()->generatePasswordHash('123456');
?>
    <style>
     .login-page{background: #222}
     .login-logo a{
        color:#fff;
        }
      .login-box-body{
       /*  border-radius: 5px; 
       border-top: 4px solid #00c0ef;
       box-shadow: 2px 2px 5px; */
       background: none;
       min-width: 400px;
      }
      .tab-content{
        
      }
    </style> 
<div class="login-logo" style='margin-top:7%'>
        <a href="#"><b>Wisdom</b> Report Management System  </a>
</div>

<div class="login-box " style='margin-top:0%;'>
    
    <!-- /.login-logo -->
    <div class="login-box-body"  >

         <div class="nav-tabs-custom tab-info" style='margin-bottom: 0px; '>
            <ul class="nav nav-tabs pull-right">
                <li class="active"><a data-toggle="tab" href="#tab_1-1">帐号</a></li>
                <li><a data-toggle="tab" href="#tab_2-2"><i class="fa fa-qrcode"></i> 二维码</a></li> 
                <li class="pull-left header"> 登录</li>
            </ul>
            <div class="tab-content" style="padding: 20px;">
                <div class="tab-pane active" id="tab_1-1">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

                    <?= $form
                        ->field($model, 'username', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('用户名')]) ?>

                    <?= $form
                        ->field($model, 'password', $fieldOptions2)
                        ->label(false)
                        ->passwordInput(['placeholder' => $model->getAttributeLabel('密码')]) ?>

                    <div class="row">
                        <div class="col-xs-8">
                            <?= $form->field($model, 'rememberMe')->checkbox(['label'=>'记住密码']) ?>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <?= Html::submitButton(' 登 录 ', ['class' => 'btn btn-info btn-block btn-flat', 'name' => 'login-button']) ?>
                        </div>
                        <!-- /.col -->
                    </div>

                    <?php ActiveForm::end(); ?> 
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2-2">
                <center>
                    <img src="<?=$model->guestQrcodeUrl() ?>" style="width:200px"><br>微信扫一扫
                </center>
                   
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
 
 

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
