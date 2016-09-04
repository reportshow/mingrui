<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\MingruiComments;

?><div class="box box-primary direct-chat direct-chat-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            意见与点评
        </h3>
        <div class="box-tools pull-right">
            <span class="badge bg-light-blue" data-toggle="tooltip" title="3 New Messages">
                3
            </span>
            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                <i class="fa fa-minus">
                </i>
            </button>
            <button class="btn btn-box-tool" data-toggle="tooltip" data-widget="chat-pane-toggle" title="Contacts" type="button">
                <i class="fa fa-comments">
                </i>
            </button>
            <button class="btn btn-box-tool" data-widget="remove" type="button">
                <i class="fa fa-times">
                </i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style='height:330px'>
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
       $form = ActiveForm::begin(['action' => ['rest-report/send-comment', 'id'=>$model->id],'method'=>'post',]); 

       ?>
           
           <input type="hidden" name="MingruiComments[report_id]" value="<?=$model->id?>">

            <div class="input-group">
                <input class="form-control" name="MingruiComments[content]" 
                        placeholder="Type Message ..." type="text">
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-flat" type="submit">
                            评论
                        </button>
                    </span>
                </input>
            </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.box-footer-->
</div>