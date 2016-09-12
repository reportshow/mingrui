<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiNotes */

$this->title = '创建新记事';
//$this->params['breadcrumbs'][] = ['label' => 'Mingrui Notes', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-notes-create">
 
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
