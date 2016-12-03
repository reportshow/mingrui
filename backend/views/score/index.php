<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '积分';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-score-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建积分记录', ['create'], ['class' => 'btn btn-success hide']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=>['width'=>'80px']],
 
            /*['attribute'=>'id',
            'options'=>['width'=>'100px'] 
            ],
            */
           /*
            ['attribute'=>'name',
            'value'=>function($model){
               return $model->creator->name; 
            }],
            */
            [
            'attribute'=>'creator.nickname',
            'label'=>'微信',
            'options'=>['width'=>'120px'] 
            ],
            [
            'attribute'=>'name',
            'value'=>function($model){ 
            	$creator = $model->creator;
            	return $creator->doctor->name;
             },
            'label'=>'姓名',
            'options'=>['width'=>'120px'] 
            ],
            
             ['attribute'=>'score',
            'options'=>['width'=>'100px'] 
            ],


            ['class' => 'yii\grid\ActionColumn', 'options'=>['width'=>'100px'] ],
        ],
    ]); ?>
</div>
<style type="text/css">
	.table{width: auto;}
</style>