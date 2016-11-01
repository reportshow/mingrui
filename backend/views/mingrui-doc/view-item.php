<?php
use yii\helpers\Html;
use backend\widgets\Attachments;

echo Attachments::begin( );

if (!function_exists('delScript')) {
    function delScript($string)
    {
        $pregfind    = array("/<script.*>.*<\/script>/siU", '/on(mousewheel|mouseover|click|load|onload|submit|focus|blur)="[^"]*"/i');
        $pregreplace = array('', '');
        $string      = preg_replace($pregfind, $pregreplace, $string);
        return $string;
    }
}

$url = Yii::$app->urlManager->createUrl(['mingrui-doc/view', 'id' => $model->id]);

$actname = Yii::$app->controller->action->id;

if ($model->doc) {
  $content =  Attachments::widget(['model' => $model, 'field' => 'doc']);

} else {
    if ($actname == 'index') {
         $content = Html::encode(strip_tags($model->description));
    } else {
        // $description =   HtmlPurifier::process($model->description);
         $content = delScript($model->description);
    }
}

?><div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img alt="User Image" class="img-circle" src="<?=$model->creator->avatar?>" onerror="this.src='images/user2.png';"  />
                        <span class="username" style="color:#999;font-weight: normal">
                            <a href="#">
                                <?=$model->creator->nickname?>

                            </a>   <?=$model->creator->danwei?>
                        </span>
                        <span class="description">
                            <?=date('Y-m-d', $model->createtime)?>
                        </span>

                </div>
                <!-- /.user-block -->
                <div class="box-tools ">
                    <?php

                    if(Yii::$app->user->can('admin')){

                       echo Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ;
                       echo  Html::a('删除', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => '您确定要删除这条记录吗?',
                                'method' => 'post',
                            ],
                        ]);
                    }

                   if($actname=='index')
                   { 
                    echo Html::a('详情/评论', ['mingrui-doc/view', 'id' => $model->id], [
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
                <a style="font-family: 'Microsoft Yahei';font-size: 1.5rem;color: #333; line-height: 2rem;"
                 href="<?=$url?>">
                    <?=$model->title?>
                </a><br>
                <?= $content  ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>