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
        <?php echo Html::a('修改', ['update', 'id'           => $model->id], ['class' => 'btn btn-primary']) 
        ?>
        <?php
          echo Html::a('删除', ['delete', 'id'           => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">保存当前过滤条件</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form">
      <div class="box-body">
        <div class="form-group">
          <label for="exampleInputEmail1">条件备注</label>
	  <textarea class="form-control" rows="3" id="note" placeholder="写点什么吧"></textarea>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">保存</button>
      </div>
    </form>
  </div>
  <!-- /.box -->
  
  <div class="box box-solid">
    <div class="box-header with-border">
      <i class="fa fa-text-width"></i>
      <h3 class="box-title">Description</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <dl>
	<dt>Description lists&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i class="fa fa-upload"></i></a>&nbsp;&nbsp;<a href="#"><i class="fa fa-trash-o"></i></a></dt>
	<dd>A description list is perfect for defining terms.</dd>
	<dt>Description lists</dt>
	<dd>A description list is perfect for defining terms.</dd>
      </dl>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</aside>
<!-- The sidebar's background -->
<!-- This div must placed right after the sidebar for it to work-->
<div class="control-sidebar-bg"></div>
<script>
  var bootstrapTooltip = $.fn.tooltip.noConflict();
  $.fn.bstooltip = bootstrapTooltip;
  $('a').bstooltip();
</script>

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
