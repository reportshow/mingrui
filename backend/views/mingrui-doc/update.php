<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */

$title = mb_substr($model->title,0,20).'...';
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 
         'url' => ['view', 'id' => $model->id, 'type' => $model->type]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="mingrui-doc-update"> 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
