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
                <span  style="float:right;cursor: pointer;padding-right:5px">
                  <i class="fa move2mypic fa-share-square-o"></i>
                </span>
                <span class="time " style="float:left;padding:3px 8px">
                  <i class="fa fa-clock-o"></i><?=$model->createtime?>
                </span>
                
            
            <h3 class="timeline-header" style="clear: both;padding-top: 0px"> <?=$model->title?>  ...</h3>

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
    $voices = json_decode($model->voice);
    if(count($voices))
    foreach ($voices  as $key => $voice) {
       $path = $model->voicePath($voice);    
?>

        <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <i class="fa  fa-wifi bg-yellow" 
        style="transform: rotate(90deg);-webkit-transform: rotate(90deg);"></i>
        <div class="timeline-item" style="margin-left:60px;margin-top:-10px; ">

            <audio src="<?=$path ?>" controls="controls" style='width:160px;margin:10px 0px 0px 10px'></audio>

            <div class="timeline-body" style="padding-right: 16px;">
                <div class="direct-chat-text bg-aqua "  >
                    <div class='btn-social' style="height: 30px;line-height: 30px;">
                     <i class='fa  fa-play-circle-o' style="cursor:pointer;margin-left:-5px;margin-top:-2px;"></i> <?=$voice->text?>
                    </div>
                </div>   
            </div>
 
        </div>
    </li>
    <!-- END timeline item -->
<?php 

 }//foreach

}else if($type=='image'){

/* Imglist::widget([
        'dataProvider' => $model, 
 ]);*/
?>
<!-- timeline item -->
            <li>
              <i class="fa fa-camera bg-purple"></i>

              <div class="timeline-item">
                 <span  style="float:right;cursor: pointer;padding-right:5px">
                  <i class="fa move2mypic fa-share-square-o"></i>
                 </span>
                <span class="time " style="float:left;padding:3px 8px">
                  <i class="fa fa-clock-o"></i><?=$model->createtime?>
                </span>

                <h3 class="timeline-header" style="clear: both;padding-top: 0px"> <?=$model->title?>  ...</h3>

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