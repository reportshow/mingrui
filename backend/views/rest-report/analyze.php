<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\RestrepotTop;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name . '      数据自分析';
$this->params['breadcrumbs'][] = ['label' => 'Rest Reports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Report', 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

AppAsset::register($this); 
?>
<?=RestrepotTop::widget(['report_id'=>$model->id]); ?>

<div id="app"></div>
<script>
    var tableData = <?php echo $data ?>;
</script>

<link type="text/css" href="css/multiselect.css" rel="stylesheet" />
<script src="report/app.js"></script>
<script src="report/export.js"></script>
