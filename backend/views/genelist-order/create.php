<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model apps\models\GenelistOrder */

$this->title = '新建订单';
$this->params['breadcrumbs'][] = ['label' => '基因列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genelist-order-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
