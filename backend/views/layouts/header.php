<?php
use yii\helpers\Html;
use backend\models\userMessage;
use backend\widgets\GuestbookDrop;

/* @var $this \yii\web\View */
 
 $message = userMessage::myMessages();
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"><img src=logo.png style="width:36px"></span><span class="logo-lg"><img src=logo.png style="width:36px">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success"><?=count($message) ?></span>
                    </a>
                      <ul class="dropdown-menu">
                        <?=GuestbookDrop::widget(['message'=>$message]);?>
                      </ul>
                </li>
                  
             

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->user->identity->avatar ?>" class="user-image"  onerror="this.src='images/user2.png';"  alt="User Imagexx"/>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->nickname; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= Yii::$app->user->identity->avatar ?>" onerror="this.src='images/user2.png';"  class="img-circle"
                                 alt="User Image"/>

                            <p>
                                 周振芳
                                <small>（女，6岁）</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#"></a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">积分10</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#"></a>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">个人资料</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    '注销',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li style="display: none">
                    <a href="#" data-toggle="control-sidebar" >
                    <i class="fa fa-gears"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
