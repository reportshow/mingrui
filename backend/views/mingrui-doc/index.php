<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiDocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$doctype                       = $_GET['type'] == 'article' ? '案例' : '文档';
$this->title                   = $doctype . '分享';
$this->params['breadcrumbs'][] = $this->title;

$newBtnText = '新建 ' . $doctype;

?>
<div class="mingrui-doc-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=Html::a($newBtnText, ['create', 'type' => $_GET['type']], ['class' => 'btn btn-success'])?>
    </p>
    <?php
/*    GridView::widget([
'dataProvider' => $dataProvider,
'filterModel' => $searchModel,
'rowOptions'   => function ($model) {
$url = Yii::$app->urlManager->createUrl(['mingrui-doc/view', 'id' => $model->id]);
return ['onclick' => "location.href='$url';", 'style'=>'cursor:pointer'];
},
'columns' => [
['class' => 'yii\grid\SerialColumn'],

'id',
'title',
'description:ntext',
'doc',
'createtime',

['class' => 'yii\grid\ActionColumn'],
],
]); */

foreach ($dataProvider->getModels() as $key => $model) {
    echo $this->render('view-item', [
        'model' => $model,
    ]);
}
?>
</div>
