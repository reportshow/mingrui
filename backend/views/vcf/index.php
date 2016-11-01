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
        'options' => ['width' => '40px;'],

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
        'filter'     => ['male' => '男', 'female' => '女'],
        'options'    => ['width' => '60'],
    ],
    ['attribute' => 'age', 'options' => ['width' => '60']],
    ['attribute' => 'tel', 'options' => ['width' => '120']],
    ['attribute' => 'product', 'options' => ['width' => '100']],
    ['attribute' => 'diagnose', 'options' => ['width' => '100']],
    ['attribute' => 'gene', 'options' => ['width' => '90']],
    

    ['attribute' => 'pingjia',
        'label'      => '星级评价',
        'filter'     => MingruiPingjia::getSimpleArray(),
        'options' => ['width' => '90'],
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
$status = $model->getTaskStatus() == 'complete' ? '完成' : '处理中..';
return "<button class='btn'>$status</button>";
}],*/

    [
        'attribute' => 'vcf',
        'format'    => 'raw',
        'filter'    => '',
       'filterOptions'=>['data-toggle'=>'gridviewoprator'],
         'options'   => ['width' => '150px;'],
        'label'     => '操作',
        'value'     => function ($model) {
            $html ='';//. Html::a('下 载', ['vcf/download', 'id' => $model->id], ['class' => 'btn btn-info']);
            if ($model->getTaskStatus() == 'complete') {
                $status = '完成';
                $disable = '';
            } else {
                $status = '处理中';
                 $disable = 'disabled';
            }
            $html .= "<a class='btn btn-info $disable'>$status</a>";
            return $html;
        },
    ],

    ['class' => 'yii\grid\ActionColumn',
       'header' =>'操作',
       'options'       => [
                'width' => 80,
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
    .content-wrapper{overflow: auto}
    .disabled{background: #999;border:0px;}
</style>