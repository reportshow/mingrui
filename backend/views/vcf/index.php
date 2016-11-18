<?php

use backend\models\MingruiPingjia;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiVcfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '外源数据分析';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-vcf-index">
<style type="text/css">
    .content-wrapper{overflow: auto}
</style>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('上传VCF文件', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?php

$columns = [
    ['class'  => 'yii\grid\SerialColumn',
        'options' => ['width' => '40'],

    ],
    /*['attribute' => 'id', 'options' => ['width' => '60px;']],*/

    ['attribute' => 'creator_name', 'label' => '上传者', 'options' => ['width' => '100px;'],
        'value'      => function ($model) {
            return $model->creator->nickname;
        }],

    ['attribute' =>'sick', 
    'options' => ['width' => '90']
    ], //患者姓名

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
    'options' => ['width' => '120']
    ],    
    
   
    ['attribute' => 'pingjia',
        'label'      => '星级评价',
        'filter'     => MingruiPingjia::getSimpleArray(),
        'options' => ['width' => '100'],
        'value'      => function ($model) {
           $pingjiaList = MingruiPingjia::getSimpleArray();
            $index= $model->pingjia  ;
            if($index=='')return "";
            return $pingjiaList[$index];
        }
    ],

/*    ['attribute' => 'vcf',
'format'     => 'raw',
'options'    => ['width' => '90px;'],
'label'      => 'vcf文件',
'value'      => function ($model) {
return Html::a('下载VCF', ['vcf/download', 'id' => $model->id], ['class' => 'btn btn-info']);
}],

['attribute' => 'status',
'format'     => 'raw',
'options'    => ['width' => '90px;'],
'label'      => 'vcf状态',
'value'      => function ($model) {
   if( $model->getTaskStatus() == 'complete'){      
       return "<button class='btn'>完成</button>";
   }else{
       return "<button class='btn btn-info' disabled=disabled>处理中..</button>";
   }
}],*/

/*    [
        'attribute' => 'vcf',
        'format'    => 'raw',
        'filter'    => '',
       'filterOptions'=>['data-toggle'=>'gridviewoprator'],
         'options'   => ['width' => '150px;'],
        'label'     => '操作',
        'value'     => function ($model) {
            
        },
    ],*/

    ['class' => 'yii\grid\ActionColumn',
       'header' =>'操作',
       'template' => '{viewvcf}  ',
       'buttons' => [
            'viewvcf' => function ($url, $model, $key) {                 
                 $html ='';//. Html::a('下 载', ['vcf/download', 'id' => $model->id], ['class' => 'btn btn-info']);
                    if ($model->getTaskStatus() == 'complete') {
                        $status = '查数据'; 
                        $dataBtn = Html::a($status, 
                            ['vcf/view','id'=>$model->id],
                            ['title' =>'查看数据', 'class'=>'btn btn-info'] );
                    } else {
                        $status = '处理中'; 
                        $dataBtn  = "<a class='btn btn-info disabled'>$status</a>";
                    }
                    
                    $viewBtn  = Html::a('查信息', 
                            ['vcf/view','id'=>$model->id,'detail'=>'only'],
                            ['title' =>'查看基本信息', 'class'=>'btn btn-info'] );;

                    return $dataBtn .   $viewBtn ;

              },
            ],
       'options'       => [
                'width' => 140,
            ],
      /*'filter'=>Html::submitButton('搜索', ['class' => 'btn btn-primary']) 
            .Html::resetButton('恢复', ['class' => 'btn btn-default rest']) ,
        */    
   ],
];

if (!Yii::$app->user->can('admin')) {
    array_splice($columns, 1, 1);
}

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => $columns,
]);

?>
</div>

<style type="text/css">
    .content{overflow: auto}
    .disabled{background: #999;border:0px;}
</style>