<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name;
$this->params['breadcrumbs'][] = ['label' => 'Rest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Report', 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this); 
//$this->registerJsFile('@web/js/pdfobject.min.js',['position' => POS_HEAD,'depends'=>['backend\assets\AppAsset']]);  
//$this->registerCssFile('@web/css/ionicons.min.css',['depends'=>['backend\assets\AppAsset']]); 



$sqliteUrl = str_replace('/primerbean/media/', 'user/', $model->snpsqlite);
$sqliteUrl = Yii::$app->params['erp_url'] . $sqliteUrl ;
 
$data = file_get_contents($sqliteUrl);
$data = json_decode($data);
//$data = array('apple', 'orange', 'banana', 'strawberry');
$data = json_encode($data);
?>

<div id="app"></div>
<script>
    var tableData = <?php echo $data ?>;
</script>
<script src="report/app.js">
</script>
