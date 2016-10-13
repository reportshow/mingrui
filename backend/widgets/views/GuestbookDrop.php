<?php
use backend\models\userMessage;

?>
<li class="header">你有 <?=count($message)?> 条新消息</li>
<li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
    <?php

$message = userMessage::format4web($message);
foreach ($message as $k => $msg) {

    $name   = $msg['name'];
    $avatar = $msg['avatar'];
    $content = $msg['content'];
    $createtime = $msg['createtime'];
    $url = $msg['url'];

    ?>
        <li><!-- start message -->
            <a href="<?=$url?>">
                <div class="pull-left">
                    <img src="<?=$avatar?>" style='width:30px;height:30px' class="img-circle" alt="User Image"  onerror="this.src='images/user2.png';"  />
                </div>
                <h4 style="font-size: 0.9em">
                    <?=$name?>
                    <small><i class="fa fa-clock-o"></i> <?=$createtime ?></small>
                </h4>
                <p> <?=$content?></p>
            </a>
        </li>
       <?php
}
?> <!-- end message -->
    </ul>
</li>
<li class="footer" style=' padding-top:0px; height: auto;  '><a href="#">清空</a></li>
