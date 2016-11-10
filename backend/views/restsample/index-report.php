<?php

use backend\widgets\DateInput;
use yii\grid\GridView;
use yii\helpers\Html;

use backend\models\MingruiPingjia;
use backend\components\Functions;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestSampleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '报告管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
     .content tr td:nth-child(3){
     -webkit-filter: blur(6px);-filter: blur(6px);
       }  
</style>
<div class="rest-sample-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);
?>

    <p>
        <?php //=Html::a('新建患者资料', ['create'], ['class' => 'btn btn-success'])
?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
 /*   'rowOptions'   => function ($model) {
        $url = Yii::$app->urlManager->createUrl(['restsample/view', 'id' => $model->sample_id]);
        return ['onclick' => "location.href='$url';", 'style' => 'cursor:pointer'];
    },*/
    'emptyCell'    => '',
    'columns'      => [
        [
            'class'   => 'yii\grid\SerialColumn',
            'options' => ['width' => 30]],

        

        [
            'attribute' => 'created',
            'label'=>'送检日期',
            'value'     => function ($data) {
                $date = new DateTime($data->created);
                return $date->format('Y-m-d');
            },
            'filter'    => DateInput::widget(['attribute' => 'created', 'model' => $searchModel]),
            'options'   => ['width' => '80'],
        ],

       //  //'sample_id',

        [
            'attribute' => 'name',
            'options'   => ['width' => 80],
        ],
        //'type',
        //'ypkd_id',
        //'barcode',
        [
            'attribute' => 'sex',
            'filter'    => [''=>'全部','male' => '男', 'female' => '女'],
            'options'   => ['width' => 50],
            'value'     => function ($model) {
                if( $model->sex == 'female' ) return '女' ;
                if( $model->sex == 'male' )  return '男';
            },
        ],
        [
            'attribute' => 'age',
            'options'   => ['width' => 60],
            //'filter'    => DateInput::widget(['attribute' => 'birthday', 'model' => $searchModel]),
        ],

/*        [
            'attribute' => 'report_id',
            'options'   => ['width' => '100;'],
        ],*/

        // [
        //     'attribute' => 'tel1',
        //     'label'     => '联系方式',
        //     'options'   => ['width' => 120],
        //     'value'     => function ($model) {
        //         $tels = $model->tel1;
        //         //$list = explode('、', $tels);
        //         //return str_replace(' ', '', $list[0]) . (count($list) > 1 ? '-等' : '');
        //         $tels = str_replace(' ', '', $tels);
        //         $tels = str_replace('-', '', $tels);
        //         /* if (strlen($tels) > 11) {
        //         $tels = substr($tels, 0, 11) . '...';
        //         }*/
        //         return $tels;
        //     },
        //     'filter'    => Html::activeTextInput($searchModel, 'tel1', [
        //         'class' => 'form-control',
        //     ]),
        // ],

        [
            'attribute' => 'restReport.report_id',
            'filter'    => Html::activeTextInput($searchModel, 'report_id', [
                'class' => 'form-control',
            ]),
            'options'   => ['width' => '100;'],
        ],

            [
            'label'     => '检测项目',
            'attribute' => 'product_name',
            'value'     => 'product.name' ,
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
                'style'    => 'background:#ddd',
            ]),

            'options'   => ['width' => '46', 'readonly' => 'readonly'],
             
        ],

////////////////////////////////////////////////////////
        [
            'attribute'     => 'gene',
            'value'         => 'geneTxt',
            'label'         => '基因型',
            'headerOptions' => ['width' => '60'],
        ],

        [
            'attribute' => 'linchuang',
            'label'     => '临床表型',
            'value'     => function($model){
                $pingjia = $model->getPingjia()->one();
                if($pingjia){
                   return $pingjia->linchuang; 
               }
               //return "xxx";
                
            },//'pingjia.linchuang',
            'options'   => ['width' => '80'],
        ],

        [
            'attribute'     => 'pingjia',
            'format'=>'raw',
            // 'filter' => Html::activeDropDownList($searchModel, 'sex',['1'=>'男','0'=>'女'], ['prompt'=>'全部'] ),
            'filter'        => MingruiPingjia::getSimpleArray(),
            'value'         =>  'pingjiaTxt',
            'label'         => '星级评价',
            'headerOptions' => ['width' => '80'],
        ],
/////////////////////////////////////////////////


        // 'email:email',
   //     ['attribute' => 'address', 'options' => ['width' => 120]],

        // 'symptom:ntext',
        // 'date',
        // 'has_project',
        // 'report_type',
        // 'guanlian',
        // 'pdf',
        // 'has_symptom',
        // 'relation',
        // 'related_sid',
        // 'xianzhengzhe',
        // 'yangbenruku',
        // 'heshuanruku',
        // 'heshuanruku2',
        // 'yangbenweizi',
        // 'heshuanweizi',
        // 'heshuanweizi2',
        // 'note:ntext',
        // 'doctor_id',
        // 'family_id',
        // 'sales_id',
        // 'shenhe_status',
        // 'clinic_no',
        // 'nationality',
        // 'patient_no',
        // 'clinic_symptom:ntext',
        // 'report_template',
        // 'created',
        // 'xiedai',
        // 'updated',
        // 'timestamp:ntext',
        // 'dengji_note:ntext',
        // 'express',
        // 'express_no',
        // 'shouyang_date',
        // 'shouyanged',

/*        ['class'        => 'yii\grid\ActionColumn',
            'header'        => '操作',
            'template' => '{view} {update} ',
            'filterOptions' => ['data-toggle' => 'gridviewoprator'],
            'options'       => [
                'width' => 80,
            ],
        ],*/
  
    [
            'options' => ['width' => '120'],
            'label'   => '操作',
            'filter'=> Html::submitButton('搜 &nbsp; 索', ['class' => 'btn btn-info']) 
            .Html::resetButton('恢 &nbsp;  复', ['class' => 'btn btn-default rest']) ,
            //Html::a('搜索', '#', ['class' => 'btn btn-success']),
            'format'  => 'raw',
            'value'   => function ($sample) {
                $model = $sample->restReport;
                if(!$model) return '处理中';
 
                $urlreport = Functions::url(
                    ['/rest-report/view', 'id' => $model->id]
                );
                if (!Functions::ismobile()) {
                    $urlreport = Functions::url(
                        ['/rest-report/comments', 'id' => $model->id]
                    );
                }
                $urldata = Functions::url(
                    ['/rest-report/analyze', 'id' => $model->id]
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
            }
        ],//item

    ],//colums

]);?>
</div>
<style type="text/css">
    .content-wrapper{overflow: auto}
    .disabled{background: #999;border:0px;}
</style>