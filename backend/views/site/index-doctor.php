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
use yii\helpers\Html;

AppAsset::register($this); 
//$this->registerJsFile('@web/js/chart.min.js',['depends'=>['backend\assets\AppAsset']]);  
$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 


$tongji = Sitepage::doctorTongji();
$news = Sitepage::docContent('news');
$newsContent = '';
foreach ($news as $key => $new) {
  $link = Html::a($new->title, ['/mingrui-doc/view','type'=>'news', 'id' => $new->id],[]) ;
  $newsContent .="<li> $link </li>";
}
//http://news.baidu.com/ns?word=%E5%9F%BA%E5%9B%A0&tn=newsfcu&from=news&cl=2&rn=10&ct=0
//


$ziliao = Sitepage::docContent('doc');
$ziliaoContent = '';
foreach ($ziliao as $key => $liao) {
  $link = Html::a($liao->title, ['/mingrui-doc/view','type'=>'doc', 'id' => $liao->id],[]) ;
  $ziliaoContent .="<li> $link </li>";
} 

$guides = Sitepage::docContent('guide');
$guidesContent = '';
foreach ($guides as $key => $guide) {
   $link = Html::a($guide->title, ['/mingrui-doc/view','type'=>'guide', 'id' => $guide->id],[]) ;
  $guidesContent .="<li> $link </li>";
} 

?>

    <!-- Main content -->
<div id='homepage' style="max-width: 1100px">


      <!-- Small boxes (Stat box) -->
      <div class="row">        
        <div class="col-lg-10" style="overflow:hidden;">
           <?php include('index-guest-flow.php');?>

        </div> 
        <div class="col-lg-2">        
            <div  class='col-lg-12 col-xs-4'>
            <?php   
              $time = "<div style='font-size:2rem'>". date('H:i:s',time()-1000) ."</div>";
              $date = "<div style='font-size:1.5rem'>".date('Y-m-d',time()) ."</div>";
              echo NumberBox::widget( [
               'tag'=>'上次登录时间', 'number'=>" $date  $time ", 
               'bgcolor'=>'aqua','icon'=>'fa fa-user-md',
              'link'=>['上次登录时间'=>'']
              ]); 
              ?>
            </div> 

            <div    class='col-lg-12 col-xs-4'>
              <?= NumberBox::widget( [
                'tag'=>'已报告', 'number'=>$tongji['done'],
               'bgcolor'=>'yellow','icon'=>'stats-bars',
               'link'=>['已报告'=>Functions::url(['rest-report/index'])] 
               ]);  ?>
            </div>
            <div    class='col-lg-12 col-xs-4'>
              <?= NumberBox::widget( [
                'tag'=>'分析中', 'number'=>$tongji['ongoing'], 'bgcolor'=>'red','icon'=>'android-time',
                'link'=>['分析中'=>Functions::url(['rest-report/index']) ],
                ]);  ?>
            </div>



        </div>
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row" style="margin-top:0px">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">

         <style type="text/css">
           .tab-content{height:200px;}
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
            <div class="box-header with-border"  >
              <i class="fa fa-gg"></i><h3 class="box-title">应用指南</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="height:200px">
                <?=$guidesContent ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

</div>
