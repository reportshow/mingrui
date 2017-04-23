<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use apps\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
dmstr\web\AdminLteAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, minimum-scale=1.0">
    <div id='wx_pic' style='margin:0 auto;display:none;'><img src='images/icon3.png' /></div>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
  <style>
     body {background-color:#20252B !important;
        background-image: url(images/pic3-2.jpg) !important;
        background-size: cover !important;
        background-position: 100% !important;
        color:#fff;}
    .table-striped > tbody > tr:nth-of-type(odd){
		background-color: rgba(195, 209, 240, 0.22);
     }

    .alert-info{margin-top: 30%;
        background-color: rgba(0, 192, 239, 0.5) !important;}
 </style>
 
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
   /* NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    */

    if(Yii::$app->controller->action->id !='index'){
        echo "<div style='padding-left:30px;height: 10px;'>"
        . Html::a('主页', ['gene/index'], ['class' => 'btn btn-info'])

       . Html::a('下单', ['genelist-order/create'], ['class' => 'btn btn-success'])
        ."</div>";
        
        
    }
    ?>

    <div class="container" style="padding:30px;margin:0px">
        <?
        /* echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ])
        */?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer style='background: none; bottom: 0px;'>
    <div class="container">
        <p class='text-center'>北京金准基因科技有限责任公司     </p>

        <p class='text-center'>
            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261612282'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261612282%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
金准医学检验所      客服:010-53396195
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
