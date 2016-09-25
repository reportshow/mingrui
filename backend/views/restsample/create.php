<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RestSample */

$this->title = '创建样本记录';
$this->params['breadcrumbs'][] = ['label' => '患者资料', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-sample-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
