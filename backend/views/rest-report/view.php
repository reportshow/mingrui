<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => 'Rest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-report-view">



    <p>
        <?=Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])?>
        <?=Html::a('Delete', ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data'  => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method'  => 'post',
    ],
])?>

<?=Html::a('查看报告详情', ['show-report', 'id' => $model->id], [
    'class' => 'btn btn-success',     
])?>
    </p>

    <?=DetailView::widget([
    'model'      => $model,
    'attributes' => [
        'id',
        'report_id',
        'created',
        'updated',
        'status',
        'note:ntext',
       // 'assigner_id',
        //'product_id',
        [
            'attribute' => 'product.name',
            'label'     => '检查项目', 
            'value'     => $model->product->name,
        ],

        //'complete',
        'cnvsqlite',
        'snpsqlite',
        'cnvsave:ntext',
        [
            'attribute' => 'cnvsave',
            'label'     => 'cnvsave',
            'format'    => 'raw',
            'value'     => $model->cnsaveimg,
        ],
        /*      array(
        'label' => 'xx',
        'format' => 'raw',
        'template' => '<tr><th>{label}</th><td>{value}</td></tr>',
        'value'     => function ($model) {
        return '/';
        },
        ),*/
        'snpsave:ntext',
        'finish',
        'xiafa',
        'analysis_id',
        'yidai_complete',
        //'url:url',
        //'yidai_note:ntext',
        'express',
        'express_no',
        'sample_id',
        'pdf',
        'conclusion',
        'explain:ntext',
        [
            'label' => 'explain',
            'value' => $model->explainsummary,
        ],
        'jxyanzhen',
        'mut_type',
        'star',
        'template',
        'type',
        'gene_template',
        'ptype',
        'csupload',
        'family_id',
        'date',
        'abiresult:ntext',
        'snpexplain:ntext',
        'abiexported',
        'final_note:ntext',
        'assigner_note:ntext',
        'shenhe_date',
        'locked',
        'express_sent',
        'sale_marked',
        'time_stamp:ntext',
        'yidaifinished_date',
        'kyupload',
        'yidai_marked',
    ],
])?>

</div>
