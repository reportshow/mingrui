<?php
 

if($model['position'] != 'right'){
    

?>
<!-- Message. Default to the left -->
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left">
            <?=$model->creator->nickname?>
        </span>
        <span class="direct-chat-timestamp pull-right">
           <?=date('Y-m-d H:i:s',$model->createtime) ?>
        </span>
    </div>
    <!-- /.direct-chat-info -->
    <img alt="Message User Image" class="direct-chat-img" src="images/user1-128x128.jpg">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            <?=$model->content?>
        </div>
        <!-- /.direct-chat-text -->
    </img>
</div>
<!-- /.direct-chat-msg -->
<?php

}else{ //right     

?>
<!-- Message to the right -->
<div class="direct-chat-msg right">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-right">
            <?=$model->creator->nickname?>
        </span>
        <span class="direct-chat-timestamp pull-left">
             <?=date('Y-m-d H:i:s',$model->createtime) ?>
        </span>
    </div>
    <!-- /.direct-chat-info -->
    <img alt="Message User Image" class="direct-chat-img" src="images/user8-128x128.jpg">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            <?=$model->content?>
        </div>
        <!-- /.direct-chat-text -->
    </img>
</div>
<!-- /.direct-chat-msg -->
<?php
}
?>