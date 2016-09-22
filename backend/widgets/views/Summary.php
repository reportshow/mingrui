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
        <li><a href="#">日期：<?=$model->created?></a></li>
        <li><a href="#">主诉：<?=$model->sample->symptom?></a></li>
        <li><a href="#">项目：<?=$model->product->name?></a></li>                 
        <li><a href="#">注释：<?=$model->explainsummary?>
         </a></li>
        <li style="padding:10px 0px 10px 16px;">
        编号：<?=$model->report_id?>
        <?=Html::a('查看报告详情', ['show-report', 'id' => $model->id], [
            'class' => 'pull-right badge bg-green', 'style' => "padding:8px",
          ])?>
         </li>
        <li><a href="#">此基因相关的疾病：<br/><?= "$diseases"?>
        <li style="padding:10px 0px 10px 16px;"> 
           完善资料: 
           <?php 
           if(!empty($model->attachments))
           foreach ($model->attachments as $key => $value) {
             echo "<span class='badge bg-aqua'  >$key</span>";
           } 
           ?>

           <?=Html::a('管理', ['mingrui-attachment/', 'id' => $model->id], [
              'class' => 'pull-right badge bg-aqua',  
          ])?>

         
          </li>
      </ul>
    </div>
  </div>
  <!-- /.widget-user -->
       