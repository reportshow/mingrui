<?php

use backend\components\Functions;
use backend\widgets\DateInput;
use yii\grid\GridView;
use yii\helpers\Html;
use backend\models\MingruiPingjia;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$unfinished                    = Yii::$app->request->get('unfinished');
$this->title                   = '报告分类'; //$unfinished ? '未出报告' : '已出报告';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rest-report-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php $GridViewParam = [
    //'emptyCell'    => '搜索',
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
/*    'rowOptions'   => function ($model) {
$url = Yii::$app->urlManager->createUrl(['rest-report/view', 'id' => $model->id]);
return ['onclick' => "location.href='$url';", 'style'=>'cursor:pointer'];
},*/
    'columns'      => [
        [
            'class'   => 'yii\grid\SerialColumn',
            'options' => ['width' => '40px;'],
        ],

/*        [
'attribute' => 'id',
'options'   => ['width' => '60px;'],
],*/

/*
['attribute' => 'created',
'format' =>  ['date', 'php:Y-m-d h/i','currencyCode' => 'PRC',]
],*/
        [
            'attribute' => 'created',
            'value'     => function ($data) {
                $date = new DateTime($data->created);
                return $date->format('Y-m-d');

            },
            'filter'    => DateInput::widget(['attribute' => 'created', 'model' => $searchModel]),
            'options'   => ['width' => '120px;'],
        ],

        [
            'label'     => '姓名',
            'attribute' => 'username',
            'value'     => function ($model) {
                $sample = $model->sample;
                $name   = $sample->name;
                return $name;
                return mb_strlen($name) > 9 ? mb_substr($name, 0, 9) . '..' : $name;
            },
            'filter'    => Html::activeTextInput($searchModel, 'username', [
                'class' => 'form-control',
            ]),
            'options'   => ['width' => '120px;'],
        ], //<=====加入这句,

        /*  ['attribute' => 'sample.sex',
        'value'      => function ($model) {
        return $model->sample->sex == 'female' ? '女' : '男';
        }],*/
/*        [
'attribute' => 'sample.age',
'label'     => '年龄',
'value'     => function ($model) {
return $model->sample->age ? $model->sample->age : '-';
},
],*/

/*        [
'attribute' => 'report_id',
'options'   => ['width' => '120px;'],
],*/

        [
            'label'     => '检测项目',
            'attribute' => 'product_name',
            'value'     => 'product.name',
            'filter'    => Html::activeTextInput($searchModel, 'product_name', [
                'class' => 'form-control',
            ]),
            'options'   => ['width' => '120'],
        ], //<=====加入这句

        [
            'attribute'     => 'gene',
            'label'         => '基因型',
            'headerOptions' => ['width' => '120'],
        ],
        [
            'attribute' => 'linchuang',
            'label'     => '临床表型',
            'value'     => 'pingjia.linchuang',
            'options'   => ['width' => '150'],
        ],

        [
            'attribute'     => 'pingjia',
           // 'filter' => Html::activeDropDownList($searchModel, 'sex',['1'=>'男','0'=>'女'], ['prompt'=>'全部'] ),
           'filter'=>MingruiPingjia::getSimpleArray(),
            'value'         => function ($model) {
                $obj = $model->pingjia;
                if ($obj) {
                    // return MingruiPingjia::$pingjiaText[$obj->pingjia];
                }
            },
            'label'         => '星级评价',
            'headerOptions' => ['width' => '80'],
        ],

        /*[
        'attribute' => 'testmethod',
        'label'     => '方法',
        'value'     => function ($model) {
        if (strpos($model->report_id, 'NG') !== false) {
        return 'NGS';
        } else if (strpos($model->report_id, 'YD') !== false) {
        return 'PCR';
        } else {
        $template = $model->product->name;
        $mm       = ['_MLPA', '_CNV', 'PolyQ'];
        foreach ($mm as $m) {
        if (strpos($template, $m) !== false) {
        return substr($m, 1);
        }
        }
        return substr($template, 0, 5) . '...';
        }

        },
        ],*/

/*        [
'attribute' => 'tel1',
'label'     => '联系方式',
'value'     => function ($model) {
$tels = $model->sample->tel1;
//$list = explode('、', $tels);
//return str_replace(' ', '', $list[0]) . (count($list) > 1 ? '-等' : '');
$tels = str_replace(' ', '', $tels);
$tels = str_replace('-', '', $tels);
if (strlen($tels) > 11) {
$tels = substr($tels, 0, 11) . '...';
}
return $tels;
},
'filter'    => Html::activeTextInput($searchModel, 'tel', [
'class' => 'form-control',
]),
],*/

/*        ['attribute'=>'status',
'format'=>'raw',
'value'=>function($model){
return $model->status =='finished' ? '<span class="bg-primary" style="padding:3px">完成</span>':
'<span class="bg-gray" style="padding:3px">未出</span>';
},
'options'   => ['width' => '80px;'],
],*/
        //'status',
        // 'note:ntext',
        // 'assigner_id',
        // 'product_id',
        // 'complete',
        // 'cnvsqlite',
        // 'snpsqlite',
        // 'cnvsave:ntext',
        // 'snpsave:ntext',
        // 'finish',
        // 'xiafa',
        // 'analysis_id',
        // 'yidai_complete',
        // 'url:url',
        // 'yidai_note:ntext',
        // 'express',
        // 'express_no',
        // 'sample_id',
        // 'pdf',
        // 'conclusion',
        /*        ['label'        => '结论',
        'attribute'     => 'conclusion',
        'filter'        => ['阴性' => '阴性', '疑似阳性' => '疑似阳性', '阳性' => '阳性'],
        'format'        => 'raw',
        'value'         => 'conclusiontag',
        //or 'filter' => Html::activeDropDownList($searchModel, 'sex',['1'=>'男','0'=>'女'], ['prompt'=>'全部'] )
        'headerOptions' => ['width' => '100'],
        ],*/
        // 'explain:ntext',
        // 'jxyanzhen',
        // 'mut_type',
        // 'star',
        // 'template',
        // 'type',

        // 'ptype',
        // 'csupload',
        // 'family_id',
        // 'date',
        // 'abiresult:ntext',
        // 'snpexplain:ntext',
        // 'abiexported',
        // 'final_note:ntext',
        // 'assigner_note:ntext',
        // 'shenhe_date',
        // 'locked',
        // 'express_sent',
        // 'sale_marked',
        // 'time_stamp:ntext',
        // 'yidaifinished_date',
        // 'kyupload',
        // 'yidai_marked',

        /* ['class'   => 'yii\grid\ActionColumn',
        'template' => '{view} {000update} {000delete}',
        ],*/
        [   'label' => '操作',
            'options'    => ['width' => '120'],
            'format'     => 'raw',
            'value'      => function ($model) {
                $urlreport = Yii::$app->urlManager->createUrl(
                    ['rest-report/view', 'id' => $model->id]
                );
                $urldata = Yii::$app->urlManager->createUrl(
                    ['rest-report/analyze', 'id' => $model->id]
                );
                $reportStatus     = $model->status == 'finished' ? '' : 'disabled';
                $reportStatusText = $model->status == 'finished' ? '查报告' : '检测中';
                $dataStatus       = $model->snpsqlite ? '' : 'disabled';
                $dataStatuseText  = strpos($model->report_id, 'YD') !== false ? '无数据' : '查数据';
                $html             = "<a href='$urlreport' class='btn btn-info $reportStatus'>$reportStatusText</a>";
                if (!Functions::ismobile()) {
                    $html .= "<a href='$urldata' class='btn btn-info  $dataStatus'>$dataStatuseText</a>";
                }

                return $html;
            }],

    ],
];

if (Functions::ismobile()) {

    $GridViewParam['rowOptions'] = function ($model) {
        $url = Yii::$app->urlManager->createUrl(['rest-report/view', 'id' => $model->id]);
        return ['onclick' => "location.href='$url';", 'style' => 'cursor:pointer'];
    };
}
//$GridViewParam['filterPosition'] = GridView::FILTER_POS_FOOTER;

echo GridView::widget($GridViewParam);

?>
</div>
<style type="text/css">
    .content-wrapper{overflow: auto}
    .disabled{background: #999;border:0px;}
</style>