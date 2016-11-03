<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\LoadingPage;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiVcf */

$this->title = $model->sick;
$this->params['breadcrumbs'][] = ['label' => 'VCF外源数据', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mingrui-vcf-view">
 
  <?=LoadingPage::widget()?>



    <p> 
        <?php //= Html::a('修改', ['update', 'id'           => $model->id], ['class' => 'btn btn-primary']) 
        ?>
        <?php
        /* echo Html::a('删除', ['delete', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?php 
    /*echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sick',
            'age',
            'sex',
 
            'status',
            'tel',
            'product',
            'diagnose:ntext',
            'gene',
            ['attribute'=>	    'createtime','value'=>date('Y-m-d H:i',$model->createtime)],
            ['attribute'=>'vcf', 'format'=>'raw',
             'value'=>    Html::a('下载VCF', ['vcf/download','id'=>$model->id], ['class' => 'btn btn-info'])],
            ['attribute'=>'上传者', 'value'=>$model->creator->nickname],
        ],
    ]);*/

     ?>

</div>
<div id="app"></div>
<script>
    var tableData = <?php echo $data ?>;
</script>

<link type="text/css" href="css/multiselect.css" rel="stylesheet" />
<script src="report/app_external.js"></script>
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
<style type="text/css">
    .content-wrapper{overflow: auto}
    .disabled{background: #999;border:0px;}
    .detail-view tr th{
        width: 20%
    }
</style>
