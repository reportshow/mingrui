<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '报告留言';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-comments-index">

    <h1><?= Html::encode('未处理') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?php // Html::a('Create Mingrui Comments', ['create'], ['class' => 'btn btn-success'])
        //var_dump($dataProvider->array()) ;exit;
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=>['width'=>'50px']],

            ['value'=>'report.report_id','options'=>['width'=>'120px']],
            //['value'=>'report.sample.doctor.name'],
             ['value'=>'creator.doctor.name','options'=>['width'=>'100px']],
            //
            ['format'=>'raw','value'=>function($m){
            	if(strpos($m->content,'weixin') > 1){ 
            		return '语言<i class="fa fa-volume-up"> </i>';
            	}
            	return $m->content;
            }],
            /*[
            'value'=>function($m){ 
            	return $m->find()->where(['report_id'=>$m->report_id,'isread'=>0])->count();
              }
            ],*/
            ['format'=>'date', 'attribute'=> 'createtime','options'=>['width'=>'100px']] ,
            // 'isread',
            ['format'=>'raw','value'=>function($m){ 
            	return Html::a('回复  ', ['rest-report/comments','id'=>$m->report_id], ['class' => 'btn btn-success']);
            } ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


  <hr>
  <h1>历史记录</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProviderRead,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=>['width'=>'50px']],

            //'id',
            //'uid',
            //'to_uid', 
            ['value'=>'report.report_id','options'=>['width'=>'120px']],
            //['value'=>'report.sample.doctor.name'],
             ['value'=>'creator.doctor.name','options'=>['width'=>'100px']],
            //
            ['format'=>'raw','value'=>function($m){
            	if(strpos($m->content,'weixin') > 1){ 
            		return '语言<i class="fa fa-volume-up"> </i>';
            	}
            	return $m->content;
            }],
            /*[
            'value'=>function($m){ 
            	return $m->find()->where(['report_id'=>$m->report_id,
            		//'isread'=>0
            		])->count();
              }
            ], */
            ['format'=>'date', 'attribute'=> 'createtime','options'=>['width'=>'100px']] ,
            // 'isread',
            ['format'=>'raw','value'=>function($m){ 

            	
            	$count = $m->find()->where(['report_id'=>$m->report_id,
            		//'isread'=>0
            		])->count();

            	$tag = '查看  <span class="badge bg-gray pop">' . $count. '</span>';

            	$html =  Html::a($tag, ['rest-report/comments','id'=>$m->report_id], ['class' => 'btn btn-default']);
            	return $html;
            } ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<style>	
.grid-view thead{display:none;}
</style>