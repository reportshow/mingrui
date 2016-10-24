<?php
$this->title = '控制面板';
$this->params['breadcrumbs'][] = $this->title ;

use backend\assets\AppAsset;  
use backend\widgets\ChartLine;
use backend\widgets\ChartLine2;
use backend\widgets\NumberBox;
use backend\widgets\NavTabs;
use backend\models\RestReport;
use backend\components\Functions;

AppAsset::register($this); 
//$this->registerJsFile('@web/js/chart.min.js',['depends'=>['backend\assets\AppAsset']]);  
$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 

$query = RestReport::find();
$query = $query->where(['<>', 'ptype', 'yidai']); 
$query = $query->joinWith(['sample']);
$doctor_id = Yii::$app->user->Identity->role_tab_id;
$query = $query->where(['rest_sample.doctor_id' => $doctor_id]);

$total = $query->count();
$done = $query->andWhere(['rest_report.status' => 'finished'])->count();

?>

    <!-- Main content -->
    <section class="content">


      <!-- Small boxes (Stat box) -->
      <div class="row">        
        <div class="col-lg-9" style="height:420px;overflow:hidden;">
           <?php include('index-guest-flow.php');?>

        </div>
        <div class="col-lg-3">        
            <div  >
            <?= NumberBox::widget( ['tag'=>'上次登录时间', 'number'=>'<h4>'.date('Y-m-d H:i:s',time()-1000).'</h4>', 'bgcolor'=>'aqua','icon'=>'fa fa-user-md']);  ?>
            </div> 
            <div  >
              <?= NumberBox::widget( ['tag'=>'已报告', 'number'=>$done,
               'bgcolor'=>'yellow','icon'=>'stats-bars','link'=>Functions::url(['rest-report/index']) 
               ]);  ?>
            </div>
            <div >
              <?= NumberBox::widget( ['tag'=>'分析中', 'number'=>$total-$done, 'bgcolor'=>'red','icon'=>'android-time','link'=>Functions::url(['rest-report/index']) ]);  ?>
            </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

         <style type="text/css">
           .tab-content{height:300px;}
           .content-header{display: none}
         </style> 
        <?=NavTabs::widget([
          'icon'=>'chrome',  
          'header'=>'最新资讯',
          'position'=>'right',
          'data'=> [
                  'news' => ['icon' => 'th', 'active'=>true ,'name'=>'新闻','content' => '新闻'],
                  'news2' => ['icon' => 'th', 'name'=>'资料','content' => '资料'],
                  ]
        ])?>
        
    
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">
 
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-street-view"></i>

              <h3 class="box-title">应用指南</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height:300px">
                
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
