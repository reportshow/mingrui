<?php

$menu =[];
/* [
    ['label' => '管理后台', 'options' => ['class' => 'header']],
    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
];
*/
$menu[] = [
    'label' => '报告管理',
    'icon'  => 'fa fa-files-o',
    'url'   => '#',
    'items' => [
        [
            'label' => '已出报告',
            'icon'  => 'fa fa-calendar-plus-o',
            'url'   => ['/rest-report/index'],

        ],
        [
            'label' => '未出报告',
            'icon'  => 'fa fa-clock-o',
            'url'   => ['/rest-report/index', 'unfinished' => 'yes'],

        ],

        [
            'label' => '外链数据',
            'icon'  => 'fa fa-puzzle-piece',
            'url'   => ['vcf/'],
            'items' => [

            ],
        ],
    ],
];

$menu[] = [
    'label' => '我的病人',
    'icon'  => 'fa fa-users',
    'url'   => '#',
    'items' => [
        [
            'label' => '在诊病人',
            'icon'  => 'fa   fa-heartbeat',
            'url'   => ['/restsample/index'],
        ],
        [
            'label' => '历史病人',
            'icon'  => 'fa  fa-history',
            'url'   => '#',
            'url'   => ['/restsample/index', 'old' => 'yes'],
        ],
    ],
];

$menu[] = [
    'label' => '资料共享',
    'icon'  => 'fa fa-file-video-o',
    'url'   => '#',
    'items' => [
        [
            'label' => '共享视频',
            'icon'  => 'fa  fa-video-camera',
            'url'   => ['/mingrui-video/index'],
            'items' => [],
        ],
        [
            'label' => '共享案例',
            'icon'  => 'fa fa-file-powerpoint-o',
            'url'   => ['/mingrui-doc/index'],
            'items' => [

            ],
        ],
    ],
];

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
            'url'   => ['/guestbook/my'],
        ],
        [
            'label' => '联系方式',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['#'],
        ],

    ],
];

return $menu;
