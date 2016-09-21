<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\models\RestReport;

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
if($model->pdf){
	$pdfurl = str_replace('/primerbean/media/', 'user/', $model->pdf);
    $pdfurl = Yii::$app->params['erp_url'] . $pdfurl ;
}else{
	echo "<h1>抱歉，没有报告数据！</h1>";
	return;
}

?>
<div class="rest-report-view">
<?=Html::jsFile('@web/js/pdfobject.min.js')?>

<div id="example1"></div> 
<script>
var options = {
   fallbackLink: "<p>This is a <a href='[url]'>fallback link</a></p>"
};

PDFObject.embed("<?=$pdfurl ?>", "#example1", options);
/*PDFObject.embed("upload/NG16010024.pdf", "#example1");*/
</script>
<style>
.pdfobject-container { height: 600px;}
.pdfobject { border: 1px solid #666; }
</style>
</div>
