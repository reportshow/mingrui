<?php

use yii\helpers\Html;

use backend\models\MingruiDoc;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiDocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type = $_GET['type'];
$name = MingruiDoc::$TYPES[$type ];

$doctype                       = $_GET['type'] == 'article' ? '案例分享' : '文档资料';
$this->title                   =  $name ; 
$this->params['breadcrumbs'][] = $this->title;

$newBtnText = '新建 ' .$name;

?>
<div class="mingrui-doc-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?php
if (Yii::$app->user->can('admin')) {
    echo Html::a($newBtnText, ['create', 'type' => $_GET['type']], ['class' => 'btn btn-success']);
}else  if(Yii::$app->user->can('doctor') && $_GET['type']=='article') {
	echo Html::a('新建 ' .$name, ['create', 'type' => 'article'], ['class' => 'btn btn-success']);
}

?>
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
