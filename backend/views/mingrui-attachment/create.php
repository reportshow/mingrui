<?php

use yii\helpers\Html;
use backend\models\RestReport;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiAttachment */
$id = $_GET['id'];

$report = RestReport::findOne($id);
$sick = $report->sample->name;

$this->title = '添加报告';
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['rest-report/index']];
$this->params['breadcrumbs'][] = ['label' => "[{$sick}]报告", 'url' => ['rest-report/view','id'=>$id]];
$this->params['breadcrumbs'][] = ['label' => '附加报告列表', 'url' => ['mingrui-attachment/index','id'=>$id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-attachment-create">
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
