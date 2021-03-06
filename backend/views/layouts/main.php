<?php
use yii\helpers\Html;
use backend\components\Functions;

/* @var $this \yii\web\View */
/* @var $content string */


   

if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */ 

    if( Functions::ismobile()) {   
       return  Yii::$app->controller->redirect(['/wechat-doctor/homepage' ]);         
    }

    echo $this->render(
        'main-login',
        ['content' => $content]
    );
    return;
}  

 if(!Yii::$app->user->Identity){ 
   return Yii::$app->controller->goHome();  
 }


    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
<!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" 
        content="width=device-width, initial-scale=1, minimum-scale=0.5, maximum-scale=2.0, user-scalable=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php 

        $this->head();
        require_once('include.php');
         ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>




    <?php 
    $this->endBody() ;
    require_once('include.footer.php');

    ?>
    </body>
    </html>
    <?php $this->endPage() ?>
 
