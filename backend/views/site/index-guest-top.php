<?php
use yii\helpers\Html;

?>
<div style="padding:8px">

<?=Html::a('<i class="fa fa-github"></i>查看报告', ['/rest-report/view', 'id'=>3965], [
    'class' => 'btn btn-success  btn-social  ',
])?>

<?=Html::a('<i class="fa fa-file-image-o"></i>上传图片', ['/mingrui-mypic/' ], [
    'class' => 'btn btn-primary  btn-social ',
])?>

<?=Html::a('<i class="fa   fa-calendar"></i>病例记事', ['rest-report/attachment' ], [
    'class' => 'btn btn-info btn-social ',
])?>

<?=Html::a('<i class="fa fa-stack-overflow"></i>检测流程', ['/' ], [
    'class' => 'btn btn-warning btn-social ',
])?>
	</div>