<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-report-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id'           => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'report_id',
            'created',
            'updated',
            'status',
            'note:ntext',
            'assigner_id',
            'product_id',
            'complete',
            'cnvsqlite',
            'snpsqlite',
            'cnvsave:ntext',
            'snpsave:ntext',
            'finish',
            'xiafa',
            'analysis_id',
            'yidai_complete',
            'url:url',
            'yidai_note:ntext',
            'express',
            'express_no',
            'sample_id',
            'pdf',
            'conclusion',
            'explain:ntext',
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
    ]) ?>

</div>
