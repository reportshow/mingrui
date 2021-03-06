<?php
use yii\helpers\Html;


?>
 


  <!-- Widget: user widget style 1 -->
  <div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-yellow">
      <div class="widget-user-image">
        <img class="img-circle" src="images/user2.png" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username"><?=$model->sample->name?></h3>
      <h5 class="widget-user-desc">检测者
      （<?= $model->sample->sex =='male' ? '男': '女' ?>，<?=$model->sample->age?>）</h5>
    </div>
    <div class="box-footer no-padding">
      <ul class="nav nav-stacked">
         <li style="padding:10px 0px 10px 16px;">
        项目编号：<?=$model->report_id?>
        <?=Html::a('上传图片 ', ['mingrui-attachment/', 'reportid' => $model->id], [
            'class' => 'pull-right   btn-success uploadimg', 'style' => "",
          ])?>
         </li>
          <li><a href="#">报告日期：<?=$model->created?></a></li>

        <li><a href="#">临床症状：<?=$model->sample->symptom?></a></li>
        <li><a href="#">检查项目：<?=$model->product->name?></a></li>                 
        <li><a href="#">检测结果：<?=$model->explainsummary?>
         </a></li>
        <li><a href="#">详细解读：<?=$model->explaindescription?>
         </a></li>
        <li style="padding:10px 0px 10px 16px;display:none"> 
           完善资料: 
           <?php 
           if(!empty($model->attachments))
           foreach ($model->attachments as $key => $value) {
             echo "<span class='badge bg-aqua'  >$key</span>";
           } 
           ?>

           <?=Html::a('管理', ['mingrui-attachment/', 'reportid' => $model->id], [
              'class' => 'pull-right badge bg-aqua',  
          ])?>

         
          </li>
         <?php  
           if(Yii::$app->user->can('doctor') ||Yii::$app->user->can('admin')){
          ?>
         <li class="omim">
          OMIM描述:<br/>
	  <?php
          foreach($omims as $omim){
               echo $omim->gene . ":" .
               "<a target='_blank' href='http://www.omim.org/clinicalSynopsis/{$omim->omim_id}'>" 
                . $omim->synopsis . 
               "</a><br/>";               
          }
	  ?>
	 </li>
	 <?php  
            }
	    ?>
      </ul>
    </div>
  </div>
  <!-- /.widget-user -->

<style type="text/css">
  li.omim{
    padding:10px 15px;
        white-space: nowrap !important;
    overflow: hidden;
    text-overflow: ellipsis;
    word-break: keep-all;
  }
  li.omim a{display: inline;
   color: blue !important; 
   padding-left:5px;
 }
 .nav>li.omim>a:hover{
  text-decoration:underline !important;
  background:none !important;
}
</style>

