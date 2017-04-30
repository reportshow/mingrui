<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model apps\models\GenelistCollection */

$this->title = '新建诊断词条';
$this->params['breadcrumbs'][] = ['label' => '词条列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genelist-collection-create">

    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
