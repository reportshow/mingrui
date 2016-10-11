<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-user form-control-feedback'></span>",
];

$fieldOptions2 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>",
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
 
<div class="login-logo" style="margin-top:7%;font-family: 'Microsoft Yahei'">
        <a href="#"><b>明睿</b>单病云管家</a>
</div>

<div class="login-box " style='margin-top:0%;width:480px'>

    <!-- /.login-logo -->
    <div class="login-box-body"  >

         <div class="nav-tabs-custom tab-info" style='margin-bottom: 0px; '>
            <ul class="nav nav-tabs pull-right">
                <li ck-data='account'><a data-toggle="tab" href="#tab_1-1">帐号</a></li>
                <li class="active" ck-data='sick'>
                  <a data-toggle="tab" href="#tab_2-2"><i class="fa fa-qrcode"></i>患者</a>
                </li>
                <li  ck-data='doctor'>
                  <a data-toggle="tab" href="#tab_2-3"><i class="fa fa-qrcode"></i>医生</a>
                </li>

                <li  ck-data='sms' style=''>
                  <a data-toggle="tab" href="#tab_2-4"><i class="fa fa-envelope-o"></i> 短信登录</a>
                </li>
                <li class="pull-left header"> 登录</li>
            </ul>
            <div class="tab-content" style="padding:30px;">
                <div class="tab-pane " id="tab_1-1">
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]);?>

                    <?=$form
->field($model, 'username', $fieldOptions1)
->label(false)
->textInput(['placeholder' => $model->getAttributeLabel('用户名'),'type'=>'tel'])?>

                    <?=$form
->field($model, 'password', $fieldOptions2)
->label(false)
->passwordInput(['placeholder' => $model->getAttributeLabel('密码')])?>

                    <div class="row">
                        <div class="col-xs-8">
                            <?=$form->field($model, 'rememberMe')->checkbox(['label' => '记住密码'])?>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <?=Html::submitButton(' 登 录 ', ['class' => 'btn btn-info btn-block btn-flat', 'name' => 'login-button'])?>
                        </div>
                        <!-- /.col -->
                    </div>

                    <?php ActiveForm::end();?>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_2-2">
                <center>
                    <img src="<?=$model->QrLoginUrl('sick')?>" style="width:200px"><br>微信扫一扫
                </center>

                </div>
                <!-- /.tab-pane -->


               <div class="tab-pane" id="tab_2-3">
                <center>
                    <img src="<?=$model->QrLoginUrl('doctor')?>" style="width:200px"><br>微信扫一扫
                </center>

                </div>
                <!-- /.tab-pane -->


                <div class="tab-pane " id="tab_2-4">
                 <?php require 'login-sms.php'  ?>

                </div>
                <!-- /.tab-pane -->



            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->



    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
<script type="text/javascript">
 
    var checkUrl = {'sick': '<?=$model->QrLoginCheckUrl('sick')?>',
        'doctor': '<?=$model->QrLoginCheckUrl('doctor')?>'
     };

    setInterval(function(){
        var datatype =  $('.nav-tabs li.active').attr('ck-data');
        if(datatype!='sick' && datatype!='doctor' ) return;

        $.ajax({
             type: "GET",
             url: checkUrl[datatype] ,
             data: {mobile:$("#wechatuser-mobile").val() },
             dataType: "json",
             success: function(data){                 
                console.log(data);
                if(data.code==1){
                    location.reload();
                }
             }

         });
    },2000);

/*    $('.nav-tabs li').click(function(){
        var tag = $(this).attr('ck-data');
        if(tag=='sick'){
            checkUrl =check_sick_url;
        }else if(tag=='doctor'){
            checkUrl =check_doctor_url;
        }else{
            
        }
    });*/
</script>