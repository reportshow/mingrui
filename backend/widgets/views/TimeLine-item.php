<?php

use backend\widgets\Imglist;
use backend\widgets\Attachments;


echo Attachments::begin( );




$type=$model->type;
if($type=='text'){?>
    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa fa-envelope bg-aqua"></i>
        <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i><?=$model->createtime?></span>

            <h3 class="timeline-header"> <?=$model->title?>  ...</h3>

            <div class="timeline-body">
                <?=$model->content?>

                
               
                

            </div>

            <div class="timeline-footer" style="display: none">
                <a class="btn btn-primary btn-xs">...</a>
            </div>
        </div>
    </li>
    <!-- END timeline item -->

<?php 
}else if($type=='voice'){
?>

        <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa  fa-wifi bg-yellow" 
        style="transform: rotate(90deg);-webkit-transform: rotate(90deg);"></i>
        <div class="timeline---item" style="margin-left:60px;margin-top:-10px; ">

            <!--span class="time"><i class="fa fa-clock-o"></i><?=$model->createtime?></span-->

             <div class="timeline-body" style="padding-right: 16px;">
                <div class="direct-chat-text bg-aqua "  >
                    <div class='btn-social' style="height: 30px;line-height: 30px;">
                     <i class='fa  fa-play-circle-o' style="cursor:pointer"></i> <?=$model->content?>
                    </div>
                </div>   
            </div>
 
        </div>
    </li>
    <!-- END timeline item -->
<?php 
}else if($type=='image'){

/* Imglist::widget([
        'dataProvider' => $model, 
 ]);*/
?>
<!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$model->createtime?></span>

                <h3 class="timeline-header"> <?=$model->title?>  ...</h3>

                <div class="timeline-body">

                <?= Attachments::widget(['model'=>$model]);   ?>

                <?php 
                /*foreach ($model->images as $key => $image) {
                    # code...
                
                   echo "<img src='{$image}'  width=120 class='margin'>";
               
                } */
                ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
<?php 
}