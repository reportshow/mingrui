<?php
use backend\widgets\Attachments;


echo Attachments::begin( );
?>
<ul class="timeline" style="margin-left: 10px;">
<?php

foreach ($models as $key => $model) {
     
     $time = date('Y-m-d H:i', $model->createtime);

    ?>
<!-- timeline item -->
            <li>
              <i class="fa fa-image bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$time?></span>

                <h3 class="timeline-header"> <?=$model->title?>  ...</h3>

                <div class="timeline-body">

                <?= Attachments::widget(['model'=>$model]);   ?>

                </div>
                <div class="timeline-footer">
                   <?=$model->description?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
<?php
} //foreach ($models

?>
</ul> 