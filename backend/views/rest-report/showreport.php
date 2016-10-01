<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\models\RestReport;
use backend\widgets\PdfShow;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */
$id = $_GET['id'];
global $sick;
$report = RestReport::findOne($id);
$sick   = $report->sample->name;

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $sick, 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this); 
//$this->registerJsFile('@web/js/pdfobject.min.js',['position' => POS_HEAD,'depends'=>['backend\assets\AppAsset']]);  
//$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 
//
?>


    <p>


<?=Html::a('意见反馈', ['rest-report/view', 'id' => $model->id], [
    'class' => 'btn btn-info actived',
])?>


<?=Html::a('报告详情', ['show-report', 'id' => $model->id], [
    'class' => 'btn btn-success',
])?>

<?=Html::a('报告归类', ['rest-report/stats', 'id' => $model->id], [
    'class' => 'btn btn-primary',
])?>



<?=Html::a('完善资料', ['mingrui-attachment/', 'reportid' => $model->id], [
    'class' => 'btn btn-warning',
])?>

&nbsp;&nbsp;&nbsp;
<?=Html::a('数据分析', ['rest-report/analyze', 'id' => $model->id], [
    'class' => 'btn btn-danger',
])?>
    </p>


    
<?php

if($model->pdf){
	$pdfurl = str_replace('/primerbean/media/', 'user/', $model->pdf);
    $pdfurl = Yii::$app->params['erp_url'] . $pdfurl ;
}else{
	echo "<h1>抱歉，没有报告数据！</h1>";
	return;
}

echo  PdfShow::widget(['pdfurl'=>$pdfurl]);
?>
