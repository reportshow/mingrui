<?php

use yii\grid\GridView;
use yii\helpers\Html;
use backend\models\MingruiPingjia;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiReportstoreResearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '外源报告';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-reportstore-index">
<style type="text/css">
    .content-wrapper{overflow: auto}
</style>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?=Html::a('上传外源报告', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        ['class' => 'yii\grid\SerialColumn', 'options' => ['width' => '40']],

       // 'id',
        //'uid',
      
        ['attribute' =>'sick',
    'options' => ['width' => '100']
    ], 
 
   
     ['attribute' => 'sex',
        'filter'     => [''=>'全部','male' => '男', 'female' => '女'],
        'options'    => ['width' => '60'],
        'value'=>function($model){
            if( $model->sex =='female') return '女';
            if( $model->sex =='male') return '男';
        }
    ], 
    
    ['attribute' => 'age', 
    'options' => ['width' => '100']],
    
   
    //['attribute' => 'tel',    'options' => ['width' => '120']],
   
        
    ['attribute' => 'product', 
    'options' => ['width' => '100']
    ],
   
     ['attribute' =>'gene',
    'options' => ['width' => '120']
    ],    
     ['attribute' =>'diagnose',
    'options' => ['width' => '180']
    ],    
     
     ['attribute' => 'pingjia',
      'label'      => '星级评价',
       
         'filter'     => MingruiPingjia::getSimpleArray(),
          'options' => ['width' => '100'],
         'value'=>function($model){
            $pingjiaList = MingruiPingjia::getSimpleArray();
            $index= $model->pingjia  ;
            if($index=='')return "";
            return $pingjiaList[$index];
         }
      ],
        // 'attachements:ntext',
        // 'createtime',

 /*       ['class' => 'yii\grid\ActionColumn',
         'template' => '{view} {update}',
        'filterOptions'=>['data-toggle'=>'gridviewoprator'],
        ],*/
        ['label'=>'操作',
        'format'=>'raw',
         'value'=>function($model){
            $reportStatus = '';
            if(strlen($model->attachements)  < 5){
                $reportStatus = 'disabled';
            }
            $html = Html::a('查看报告',['reportstore/viewreport','id'=>$model->id],['class'=>'btn btn-info ' .$reportStatus]);
            $html .= Html::a('详情',['reportstore/view','id'=>$model->id],['class'=>'btn btn-info']);
            return $html;
         }]
    ],
]);?>
</div>

<style type="text/css">
    .content-wrapper{overflow: auto}
    .disabled{background: #999;border:0px;}
</style>