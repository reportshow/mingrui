<?php

use backend\models\RestReport;
use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiAttachment */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mingrui Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$report = RestReport::findOne($model->report_id);
$sick   = $report->sample->name;

?>
<div class="mingrui-attachment-view">


    <p>
        <?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data'  => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method'  => 'post',
    ],
])?>
    </p>

    <?
$imgurls  = explode(';', $model->image);
$imagebox = '';
foreach ($imgurls as $key => $url) {
    $imagebox .= "<img src='$url' width=100>";
}

echo DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        [
            'attribute' => 'report_id',
            'format'    => 'raw',
            'value'     => $sick . '--' . $model->report_id,
        ],
        'title',
        'description',
        'createtime',
        [
            'attribute' => 'image',
            'format'    => 'raw',
            'value'     => $imagebox,
        ],
    ],
]);

?>

</div>
