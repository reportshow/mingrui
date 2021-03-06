<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiQaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '常见QA';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-qa-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]);
     ?>

    <p>
        <?= Html::a('新建问题', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [ 

            
           ['attribute'=>'id' , 'options'   => ['width' => '60px;']],
            'question',
           // 'answer:ntext',
            ['attribute'=>'createtime' ,  'options'   => ['width' => '120px;'], 'format'=>'date'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
