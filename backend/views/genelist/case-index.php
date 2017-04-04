<?php

use yii\helpers\Html;

use backend\models\MingruiDoc;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiDocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$type = $_GET['type'];
$name = MingruiDoc::$TYPES[$type ];
 
$this->title                   =  $name ; 
$this->params['breadcrumbs']  = [];

$newBtnText = '新建 ' .$name;

?>
<div class="mingrui-doc-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <p>
        <?php
if (Yii::$app->user->can('admin')) {
    echo Html::a($newBtnText, ['createcase', 'classid' => $_GET['classid']], ['class' => 'btn btn-success']);
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
    echo $this->render('case-item', [
        'model' => $model,
    ]);
}
?>
</div>
