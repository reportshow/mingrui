<ul class="timeline" style="margin-left: 10px;">
<?php

foreach ($models as $key => $model) {
    # code...

    $images = explode(';', $model->images);
    $time = date('Y-m-d H:i',$model->createtime)

?>
<!-- timeline item -->
            <li>
              <i class="fa fa-image bg-purple"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$time?></span>

                <h3 class="timeline-header"> <?=$model->title?>  ...</h3>

                <div class="timeline-body">
                <?php 
                foreach ($images as $key => $image) {
                    # code...

                    echo "<img src='{$image}'   class='margin' style='cursor:pointer;width:120px'>";

                }?>
                </div>
                <div class="timeline-footer">
                   <?=$model->description?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
<?php
} //


?>
</ul>
<style type="text/css">
  .previewbg{
    background: rgba(0,0,0,0.5);
   display: none;  
    top:0px;left:0px;width: 100%;height: 100%;
    z-index: 11111;
    position: fixed;
   
 }
  .previewbox{     position: absolute;   -webkit-transition:all 1s; 
   -webkit-transform:scale(0);    width: 100%;
    height: 100%;
  }
  .previewbox img{width: 100%; top: 50%;      position: absolute;  transform: translateY(-50%);}
  .zoomIn .previewbox{ 
    -webkit-transform:scale(1);
  }
 .zoomOut .previewbox{ 
    -webkit-transform:scale(0);
  }
</style> 
<div class='previewbg'>
    <div class=previewbox>
        <img src='images/1.png'>
    </div>
</div>
<script type="text/javascript">
    $('.timeline-body img').click(function(){
       var imgurl = $(this).attr('src');
       $('.previewbg').fadeIn();
          $('.previewbg .previewbox img').attr('src',imgurl);
         $('.previewbg').removeClass('zoomOut').addClass('zoomIn');
    });
    $('.previewbg').click(function(){ 
         $('.previewbg').removeClass('zoomIn').addClass('zoomOut');
         $('.previewbg').fadeOut();
    });
</script> 