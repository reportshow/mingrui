<?php

use yii\helpers\Html; 
use backend\models\MingruiDoc;

/* @var $this yii\web\View */
/* @var $model backend\models\MingruiDoc */
$type = $_GET['type'];
$name = MingruiDoc::$TYPES[$type ];
$this->params['breadcrumbs'][] = ['label' => '分享'.$name, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-doc-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
