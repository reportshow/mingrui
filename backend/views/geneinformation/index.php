<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel apps\models\InformationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="information-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Informations', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'key',
            'class',
            'genecount',
            'sick',
            // 'sick_en',
            // 'gene',
            // 'method',
            // 'omim',
            // 'background',
            // 'wide',
            // 'DM',
            // 'mutation',
            // 'grosins',
            // 'grosdel',
            // 'complex',
            // 'prom',
            // 'deletion',
            // 'insertion',
            // 'indel',
            // 'splice',
            // 'amplet',
            // 'OTHERS',
            // 'refseq',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
