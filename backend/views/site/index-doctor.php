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
use backend\models\Sitepage;


AppAsset::register($this); 
//$this->registerJsFile('@web/js/chart.min.js',['depends'=>['backend\assets\AppAsset']]);  
$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 


$tongji = Sitepage::doctorTongji();
$news = Sitepage::docContent('news');
$newsContent = '';
foreach ($news as $key => $new) {
  $newsContent .="<li><a href=''>".$new->title."</a></li>";
}

$ziliao = Sitepage::docContent('doc');
$ziliaoContent = '';
foreach ($ziliao as $key => $liao) {
  $ziliaoContent .="<li><a href=''>".$liao->title."</a></li>";
} 

$guides = Sitepage::docContent('guide');
$guidesContent = '';
foreach ($guides as $key => $guide) {
  $guidesContent .="<li><a href=''>".$guide->title."</a></li>";
} 

?>

    <!-- Main content -->
    <section class="content " id='homepage'>


      <!-- Small boxes (Stat box) -->
      <div class="row">        
        <div class="col-lg-10" style="overflow:hidden;">
           <?php include('index-guest-flow.php');?>

        </div> 
        <div class="col-lg-2">        
            <div  >
            <?php   echo NumberBox::widget( [
               'tag'=>'上次登录时间', 'number'=>'<h4>'.date('Y-m-d H:i:s',time()-1000).'</h4>', 
               'bgcolor'=>'aqua','icon'=>'fa fa-user-md',
              'link'=>['上次登录时间'=>'']
              ]); 
              ?>
            </div> 

            <div  >
              <?= NumberBox::widget( [
                'tag'=>'已报告', 'number'=>$tongji['done'],
               'bgcolor'=>'yellow','icon'=>'stats-bars',
               'link'=>['已报告'=>Functions::url(['rest-report/index'])] 
               ]);  ?>
            </div>
            <div >
              <?= NumberBox::widget( [
                'tag'=>'分析中', 'number'=>$tongji['ongoing'], 'bgcolor'=>'red','icon'=>'android-time',
                'link'=>['分析中'=>Functions::url(['rest-report/index']) ],
                ]);  ?>
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
                  'news' => ['icon' => 'th', 'active'=>true ,'name'=>'新闻','content' => $newsContent],
                  'news2' => ['icon' => 'th', 'name'=>'资料','content' => $ziliaoContent],
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
                <?=$guidesContent ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
