<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestDanwei */

$this->title = '添加合作医院';
$this->params['breadcrumbs'][] = ['label' => '合作医院', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-danwei-create">

     
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
