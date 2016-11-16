<?php
$this->title = '控制面板';
$this->params['breadcrumbs'][] = $this->title ;

use backend\assets\AppAsset;  
use backend\widgets\ChartLine;
use backend\widgets\ChartLine2;
use backend\widgets\NumberBox;

use backend\models\Status;

AppAsset::register($this); 
//$this->registerJsFile('@web/js/chart.min.js',['depends'=>['backend\assets\AppAsset']]);  
$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 


$Status = new Status();
$count  = $Status->count;
//var_dump($count );
?>

    <!-- Main content -->
    <section class="content">


      <!-- Small boxes (Stat box) -->
      <div class="row">        
         
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'医生', 'number'=>$count['doctor'], 'bgcolor'=>'aqua','icon'=>'fa fa-user-md']);  ?>
          </div> 
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'患者', 'number'=>$count['sick'] ,'bgcolor'=>'green','icon'=>'person']);  ?>
          </div> 
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'已报告', 'number'=>$count['finish'], 'bgcolor'=>'yellow','icon'=>'stats-bars']);  ?>
          </div>
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'分析中', 'number'=>$count['unfinish'], 'bgcolor'=>'red','icon'=>'android-time']);  ?>
          </div>
        
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">


          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#revenue-chart" data-toggle="tab">趋势</a></li>
              <li><a href="#sales-chart" data-toggle="tab">分布</a></li>
              <li class="pull-left header" style='font-weight: normal;font-size: 12pt'>
                <i class="fa fa-users"></i> 用户
              </li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
              <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

    
 

    
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-active">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">报告</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Mail-Orders</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">In-Store</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->

           

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
