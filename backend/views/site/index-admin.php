<?php
$this->title = '控制面板';
$this->params['breadcrumbs'][] = $this->title ;

use backend\assets\AppAsset;  
use backend\widgets\ChartLine;
use backend\widgets\ChartLine2;
use backend\widgets\NumberBox;
use backend\components\Functions;

use backend\models\Status;

AppAsset::register($this); 
//$this->registerJsFile('@web/js/chart.min.js',['depends'=>['backend\assets\AppAsset']]);  
$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 


$Status = new Status();
$count  = $Status->count;

$userCount = $Status->userCount;
echo "<!-- ";
var_dump($userCount );
echo "-->";
?>
<script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/echarts-all-3.js"></script>

    <!-- Main content -->
    <section class="content">


      <!-- Small boxes (Stat box) -->
      <div class="row">        
         
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'医生', 'link'=>Functions::url(['rest-client/index']), 'number'=>$count['doctor'], 'bgcolor'=>'aqua','icon'=>'fa fa-user-md']);  ?>
          </div> 
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'患者', 'link'=>Functions::url(['restsample/index']), 'number'=>$count['sick'] ,'bgcolor'=>'green','icon'=>'person']);  ?>
          </div> 
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'已报告', 'link'=>Functions::url(['utils/msg','msg'=>'当前页面需要设计！']), 'number'=>$count['finish'], 'bgcolor'=>'yellow','icon'=>'stats-bars']);  ?>
          </div>
          <div class="col-lg-3 col-xs-6">
            <?= NumberBox::widget( ['tag'=>'分析中', 'link'=>Functions::url(['utils/msg','msg'=>'当前页面需要设计！']), 'number'=>$count['unfinish'], 'bgcolor'=>'red','icon'=>'android-time']);  ?>
          </div>
        
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">


          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
           
            <div class="tab-content no-padding"> 
              <div   id="user-chart" style=" height: 300px;"> </div>
              <div   id="total-chart" style=" height: 300px;"> </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

    
 

    
        </section>
        <!-- /.Left col -->
  
      </div>
      <!-- /.row (main row) -->

    </section>



 <script type="text/javascript">
 <?php
$daily  =$userCount['daily'];
$keys = json_encode( ($daily['label']));
$values = json_encode( ($daily['daily']));
 ?>
var dom = document.getElementById("user-chart");
var myChart = echarts.init(dom);
var app = {};
option = null;
option = {
    title: {
        text: '每日用户增长数'
    },
    tooltip: {},
    legend: {
        data:['每日用户']
    },
    xAxis: {
        data: <?=$keys ?>
    },
    yAxis: {},
    series: [{
        name: '每日用户',
        type: 'bar',
        data: <?=$values?>
    } 
    ]
};;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}

  </script>



   <script type="text/javascript">
 <?php
$totalobj  =$userCount['total'];
$keys = json_encode(array_values($totalobj['label']));
$totals = json_encode(array_values($totalobj['total']));
$doctors = json_encode(array_values($totalobj['doctor']));
$guest = json_encode(array_values($totalobj['guest']));
 ?>
var dom = document.getElementById("total-chart");
var myChart = echarts.init(dom);
var app = {};
option = null;
option = {
    title: {
        text: '总用户数曲线'
    },
    tooltip: {},
    legend: {
        data:['总用户数','医生数', '患者数']
    },
    xAxis: {
        data: <?=$keys ?>
    },
    yAxis: {},
    series: [{
	        name: '总用户数',
	        type: 'line',
	        data: <?=$totals?>
	    }, {
	        name: '医生数',
	        type: 'line',
	        data: <?=$doctors?>
	    },
	    {
	        name: '患者数',
	        type: 'line',
	        data: <?=$guest?>
	    },
    ]
};;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}

  </script>


<?php  include('modulescount.php'); ?>