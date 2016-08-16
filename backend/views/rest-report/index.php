<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '报告检索';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rest-report-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('Create Rest Reports', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        //['class' => 'yii\grid\SerialColumn'],

/*        [
'value'   => 'id',
'headerOptions' => ['width' => '60']
],*/

        [
            'attribute' => 'id',
            'options'   => ['width' => '60px;'],
        ],

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
        ],

        [
            'attribute' => 'name',
            'value'     => function ($model) {
                return $model->sample->name;
            },
        ],

        'report_id',

        [
            'label'     => '检查类型ok',
            'attribute' => 'product_name',
            'value'     => 'product.name',
            'filter'    => Html::activeTextInput($searchModel, 'product_name', [
                'class' => 'form-control',
            ]),
        ], //<=====加入这句

        'gene_template',
        [
            'attribute' => 'testmethod',
            'label'     => '检测方法',
            'value'     => function ($model) {
                if (strpos($model->report_id, 'NG') !== false) {
                    return 'NGS';
                } else {
                    $template = $model->gene_template;
                    $mm       = ['_MLPA', '_CNV', 'PolyQ'];
                    foreach ($mm as $m) {
                        if (strpos($template, $m) !== false) {
                            return $m;
                        }
                    }
                    return $template;
                }

            },
        ],
        [
            'attribute' => 'tel1',
            'label'     => '联系方式',
            'value'     => function ($model) {
                $tels = $model->sample->tel1;
                $list = explode('、', $tels);
                return str_replace(' ', '', $list[0]) . (count($list) > 1 ? '-等' : '');
            },
        ],
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
        'conclusion',
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

        ['class'   => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {000delete}',
        ],
    ],
]);?>
</div>
