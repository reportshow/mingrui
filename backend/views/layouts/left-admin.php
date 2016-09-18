<?php

$menu = [
    ['label' => '管理后台', 'options' => ['class' => 'header']],
    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
];

$menu[] = [
    'label' => '报告管理',
    'icon'  => 'fa fa-files-o',
    'url'   => '#',
    'items' => [
        [
            'label' => '报告检索',
            'icon'  => 'fa fa-calendar-plus-o',
            'url'   =>   ['/rest-report/index'],

        ],

        [
            'label' => '外链数据',
            'icon'  => 'fa fa-puzzle-piece',
            'url'   => '#',
            'items' => [

            ],
        ],
    ],
];

$menu[] = [
    'label' => '患者管理',
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
            'url'   => ['/restsample/index','old'=>'yes'],
        ],
    ],
];

$menu[] = [
    'label' => '共享资料管理',
    'icon'  => 'fa fa-file-video-o',
    'url'   => '#',
    'items' => [
         
        [
            'label' => '共享视频',
            'icon'  => 'fa  fa-video-camera',
            'url'   => ["/video2"], 
            'items' => [],
        ],
        [
            'label' => '共享案例',
            'icon'  => 'fa fa-file-powerpoint-o',
            'url'   => ['/mingrui-doc'],
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
            'url'   => ['/normaldata/company'],
        ],
        [
            'label' => '在线留言',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/rest-client/'],
        ],
        [
            'label' => '联系方式',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/normaldata/industry'],
        ],

    ],
];

if (yii::$app->user->can('admin')) {

    $menu[] = ['label' => '管理员', 'options' => ['class' => 'header']];
    $menu[] = [
        'label' => '客户管理',
        'icon'  => 'fa fa-users',
        'url'   => '#',
        'items' => [
            [
                'label' => '医生',
                'icon'  => 'fa fa-user-md',
                'url'   => ['/rest-client'],
                'items' => [

                ],
            ],

            [
                'label' => '患者',
                'icon'  => 'fa fa-user',
                'url'   =>  ['/restsample'],
                'items' => [

                ],
            ],
            [
                'label' => '医院',
                'icon'  => 'fa fa-hospital-o',
                'url'   =>   ['/rest-danwei'],
                'items' => [

                ],
            ],
        ],
    ];
    $menu[] = [
        'label' => '权限管理',
        'icon'  => 'fa fa-gears',
        'url'   => '#',
        'items' => [
            [
                'label' => '员工',
                'icon'  => 'fa fa-gears',
                'url'   => ['/admin/user'],
            ],
            [
                'label' => '角色',
                'icon'  => 'fa fa-user',
                'url'   => ['/admin/role'],
            ],
            [
                'label' => '权限',
                'icon'  => 'fa fa-balance-scale',
                'url'   => ['/admin/permission'],
            ],
            [
                'label' => '分配',
                'icon'  => 'fa fa-circle-o',
                'url'   => ['/admin/assignment'],
            ],
            [
                'label' => '路由',
                'icon'  => 'fa fa-car',
                'url'   => ['/admin/route'],
            ],
            [
                'label' => '菜单',
                'icon'  => 'fa fa-list',
                'url'   => ['/admin/menu'],
            ],

        ],
    ];

    $menu[] = [
        'label' => '功能',
        'icon'  => 'fa fa-gears',
        'url'   => '#',
        'items' => [
            [
                'label' => '开发',
                'icon'  => 'fa fa-code',
                'url'   => ['/'],
            ],
            [
                'label' => '调试',
                'icon'  => 'fa fa-bug',
                'url'   => ['/'],
            ],
            [
                'label' => ' ',
                'icon'  => 'fa fa-circle-o',
                'url'   => ['/'],
            ],
            [
                'label' => ' ',
                'icon'  => 'fa fa-circle-o',
                'url'   => ['/'],
            ],
        ],
    ];

} //if admin


return $menu;