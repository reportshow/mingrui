<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\MingruiVcf */

$this->title = '上传Vcf文件';
$this->params['breadcrumbs'][] = ['label' => 'VCF外源数据', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-vcf-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
