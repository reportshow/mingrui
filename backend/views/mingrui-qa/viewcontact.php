<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiQa */

$this->title = '联系我们';
$this->params['breadcrumbs'][] = ['label' => 'Mingrui Qas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-qa-view">
   <style type="text/css">
        .widget-user-header{background-size: cover;height:140px;}
        .widget-user-username{font-family:'Microsoft Yahei';color:#fff;margin-left:30px;text-shadow:5px 5px 5px #333;}
   </style>
 
        <div class="col-md-5">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" style="background-image: url('images/1.png');">
              <div class="widget-user-image hidden">
                <img class="img-circle" src="images/tiananmen.jpg" style="width: 64px;height: 64px">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username" >北京金准基因科技有限责任公司</h3>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"> 北京金准基因科技有限责任公司 </a></li>
                <li><a href="#">电话： 010-53396195 </a></li>
                <li><a href="#">地址： 海淀区花园北路35号健康智谷9号楼602  </a></li>
                <li><a href="#"> 
                    <img src='images/map2.png'  width="100%"> 
                </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>


       <div class="col-md-5">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header" style="background-image: url('images/2.png');">
              <div class="widget-user-image hidden">
                <img class="img-circle" src="images/tiananmen.jpg" style="width: 64px;height: 64px">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username" >哈尔滨精准基因科技有限公司</h3>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"> 哈尔滨精准基因科技有限公司 </a></li>
                <li><a href="#">电话： 400-0451-836 </a></li>
                <li><a href="#">地址： 哈尔滨市渤海三路1号楼  </a></li>
                <li><a href="#"> 
                    <img src='images/map1.jpg' width="100%"> 
                </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>


          

</div>



 