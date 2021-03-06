<?php

//use Yii;

?>
<li class="header">你有 <?=count($message)?> 条新消息</li>
<li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
    <?php
foreach ($message as $k => $msg) {

    $name = '';
    if ($msg->creator) {
        $name   = $msg->creator->nickname;
        $avatar = $msg->creator->avatar;
    }
    $report_id = $msg->report_id;

    if (is_numeric($report_id)) {
        $url = Yii::$app->urlManager->createUrl(['/rest-report/view', 'id' => $report_id]);
    } else {
        //留言板
        $url = Yii::$app->urlManager->createUrl(['/guestbook/view', 'id' => $report_id]);
    }

    ?>
        <li><!-- start message -->
            <a href="<?=$url?>">
                <div class="pull-left">
                    <img src="<?=$avatar?>" style='width:30px;height:30px' class="img-circle" alt="User Image"/>
                </div>
                <h4 style="font-size: 0.9em">
                    <?=$name?>
                    <small><i class="fa fa-clock-o"></i> <?=date('Y-m-d H:i', $msg->createtime)?></small>
                </h4>
                <p> <?=$msg->content?></p>
            </a>
        </li>
       <?php
}
?> <!-- end message -->
    </ul>
</li>
<li class="footer" style=' padding-top:0px; height: auto;  '><a href="#">清空</a></li>
