<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model apps\models\Information */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'key',
            'class',
            'genecount',
            'sick',
            'sick_en',
            'gene',
            'method',
            'omim',
            'background',
            'wide',
            'DM',
            'mutation',
            'grosins',
            'grosdel',
            'complex',
            'prom',
            'deletion',
            'insertion',
            'indel',
            'splice',
            'amplet',
            'OTHERS',
            'refseq',
        ],
    ]) ?>

</div>
