<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel apps\models\MainlistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '基因分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainlist-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建大类', ['create'], ['class' => 'btn btn-success']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [ 'attribute'=>'id',
              'options'   => ['width' => '60'],
            ],
            'name',
            'name_en',
            'number',
            'description:ntext',
            // 'hassub',
             [ 'attribute'=>'classname',
                'format'=>'raw',
               'label'=>'分类/描述',
                'value'=>function($model){ 
                	if( $model->hassub ==1   ){ 
                		$label = $model->classname;
                		if(!$label) $label = '---';
                		$url = '../../apps/web/index.php?r=gene/class&classid=' . $model->id;
                		return Html::a($label, $url, ['class' => 'btn-xs btn-success']);
                	}
                    
                    $url = '../../apps/web/index.php?r=gene/class&classid=' . $model->id;
                		return Html::a('图文', $url, ['class' => 'btn-xs btn-primary']);

                	//return Html::a('图文',['detailview', 'id' => $model->id],['class' => 'btn-xs btn-primary']);

                },
                'options'   => ['width' => '90'],
             ] ,

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
