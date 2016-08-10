<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RestSampleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rest Samples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-sample-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rest Samples', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sample_id',
            'name',
            //'type',
            //'ypkd_id',
            //'barcode',
              'sex',
             'birthday',
            // 'age',
              'tel1',
            // 'tel2',
            // 'email:email',
              'address',
            // 'symptom:ntext',
            // 'date',
            // 'has_project',
            // 'report_type',
            // 'guanlian',
            // 'pdf',
            // 'has_symptom',
            // 'relation',
            // 'related_sid',
            // 'xianzhengzhe',
            // 'yangbenruku',
            // 'heshuanruku',
            // 'heshuanruku2',
            // 'yangbenweizi',
            // 'heshuanweizi',
            // 'heshuanweizi2',
            // 'note:ntext',
            // 'doctor_id',
            // 'family_id',
            // 'sales_id',
            // 'shenhe_status',
            // 'clinic_no',
            // 'nationality',
            // 'patient_no',
            // 'clinic_symptom:ntext',
            // 'report_template',
            // 'created',
            // 'xiedai',
            // 'updated',
            // 'timestamp:ntext',
            // 'dengji_note:ntext',
            // 'express',
            // 'express_no',
            // 'shouyang_date',
            // 'shouyanged',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
