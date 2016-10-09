<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RestClient */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rest Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-client-view">

     

    <p>
        <?= Html::a('Update', ['修改', 'id'           => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['删除', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,

        'attributes' => [
            'id',
            'name',
            'sex',
            'age',
            'birthplace',
            'email:email',
            'tel',
            'school',
            'education',
            'experience:ntext',
            'employed',
            'department',
            'worktime',
            'position',
            'speciality',
            'hobby',
            'notes:ntext',
           // 'zhuren',
            ['attribute'=>'hospitalname','label'=>'医院','value'=>$model->hospital->name],
            //'pianhao:ntext',
        ],
    ]) ?>
<style type="text/css">
    .table{width: 60%}
</style>
</div>
