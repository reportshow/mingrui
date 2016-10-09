 
<li class="header">你有 <?=count($message) ?> 条新消息</li>
<li>
    <!-- inner menu: contains the actual data -->
    <ul class="menu">
    <?php
     foreach($message as $k=>$msg){

        $name = '';
        if($msg->creator){
            $name = $msg->creator->nickname;
            $avatar = $msg->creator->avatar;
        }

    ?>
        <li><!-- start message -->
            <a href="#">
                <div class="pull-left">
                    <img src="<?=$avatar ?>" style='width:30px;height:30px' class="img-circle" alt="User Image"/>
                </div>
                <h4 style="font-size: 0.9em">
                    <?=$name ?>
                    <small><i class="fa fa-clock-o"></i> <?=date('Y-m-d H:i',$msg->createtime)?></small>
                </h4>
                <p> <?=$msg->content ?></p>
            </a>
        </li>
       <?php
       }
       ?> <!-- end message --> 
    </ul>
</li>
<li class="footer" style=' padding-top:0px; height: auto;  '><a href="#">清空</a></li>
             