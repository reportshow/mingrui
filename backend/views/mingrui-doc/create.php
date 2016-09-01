<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */

$this->title = '新建案例';
$this->params['breadcrumbs'][] = ['label' => '案例分享', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-doc-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
