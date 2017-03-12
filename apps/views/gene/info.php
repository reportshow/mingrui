<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

include_once('header.php');

?> 

 <div class="row">
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-yellow">
           <b class='btn btn-success pull-right'><?=$model->gene?></b>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username-x"><?=$model->sick?></h3>
          <h5 class="widget-user-desc-x"><?=$model->sick_en?></h5>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li><a href="#">遗传方式 <span class="pull-right badge-x bg-blue-x"> <?=$model->method ?></span></a></li>
            <li><a href="#">OMIM <span class="pull-right badge-x bg-aqua-x"> <?=$model->omim ?> </span></a></li>
            <li><a href="#">refseq <span class="pull-right badge-x bg-green-x"><?=$model->refseq ?> </span></a></li>
            <li><a href="#">DM <span class="pull-right badge-x bg-red-x"><?=$model->DM ?></span></a></li>
          </ul>
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
</div>



 <script>
 function showsub(id){  
	location.href= "?r=gene/subinfo&subid="+id;

}
 </script>