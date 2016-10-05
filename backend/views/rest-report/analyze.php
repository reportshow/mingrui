<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\RestrepotTop;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   = '报告:' . $model->sample->name; 
$this->params['breadcrumbs'][] = ['label' => '报告列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title . '      数据自分析';

AppAsset::register($this); 
?>
<?=RestrepotTop::widget(['model_id'=>$model->id]); ?>

<div id="app"></div>
<script>
    var tableData = <?php echo $data ?>;
</script>

<link type="text/css" href="css/multiselect.css" rel="stylesheet" />
<script src="report/app.js"></script>
<script src="report/export.js"></script>
<style type="text/css">
    .content-wrapper{overflow: auto}
    .disabled{background: #999;border:0px;}
</style>
     