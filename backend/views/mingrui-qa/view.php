<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiQa */

$this->title = $model->question;
$this->params['breadcrumbs'][] = ['label' => 'Mingrui Qas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-qa-view">
 

    <p>
        <?= Html::a('Update', ['update', 'id'           => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id'           => $model->id], [
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
            'question',
            'answer:ntext',
            ['attribute'=>'createtime', 'value'=>date('Y-m-d H:i', $model->createtime)],
        ],
    ]) ?>

</div>
