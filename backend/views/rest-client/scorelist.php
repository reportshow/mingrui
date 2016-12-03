<?php

use yii\grid\GridView;
use yii\helpers\Html;
//use Yii;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '积分';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-client-index">
  <style type="text/css">
   .pop{
         /* position: absolute;
             top: 9px;
             right: 7px;
             text-align: center;
             font-size: 9px;
             padding: 2px 3px;
             line-height: .9;  */
}
  </style>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
 
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [

        [
            'attribute' => 'id',
            'options'   => ['width' => '60px;'],
        ],
        'name',

        ['attribute' => 'totalscore',
        'label' => '积分',
        'value'=>function($model){
        	return $model->scoreCount;
         	 
        }],

        //'sex',
        //'age',
        //'birthplace',
        ['attribute' => 'hospitalname', 'label' => '医院', 'value' => function ($model) {
            if(!$model->hospital){
                return "未知医院";
            }
            return $model->hospital->name;
        }],
        //'department',
        //'email:email',
        'tel',
        // 'school',
        // 'education',
        // 'experience:ntext',
        // 'employed',

        // 'worktime',
        // 'position',
        // 'speciality',
        // 'hobby',
        // 'notes:ntext',
        // 'zhuren',
        // 'hospital_id',

        // 'pianhao:ntext',



        ['attribute' => ' ', 'format' => 'raw', 'label' => ' ',
            'value'      => function ($model) {
                
            }],
    ],
]);?>
</div>
