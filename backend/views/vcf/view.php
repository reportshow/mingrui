<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\LoadingPage;
use backend\models\MingruiPingjia;
/* @var $this yii\web\View */
/* @var $model backend\models\MingruiVcf */

$this->title = $model->sick;
$this->params['breadcrumbs'][] = ['label' => 'VCF外源数据', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if(!empty($_GET['detail']) && $_GET['detail']=='only'){

    ?>



<div class="mingrui-vcf-view ">
 
 
    <p> 
        <?php echo Html::a('查看数据', ['view', 'id'           => $model->id], ['class' => '  btn btn-primary']) 
        ?>
        <?php echo Html::a('修改', ['update', 'id'           => $model->id], ['class' => '  btn btn-warning']) 
        ?>
        <?php
          echo Html::a('删除', ['delete', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这一项吗?',
                'method' => 'post',
            ],
        ])  ?>
    </p>

    <?php 
  
         $pingjiaList = MingruiPingjia::getSimpleArray();
            $index= $model->pingjia  ;
            
           $pingjia =  $index=='' ?'': $pingjiaList[$index];
           $sex = '';
           if( $model->sex =='female') $sex= '女';
           if( $model->sex =='male') $sex= '男';

           $colums = [
                    'id',
                    'sick',
                    'age',
                    ['attribute'=>'sex','value'=>$sex], 
                    'status',
                    'tel',
                    'product',
                    'diagnose:ntext',
                    'gene',
                    ['attribute'=>'pingjia','label'=>'星级评价', 'value'=>$pingjia],
                    ['attribute'=> 'createtime','value'=>date('Y-m-d H:i',$model->createtime)],

                 /*   ['attribute'=>'vcf', 'format'=>'raw',
                     'value'=>    Html::a('下载VCF', ['vcf/download','id'=>$model->id],   ['class' => 'btn btn-info'])
                    ],*/
                    
                ];

            if(Yii::$app->user->can('admin')){
               $colums[] =  ['attribute'=>'上传者', 'value'=>$model->creator->nickname];
            }

             echo DetailView::widget([
                'model' => $model,
                'attributes' =>  $colums 
            ]); 
    
     ?>

</div>
<?php

return;
}//====================if

?>
<?=LoadingPage::widget()?>

<div id="app"></div>

<!-- The Right Sidebar -->
<aside class="control-sidebar control-sidebar-light">
  <!-- general form elements -->
  <div class="box box-primary" id="filter"></div>
  <!-- /.box -->
</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg"></div>
<script>
  var user_id = <?php echo Yii::$app->user->id ?>;
  var report_id = <?php echo $this->params['report_id'] ?>;
  var report_type = 1;
</script>
<script src='report/EventEmitter-4.0.3.min.js'></script>
<script>
    var eh = new EventEmitter();
</script>
<script src="report/filter.js"></script>

<script>
    var tableData = <?php echo $data ?>;
    var exportData = [];
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
