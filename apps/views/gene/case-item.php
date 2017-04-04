<?php
use yii\helpers\Html;
use backend\widgets\Attachments;

echo Attachments::begin( );

$type= $_GET['type'];  

if (!function_exists('delScript')) {
    function delScript($string)
    { 
        $pregfind    = array("/<script.*>.*<\/script>/siU", '/on(mousewheel|mouseover|click|load|onload|submit|focus|blur)="[^"]*"/i');
        $pregreplace = array('', '');
        $string      = preg_replace($pregfind, $pregreplace, $string);
 
        return $string;
    }
}

$url = Yii::$app->urlManager->createUrl(['mingrui-doc/view', 'id' => $model->id,'type'=>$type]);

$actname = Yii::$app->controller->action->id;
$content = '';

if (strlen($model->doc)>8) {
  $content =  Attachments::widget(['model' => $model, 'field' => 'doc']);

} 
 
 
    $content .= delScript($model->description);
    $contentTitle =  $model->title ;
 

?>
<style type="text/css">
	.casecontent img{width: auto !important;height: auto !important;  }

</style>
<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                         
                        <span class="pull-right">
                            <?=date('Y-m-d', $model->createtime)?>
                        </span>
                        <h4>
		                        <?=$contentTitle?>
		                 </h4>

                </div>
                <!-- /.user-block -->
                <div class="box-tools ">
                    <?php

                   

                   if($actname=='index' && $type=='article')
                   { 
                    echo Html::a('评论', ['mingrui-doc/view', 'id' => $model->id,'type'=>$type], [
                        'class' => 'btn btn-info',                         
                        ]);
                    }  
                 ?>

                    <button class="btn btn-box-tool hide" data-widget="collapse" type="button">
                        <i class="fa fa-minus">
                        </i>
                    </button>
                    <button class="btn btn-box-tool hide" data-widget="remove" type="button">
                        <i class="fa fa-times">
                        </i>
                    </button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body casecontent">
  
                    <p>
                    <?= $content  ?>
                    </p> 
               
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
