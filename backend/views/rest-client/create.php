<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestClient */

$this->title = '新建医生资料';
$this->params['breadcrumbs'][] = ['label' => '医生', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-client-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
