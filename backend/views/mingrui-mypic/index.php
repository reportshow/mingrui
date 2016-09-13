<?php

use yii\helpers\Html;
use backend\widgets\Imglist;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiMypicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-mypic-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('上传图片', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= Imglist::widget([
        'dataProvider' => $dataProvider, 
    ]); ?>
</div>
