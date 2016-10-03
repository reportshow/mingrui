<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiReportstore */

$this->title = '上传外源报告';
$this->params['breadcrumbs'][] = ['label' => '外源公告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-reportstore-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
