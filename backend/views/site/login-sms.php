<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$fieldOptions1 = [
    'options'       => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='fa fa-phone form-control-feedback'></span>",
];

$fieldOptions2 = [
    'options'       => ['class' => 'input-group input-group-sm','style'=>'margin-bottom: 15px;'],
    'inputTemplate' => "{input} <span class='input-group-btn'>
                      <button id=getsms type='button' class='btn btn-info btn-flat '
                      style='border-top-left-radius: 0;border-bottom-left-radius: 0;'>
                      <i id='getsmsIcon' class='fa  fa-envelope-o'></i> <span>获取</span></button>
                    </span>",
                    ];

$verifyUrl = Yii::$app->urlManager->createUrl(['utils/verifyimg', 'rnd' => rand()]);
$verifycheckUrl = Yii::$app->urlManager->createUrl(['utils/verifycheck'  ]);
$sendSmsUrl = Yii::$app->urlManager->createUrl(['utils/sendsms'  ]);
$loginUrl = Yii::$app->urlManager->createUrl(['site/loginsms'  ]);


$form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); 

echo $form->field($model, 'username', $fieldOptions1)
                    ->label(false)
                    ->textInput(['placeholder' => $model->getAttributeLabel('手机号'),'type'=>'tel','id'=>'mobile']);

?>

<div class="input-group input-group-sm field-loginform-verify required" style="margin-bottom: 15px;">

        <input type="text" id="loginform-verify" class="form-control" name="verify" placeholder="验证码"> 
        <span class='input-group-btn'>
           <img id='verifyimg' src='<?=$verifyUrl?>' width=80>
           <button id='getverifyimg' type='button' class='btn btn-info btn-flat'  style='border-top-left-radius: 0;border-bottom-left-radius: 0;'>
            <i  class='fa fa-refresh '></i> 刷新
          </button>
        </span>

    <p class="help-block help-block-error"></p>
</div>

<?php

echo $form->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->textInput(['placeholder' => '短信验证码','id'=>'sms',//$model->getAttributeLabel('获取短信')
              ]);

?>

<div class="row">
    <div class="col-xs-8">
        <?=$form->field($model, 'rememberMe')->checkbox(['label' => '记住密码'])?>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
        <button  id='dosmslogin' type=button class = 'btn btn-info btn-block btn-flat' > 登 录 </button>       
    </div>
    <!-- /.col -->
</div>

 <?php ActiveForm::end();?>
<style type="text/css">
    .disabled{background: buttonface; border-color: #ddd; color:#666;}
</style>
<script type="text/javascript">
    /*$('#loginform-verify').change(function(){
        //检查实时输入的验证码
        var url = '<?=$verifycheckUrl?>';
        var code = $(this).val();

        if(code.length <4){
            return;
        }
        $.ajax({url:url,
            method:'get',
            data:{code: code},
            dataType:'json',
           success:function(d){
                console.log(d);
                if(d.code==1){
                  $('#getsms').removeClass('disabled');
                  $('#loginform-verify').attr('disabled','disabled');
                  $('#getverifyimg').addClass('disabled','disabled');
                }
                
           },
       });//ajax
    });*/

    //更新验证码
    $('#getverifyimg').click(function(){
         if($(this).hasClass('disabled')) return;

         $('#verifyimg').attr('src','<?=$verifyUrl?>&x='+Math.random());
    });

    var myclock;var Clockcount;
    function startClock(){
        Clockcount = 60;
        myclock = setInterval(function(){
            Clockcount --;
            $('#getsms').find('span').html(Clockcount+'秒');

            if(Clockcount==0){
                stopClock();
            }
            
       },1000);
    }
    function stopClock(){
           Clockcount=0;
           clearInterval(myclock);
           $('#getsms').removeClass('disabled');
           $('#getsms').find('span').html( '获取');
           //$('#getsms').find('span').html('');
    }

    $('#getsms').click(function(){
        if($(this).hasClass('disabled')) return;       
        $(this).addClass('disabled');

       

       var url  = '<?=$sendSmsUrl?>';
       $.ajax({url:url,
            method:'get',
            data:{code: $('#loginform-verify').val(), 'mobile':$('#mobile').val()},
            dataType:'json',
           success:function(d){
                console.log(d);
                if(d.code==1001){
                    alert('图形验证码错误');
                    stopClock();
                    $('#getverifyimg').click();
                    return;
                }
                if(d.code==1){
                  startClock();
                }
                
           },
       });//ajax
         
      
    });

     $('#dosmslogin').click(function(){
      var url  = '<?=$loginUrl?>';
       $.ajax({url:url,
            method:'get',
            data:{
              'code': $('#loginform-verify').val(), 
              'mobile':$('#mobile').val(),
              'sms':$('#sms').val()
            },
            dataType:'json',
           success:function(d){
                console.log(d);
                if(d.code==1001){
                    alert('图形验证码错误');
                    stopClock();
                    $('#getverifyimg').click();
                    return;
                }
                if(d.code==1002){
                  alert('短信验证码错误'); return;
                }
                if(d.code==1004){
                  alert('请先用微信扫一扫初始化帐号，以后才可用短信方式登录'); return;
                }
                 if(d.code==1){
                   location.href='';
                }
           },
       });//ajax
     });//click

</script>