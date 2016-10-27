<?php

 
use backend\models\RestReport;
use backend\widgets\Imglist;
use backend\widgets\RestrepotTop2;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MingruiAttachmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$id = $_GET['reportid'];
global $sick;
$report = RestReport::findOne($id);
$sick   = $report->sample->name;

$isSick = Yii::$app->user->Identity->role_text=='guest';

$this->title                   = $isSick ? '上传 图片' : '完善资料';
$this->params['breadcrumbs'][] = ['label' => '报告管理', 'url' => ['rest-report/index']];
$this->params['breadcrumbs'][] = ['label' => $sick, 'url' => ['rest-report/view', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-attachment-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

<?php
if ($isSick) {
    $newbtnText = '上传 图片';
} else {
    $newbtnText = '新增 资料';
    echo RestrepotTop2::widget(['model_id' => $id]);
}

?>

    <p>
        <?=Html::a($newbtnText, ['create', 'reportid' => $_GET['reportid']], ['class' => 'btn btn-success'])?>
    </p>
   <?=Imglist::widget([
    'dataProvider' => $dataProvider,
    'nullMessage'  => '请上传与该报告相关的完善资料的文档，图片',
]);?>
</div>
