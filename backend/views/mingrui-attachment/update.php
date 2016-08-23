<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiAttachment */

$this->title = 'Update Mingrui Attachment: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Mingrui Attachments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id'           => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mingrui-attachment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
