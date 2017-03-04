<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = '医生';
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

    <p>
        <?=Html::a('新建医生资料', ['create'], ['class' => 'btn btn-success'])?>
    </p>
    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [

        [
            'attribute' => 'id',
            'options'   => ['width' => '60px;'],
        ],
        'name',
        //'sex',
        //'age',
        //'birthplace',
        ['attribute' => 'hospitalname', 'label' => '医院', 'value' => function ($model) {
            if(!$model->hospital){
                return "未知医院";
            }
            return $model->hospital->name;
        }],
        'department',
        ['attribute'=>'salesname',
         'value' =>'hospital.sales.name', 'label'=>'销售姓名'],
        'email:email',
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
        ['label'=>'激活',
         'format'=>'raw',
          'value'=>function($model){ 
          		if($model->userinfo){ 
					return "<i class='fa fa-check-square-o text-green'> </i>";
          		}else{ 
					return "<i class='fa fa-square-o'> </i>"; 
          		}
            	
          },
          'options'   => ['width' => '60px;'],
        ],
        ['class' => 'yii\grid\ActionColumn'],

       /* ['attribute' => ' ', 'format' => 'raw', 'label' => '留言',
            'value'      => function ($model) {
                $popCount = $model->commentCount();
                $pop      = '';
                if ($popCount) {
                    $pop = '<span class="badge bg-red pop">' . $model->commentCount() . '</span>';
                }
                $label = '留言' . $pop;
                return html::a($label, ['/guestbook/view', 'id' => 'gb' . $model->id]);
            }
        ],  */

    ],
]);?>
</div>
