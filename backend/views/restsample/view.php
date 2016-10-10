<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RestSample */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '病人列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-sample-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sample_id',
            'name',
            'type',
            //'ypkd_id',
            //'barcode',
            ['attribute'=>'sex','value'=> $model->sex =='female' ? '女' : '男'],
            'birthday',
            'age',
            'tel1',
            'tel2',
            'email:email',
            'address',
            'symptom:ntext',
            'date',
            //'has_project',
            //'report_type',
            //'guanlian',
            //'pdf',
           // 'has_symptom',
            //'relation',
            //'related_sid',
            //'xianzhengzhe',
            //'yangbenruku',
            //'heshuanruku',
            //'heshuanruku2',
            //'yangbenweizi',
            //'heshuanweizi',
            //'heshuanweizi2',
            //'note:ntext',
            //'doctor_id',
            //'family_id',
            //'sales_id',
            //'shenhe_status',
            //'clinic_no',
            //'nationality',
            //'patient_no',
            'clinic_symptom:ntext',
            //'report_template',
            //'created',
            //'xiedai',
            //'updated',
            //'timestamp:ntext',
            //'dengji_note:ntext',
            //'express',
           // 'express_no',
            //'shouyang_date',
            //'shouyanged',
        ],
    ]) ?>

</div>

