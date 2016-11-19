<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use backend\widgets\RestrepotTop2;
use backend\components\Functions;

use backend\widgets\LoadingPage;

/* @var $this yii\web\View */
/* @var $model backend\models\RestReport */

$this->title                   =  $model->sample->name; 
$this->params['breadcrumbs'][] = ['label' => '报告管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = '数据分析';

AppAsset::register($this); 
?>
<?=RestrepotTop2::widget(['model_id'=>$model->id]); ?>

<?php

 if(Functions::ismobile()){
?>
 	<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> 提示!</h4>
                请您打开电脑版使用数据分析功能
     </div>
<?php

  return;
}//ismobile
?>
<?=LoadingPage::widget()?>
<?php
  if($empty){
?>
<div class="alert alert-info alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><i class="icon fa fa-info"></i> 提示!</h4>
  目前还没有可供分析的数据
</div>
<?php } else {?>
<div id="app"></div>
<script>
    var tableData = <?php echo $data ?>;
</script>

<link type="text/css" href="css/multiselect.css" rel="stylesheet" />
<script src="report/app.js"></script>

<script src="report/tableExport.js"></script>
<script>
var $exportLink = document.getElementById('export');
$exportLink.addEventListener('click', function(e) {
    e.preventDefault();
    if (e.target.nodeName === "A") {
	tableExport('result', '基因检测诊断过滤结果', e.target.getAttribute('data-type'));
    }
}, false);
</script>
<?php } ?>
