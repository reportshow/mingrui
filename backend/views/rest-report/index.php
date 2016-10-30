<?php

use backend\components\Functions;
//use dosamigos\datepicker\DatePicker;
use backend\models\MingruiPingjia;
use backend\widgets\DateInput;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$unfinished                    = Yii::$app->request->get('unfinished');
$this->title                   = '报告管理'; //$unfinished ? '未出报告' : '已出报告';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rest-report-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<style type="text/css">
    .content-wrapper{overflow: auto}
   .content tr td:nth-child(3){
       -webkit-filter: blur(6px);-filter: blur(6px);
    }
    thead td select{padding:5px !important;}
</style>


    <?php $GridViewParam = [
    //'emptyCell'    => '搜索',
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
/*    'rowOptions'   => function ($model) {
$url = Yii::$app->urlManager->createUrl(['rest-report/view', 'id' => $model->id]);
return ['onclick' => "location.href='$url';", 'style'=>'cursor:pointer'];
},*/
    'columns'      => [
        ['class'  => 'yii\grid\SerialColumn',
            'options' => ['width' => '40px;'],

        ],

        /*        [
        'value'   => 'id',
        'headerOptions' => ['width' => '60']
        ],*/

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
            'options'   => ['width' => '80px;'],
        ],
/*        [
'attribute' => 'created',
'value'     => function ($data) {
$date = new DateTime($data->created);
return $date->format('Y-m-d');

},
'filter'    => DatePicker::widget([
'model'         => $searchModel,
'attribute'     => 'created',
'inline'        => true,
'language'      => 'zh_cn',
'clientOptions' => [
'autoclose' => true,
'format'    => 'yyyy-mm-dd',
'language'  => 'zh-cn',
],

]),
'options'   => ['width' => '120px;'],
],*/

        [
            'label'     => '姓名',
            'attribute' => 'username',
            'value'     => function ($model) {
                $sample = $model->sample;
                if (!$sample) {
                   //var_dump($model); exit();
                    return "异常";
                }
                $name = $sample->name;
                return $name;
                return mb_strlen($name) > 9 ? mb_substr($name, 0, 9) . '..' : $name;
            },
            'filter'    => Html::activeTextInput($searchModel, 'username', [
                'class' => 'form-control',
            ]),
            'options'   => ['width' => '80px;'],
        ], //<=====加入这句,

        [
            'attribute' => 'sex',
            'filter'    => [''=>'全部','male' => '男', 'female' => '女'],
            'format'    => 'raw',
            'value'     => function ($model) {
                $sample = $model->sample;
                if(!$sample) return "x";
                return $sample->sex == 'female' ? '女' : '男';
            },
            'options'   => ['width' => '56'],
            'label'     => '性别',
        ],
        [
            'attribute' => 'age',
            'label'     => '年龄',
            'value'     => function ($model) {
                $sample = $model->sample;
                if(!$sample) return "x";
                return $sample->age ? $model->sample->age : '-';
            },
            'options'   => ['width' => '60px;'],
        ],

        [
            'attribute' => 'report_id',
            'options'   => ['width' => '100;'],
        ],

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
            'attribute' => 'method',
            'label'     => '方法',
            'filter'    => Html::activeTextInput($searchModel, 'method', [
                'class'    => 'form-control',
                'readonly' => 'readonly',
                'style'    => 'background:#fff',
            ]),

            'options'   => ['width' => '46', 'readonly' => 'readonly'],
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
        ],
////////////////////////////////////////////////////////
        [
            'attribute'     => 'gene',
            'label'         => '基因型',
            'headerOptions' => ['width' => '60'],
        ],

        [
            'attribute' => 'linchuang',
            'label'     => '临床表型',
            'value'     => 'pingjia.linchuang',
            'options'   => ['width' => '80'],
        ],

        [
            'attribute'     => 'pingjia',
            // 'filter' => Html::activeDropDownList($searchModel, 'sex',['1'=>'男','0'=>'女'], ['prompt'=>'全部'] ),
            'filter'        => MingruiPingjia::getSimpleArray(),
            'value'         => function ($model) {
                $obj = $model->pingjia;
                if ($obj) {
                    // return MingruiPingjia::$pingjiaText[$obj->pingjia];
                }
            },
            'label'         => '星级评价',
            'headerOptions' => ['width' => '80'],
        ],
/////////////////////////////////////////////////

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
        /*  ['label'        => '结论',
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
        [
            'options' => ['width' => '120'],
            'label'   => '操作',
            'filter'=> Html::submitButton('搜 &nbsp; 索', ['class' => 'btn btn-info']) 
            .Html::resetButton('恢 &nbsp;  复', ['class' => 'btn btn-default rest']) ,
            //Html::a('搜索', '#', ['class' => 'btn btn-success']),
            'format'  => 'raw',
            'value'   => function ($model) {
                $urlreport = Functions::url(
                    ['rest-report/view', 'id' => $model->id]
                );
                if (!Functions::ismobile()) {
                    $urlreport = Functions::url(
                        ['rest-report/comments', 'id' => $model->id]
                    );
                }
                $urldata = Functions::url(
                    ['rest-report/analyze', 'id' => $model->id]
                );
                $reportStatus     = $model->pdfurl  ? '' : 'disabled';
                $reportStatusText = $reportStatus == 'disabled' ?  '检测中':'查报告' ;
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

echo GridView::widget($GridViewParam);
 
?>
</div>
<script type="text/javascript">
    var totalPage = <?=$dataProvider->totalCount ?>;
</script>



