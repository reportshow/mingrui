<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiMypic */

$this->title = '上传图片';
//$this->params['breadcrumbs'][] = ['label' => 'Mingrui Mypics', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-mypic-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
