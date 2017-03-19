<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

$this->title = $model->sick;

include_once('header.php');

//var_dump($model->omiminfo->chpo);exit;
?> 

 <div class="row">
    <div class="col-md-4">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
           <b class='btn btn-success pull-right'><?=$model->gene?></b>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username-x"><?=$model->sick?></h3>
          <h5 class="widget-user-desc-x"><?=$model->sick_en?></h5>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
             <li><a href="#"><?=$model->omiminfo->chpo ?></a></li>

            <li><a href="#">遗传方式 <span class="pull-right badge-x bg-blue-x"> <?=$model->method ?></span></a></li>
            <li><a href="#">OMIM <span class="pull-right badge-x bg-aqua-x"> <?=$model->omim ?> </span></a></li>
            <li><a href="#">外显子 <span class="pull-right badge-x bg-aqua-x"> <?=$model->wide ?> </span></a></li>
            <li><a href="#">refseq <span class="pull-right badge-x bg-green-x"><?=$model->refseq ?> </span></a></li>
            <li><a href="#">DM <span class="pull-right badge-x bg-red-x"><?=$model->DM ?></span></a></li>
          </ul>
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
</div>


 <div class="row">
		<div class="col-md-4">
          <div class="box box-blue box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?=$model->gene?>基因相关</h3></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <ul class="nav nav-stacked"> <?php 
              foreach ($model->otherinfo as $key => $info) { ?>
              	 
              	  
		            <li style="display:block;border:none">
		               <a href="#">  <span class=" "> <?=$info->diseaseID ?> </span></a>
		             </li> 
		            <li style="padding:0px 5px 15px 15px;color:#666;"> <b>HPO表型:</b> &nbsp;<?=$info->chpo ?>  </li>
		        

             <?php }
              ?> </ul> 

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>

 

 <script>
 function showsub(id){  
	location.href= "?r=gene/subinfo&subid="+id;

}
 </script>