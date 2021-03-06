<style type="text/css">
    .sidebar-menu ul.treeview-menu{display: block !important;}
</style>
    <div  style='position:fixed;bottom:0px;color:#333;z-index:3333'>
        &nbsp;客服电话: 010-53396195
    </div>
<?php

$menu = [
    ['label' => '查看报告', 'options' => ['class' => 'header']],
    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
];

$menu[] = [
    'label' => '我的报告',
    'icon'  => 'fa fa-files-o',
    'url'   => '#',
    'items' => [
        [
            'label' => '我的报告',
            'icon'  => 'fa fa-github',
            'url'   => ['/rest-report/myreport', 'id'=>3965],
        ],
        [
            'label' => '上传图片',
            'icon'  => 'fa fa-file-image-o',
            'url'   => ['/mingrui-mypic/index'],
        ],
        [
            'label' => '病例/记事',
            'icon'  => 'fa fa-calendar',
            'url'   => ['/mingrui-note/index'],
        ],
        [
            'label' => '常见问题',
            'icon'  => 'fa fa-stack-overflow',
            'url'   => ['/'],
        ],

    ],
];

/*
$menu[] = [
'label' => '资料共享',
'icon'  => 'fa fa-file-video-o',
'url'   => '#',
'items' => [
[
'label' => '共享视频',
'icon'  => 'fa  fa-video-camera',
'url'   => '#',
'items' => [

],
],
[
'label' => '共享案例',
'icon'  => 'fa fa-file-powerpoint-o',
'url'   => '#',
'items' => [

],
],
],
];*/

$menu[] = ['label' => '互动平台',
    'icon'             => 'fa fa-comments-o',
    'url'              => '#',
    'items'            => [
        [
            'label' => '常见QA',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/mingrui-qa'],
        ],
        [
            'label' => '在线留言',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/guestbook/view',  'id'=>'gb'.Yii::$app->user->id],
        ],
        [
            'label' => '联系方式',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['#'],
        ],

    ],
];

return $menu;

?>


