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
 
if ($actname == 'index') {
     $description = mb_substr(strip_tags($model->description),0,500);
     $content .= Html::encode($description);
     $content .= '......&nbsp; &nbsp;<b>(查看全文)</b>';

     $content = "<a  href='$url'  > $content </a>";
     $contentTitle = "<a  href='$url'  > ".$model->title." </a>";
} else {
    // $description =   HtmlPurifier::process($model->description);

    $content .= delScript($model->description);
    $contentTitle =  $model->title ;
}
 

?><div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                        <img alt="User Image" class="hide img-circle" src="<?=$model->creator->avatar?>" onerror="this.src='images/user2.png';"  />
                        <span class="Xusername" style="color:#999;font-weight: normal">
                            <a href="#">
                                <?=$model->creator->nickname?>

                            </a>   <?=$model->creator->danwei?>
                        </span>
                        <span class="Xdescription">
                            <?=date('Y-m-d', $model->createtime)?>
                        </span>

                </div>
                <!-- /.user-block -->
                <div class="box-tools ">
                    <?php

                    if(Yii::$app->user->can('admin')){

                       echo Html::a('修改', ['update', 'id' => $model->id,'type'=>$type], ['class' => 'btn btn-primary']) ;
                       echo  Html::a('删除', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => '您确定要删除这条记录吗?',
                                'method' => 'post',
                            ],
                        ]);
                    }

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
            <div class="box-body">

                    <h4>
                        <?=$contentTitle?>
                    </h4>
                    
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