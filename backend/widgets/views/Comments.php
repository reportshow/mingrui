<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\MingruiComments;
use backend\widgets\WechatRecord;
 use backend\widgets\VoiceShow;

 
$clearUrl = Yii::$app->urlManager->createUrl(['comment/clear-comments','report_id'=>$model->id]);

?><div class="box box-primary direct-chat direct-chat-primary comment-widget">
    <div class="box-header with-border">
        <h3 class="box-title">
            意见与点评
        </h3>
        <div class="box-tools pull-right">
            <span class="badge bg-light-blue hide" data-toggle="tooltip" title="3 New Messages">
                
            </span>
            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                <i class="fa fa-minus">
                </i>
            </button>
            <button class="btn btn-box-tool hide" data-toggle="tooltip" data-widget="chat-pane-toggle" title="Contacts" type="button">
                <i class="fa fa-comments">
                </i>
            </button>
            <button class="btn btn-box-tool hide" data-widget="remove" type="button">
                <i class="fa fa-times">
                </i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style='height: auto'>
            <?php
foreach ($model->comments as $comment) {
    if ($comment) { 
        echo $this->render('CommentsLine', ['model' => $comment]);
    }

}

?>

        </div>
        <!--/.direct-chat-messages-->

        <!-- Contacts are loaded here -->
        <div class="direct-chat-contacts">
            <ul class="contacts-list">
                <li>
                    <a href="#">
                        <img alt="User Image" class="contacts-list-img" src="../dist/img/user1-128x128.jpg">
                            <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                    Count Dracula
                                    <small class="contacts-list-date pull-right">
                                        2/28/2015
                                    </small>
                                </span>
                                <span class="contacts-list-msg">
                                    How have you been? I was...
                                </span>
                            </div>
                            <!-- /.contacts-list-info -->
                        </img>
                    </a>
                </li>
                <!-- End Contact Item -->
            </ul>
            <!-- /.contatcts-list -->
        </div>
        <!-- /.direct-chat-pane -->
    </div>
    <!-- /.box-body -->

    <div class="box-footer">    
       <?php 
       $form = ActiveForm::begin(['action' => $model->formaction ,'method'=>'post', 'id'=>'noteform']); 

       ?>
           
           <input type="hidden" name="MingruiComments[report_id]" value="<?=$model->id?>">

            <div class="input-group">
                    <input class="form-control" id='MingruiComments-content'  name="MingruiComments[content]" 
                        placeholder="输入留言内容" type="text">
                    <span class="input-group-btn voiceActionBtn">
                        <button type=button class="btn btn-info btn-flat"  >
                         <i class='fa fa-microphone'> </i> 语音
                        </button>
                    </span>
                    <span class="input-group-btn">
                        <button type=button  class="btn btn-primary btn-flat" id="submitbtn">
                            发送
                        </button>
                    </span>
                 
            </div>
            <?=
            WechatRecord::widget([]);
            ?>

        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-footer-->
</div>

<script type="text/javascript">
    
    $(function(){
        if(!isWeixin()){
             $('.voiceActionBtn').hide();
        }        
    });

     $('.voiceActionBtn').click(function(){
        $('body').trigger("voice_init",{"multi":false});  //弹出语音 
     });
    
    var nowdataType = 'text';
    $('body').bind("voiceUpdate",function(e,voices){
        nowdataType= 'voice';
       $('#MingruiComments-content').val(JSON.stringify(voices) );
       $('#MingruiComments-content').hide();
       $('.voiceActionBtn').hide();
       if($('form .input-group #addmorevoice').length  < 1){
         var $vbt = $('#addmorevoice')[0];
         $('#addmorevoice').remove();
         $('form .input-group').append($vbt);
       }
      
    });
   
    $("#submitbtn").click(function(e){ 
      if(nowdataType=='voice'){
         voiceUpload(function(voices){        
            $('#MingruiComments-content').val(JSON.stringify(voices) );
            $('#noteform').submit();
         });
      }else{
         var content = $('#MingruiComments-content').val() +"";
         if(content.length < 2){
            alert('请输入内容');
            return;
         }
         $('#noteform').submit();
      }
      
    });//click

     $.ajax({
         type: "GET",
         url: "<?=$clearUrl ?>",
         data: {},
         dataType: "json",
         success: function(data){
                     
         }
     });
     
</script>
<?=VoiceShow::begin();?>

<style type="text/css">
   .direct-chat-text{    
        max-width: 60%;     display: inline-block;
    } 
    .direct-chat-primary .right>.direct-chat-text{      
    float: right;
    margin-right: 10px;}

    .left>.direct-chat-text{  
      margin-left: 10px;
    }
    .voicecontainer:after,.voicecontainer:before{
      content:none;
    }
     .voicecontainer{padding-right: 0px;}   
    .voiceplaybox.direct-chat-text:before{
      border-right-color: #00C0EF;
    }
    .direct-chat-text:after{
       content:none;
    }
</style>