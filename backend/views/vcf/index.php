<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiVcfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'VCF外源数据';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-vcf-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a('上传VCF文件', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?php

    $columns = [
        ['attribute' => 'id', 'options' => ['width' => '60px;']],

        'title',
        'notes',

        ['attribute' => 'creator_name', 'label' => '上传者', 'options' => ['width' => '100px;'],
            'value'      => function ($model) {
                return $model->creator->nickname;
            }],

        ['attribute' => '', 'format' => 'raw', 'options' => ['width' => '60px;'],
            'value'      => function ($model) {
                return Html::a('下载VCF', ['vcf/download', 'id' => $model->id], ['class' => 'btn btn-info']);
            }],

        ['attribute' => 'status',  'format' => 'raw', 'options' => ['width' => '60px;'],
            'value'      => function ($model) {
                $status = $model->getTaskStatus()=='complete' ? '完成':'处理中..';
                return  "<button class='btn'>$status</button>";
            }],
                
        ['class' => 'yii\grid\ActionColumn'],
    ];

    if (!Yii::$app->user->can('admin')) {
        array_splice($columns,3,1);
    }

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => $columns,
    ]);

?>
</div>
