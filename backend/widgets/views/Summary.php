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
        <?=Html::a('上传图片', ['mingrui-attachment/', 'reportid' => $model->id], [
            'class' => 'pull-right badge bg-green', 'style' => "padding:8px",
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
         <li>
          <a href="#">OMIM描述:</a><br/>
	  <?php
          foreach($omims as $omim){
               echo $omim->gene . ":" .
               "<a target=\"_blank\" href=\"http://www.omim.org/clinicalSynopsis/$omim->omim_id\">" .
               "<span style=\"color: blue !important; text-decoration: underline !important;\">" . $omim->synopsis . "</span>" .
               "</a>";
               echo "<br/>";
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
       
