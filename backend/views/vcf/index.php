<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiVcfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'VCF外源数据';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-vcf-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('上传VCF文件', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute'=>'id' , 'options'   => ['width' => '60px;']],
 
            'title',
            'notes', 
            ['attribute'=>'creator_name','label'=>'上传者','options'   => ['width' => '100px;'],
            'value'=>function($model){
                return $model->creator->nickname;
            }],
             ['attribute'=>'','format'=>'raw','options'   => ['width' => '60px;'],
              'value'=>function($model){
                return Html::a('下载VCF', ['vcf/download','id'=>$model], ['class' => 'btn btn-info']);
            }],
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
