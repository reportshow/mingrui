<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiQa */

$this->title = '新建问题';
$this->params['breadcrumbs'][] = ['label' => '问题列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-qa-create">

     

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
