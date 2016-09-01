<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '医生';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-client-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建医生资料', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'sex',
            'age',
            //'birthplace',
              'email:email',
              'tel',
            // 'school',
            // 'education',
            // 'experience:ntext',
            // 'employed',
            'department',
            // 'worktime',
            // 'position',
            // 'speciality',
            // 'hobby',
            // 'notes:ntext',
            // 'zhuren',
            // 'hospital_id',
            // 'pianhao:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
