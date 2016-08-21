<?php
 

if($model['position'] != 'right'){
    

?>
<!-- Message. Default to the left -->
<div class="direct-chat-msg">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name pull-left">
            Alexander Pierce
        </span>
        <span class="direct-chat-timestamp pull-right">
            23 Jan 2:00 pm
        </span>
    </div>
    <!-- /.direct-chat-info -->
    <img alt="Message User Image" class="direct-chat-img" src="../dist/img/user1-128x128.jpg">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            Is this template really for free? That's unbelievable!
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
            Sarah Bullock
        </span>
        <span class="direct-chat-timestamp pull-left">
            23 Jan 2:05 pm
        </span>
    </div>
    <!-- /.direct-chat-info -->
    <img alt="Message User Image" class="direct-chat-img" src="../dist/img/user3-128x128.jpg">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            You better believe it!
        </div>
        <!-- /.direct-chat-text -->
    </img>
</div>
<!-- /.direct-chat-msg -->
<?php
}
?>