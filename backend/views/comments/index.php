<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '在线留言';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-comments-index">

    <h1><?= Html::encode('未处理留言') ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?php // Html::a('Create Mingrui Comments', ['create'], ['class' => 'btn btn-success']) 
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','options'=>['width'=>'50px']],

            //'id',
            //'uid',
            //'to_uid',
            ['value'=>'doctor.name','options'=>['width'=>'80px']],
            ['value'=>'doctor.hospital.name'],
            //'report_id',
            ['value'=>'content'],
            /*[
            'value'=>function($m){ 
            	return $m->find()->where(['report_id'=>$m->report_id,'isread'=>0])->count();
              }
            ],*/
            ['format'=>'date', 'attribute'=> 'createtime'] ,
            // 'isread',
            ['format'=>'raw','value'=>function($m){ 
            	return Html::a('回复  ', ['guestbook/view','id'=>$m->report_id], ['class' => 'btn btn-success']);
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
            ['value'=>'doctor.name','options'=>['width'=>'80px']],
            ['value'=>'doctor.hospital.name'],
            //'report_id',
            ['value'=>'content'],
            /*[
            'value'=>function($m){ 
            	return $m->find()->where(['report_id'=>$m->report_id,
            		//'isread'=>0
            		])->count();
              }
            ], */
            ['format'=>'date', 'attribute'=> 'createtime'] ,
            // 'isread',
            ['format'=>'raw','value'=>function($m){ 

            	
            	$count = $m->find()->where(['report_id'=>$m->report_id,
            		//'isread'=>0
            		])->count();

            	$tag = '查看  <span class="badge bg-gray pop">' . $count. '</span>';

            	$html =  Html::a($tag, ['guestbook/view','id'=>$m->report_id], ['class' => 'btn btn-default']);
            	return $html;
            } ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<style>	
.grid-view thead{display:none;}
</style>