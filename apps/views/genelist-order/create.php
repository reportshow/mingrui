<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model apps\models\GenelistOrder */

$this->title = '下单';
$this->params['breadcrumbs'][] = ['label' => 'Genelist Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genelist-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
