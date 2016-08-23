<?php

use yii\grid\GridView;
use yii\helpers\Html;
use backend\models\RestReport;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiAttachmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
 
$id = $_GET['id'];

$report = RestReport::findOne($id);
$sick = $report->sample->name;

$this->title = '附加报告列表';
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['rest-report/index']];
$this->params['breadcrumbs'][] = ['label' => "[{$sick}]报告", 'url' => ['rest-report/view','id'=>$id]]; 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-attachment-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('新增报告', ['create', 'id' => $_GET['id']], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
        /*['class' => 'yii\grid\SerialColumn'],*/

        [
            'value'         => 'id',
            'label'=>'ID',
            'attribute'=>'id',
            'headerOptions' => ['width' => '60'],
        ],

        //'report_id',
        //'image',
        'title',
        'description',
        // 'createtime',

        ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>
</div>
