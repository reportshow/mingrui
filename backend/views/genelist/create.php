<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model apps\models\Mainlist */

$this->title = '创建新大类 ';
$this->params['breadcrumbs'][] = ['label' => '列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mainlist-create">

    <h1 class='hide'><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
