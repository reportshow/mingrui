
<?php

$menu = [
    ['label' => '管理后台', 'url'=>'#','options' => ['class' => 'header']],
    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
];

$menu[] = [
    'label' => '报告仓库',
    'icon'  => 'fa fa-files-o',
    'url'   => '#',
    'items' => [
        [
            'label' => '报告管理',
            'icon'  => 'fa fa-calendar-plus-o',
            'url'   =>   ['/rest-report/index'],

        ],
       [
            'label' => '报告分类',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/rest-report-class/index'],

        ],
              [
            'label' => '报告搜索',
            'icon'  => 'fa fa-search-plus',
            'url'   => ['/rest-report/search'],

        ],
        [
            'label' => '外源数据分析',
            'icon'  => 'fa fa-puzzle-piece',
            'url'   => ['/vcf/index'],
            'items' => [

            ],
        ],
        [
            'label' => '外源报告',
            'icon'  => 'fa fa-ioxhost',
            'url'   => ['/reportstore/index'],
            'items' => [

            ],
        ],
    ],
];

/*$menu[] = [
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
];*/
$menu[]=[
            'label' => '患者管理',
            'icon'  => 'fa   fa-heartbeat',
            'url'   => ['/restsample/index'],
        ];

//use backend\models\MingruiOrder;
 //$orderCount = MingruiOrder::find()->where(['status'=>'init'])->count();

$menu[]=[
            'label' => '订单管理',
           // 'redcount'=> $orderCount, 
            'icon'  => 'fa   fa-dollar',
            'url'   => ['/orders/index'],
        ];

$menu[]= [
            'label' => '案例分享',
            'icon'  => 'fa fa-file-powerpoint-o',
            'url'   => ['/mingrui-doc/index','type'=>'article'],
            'items' => [

            ],
        ];
$menu[] = [
    'label' => '共享资料管理',
    'icon'  => 'fa fa-file-video-o',
    'url'   => '#',
    'items' => [
        [
            'label' => '基因分类',
            'icon'  => 'fa  fa-leaf text-yellow',
            'url'   => ["/genelist"], 
            'items' => [],
        ],

        [
            'label' => '共享视频',
            'icon'  => 'fa  fa-video-camera',
            'url'   => ["/video2"], 
            'items' => [],
        ],
        [
            'label' => '文档资料',
            'icon'  => 'fa fa-file-powerpoint-o',
            'url'   => ['/mingrui-doc/index','type'=>'doc'],
            'items' => [

            ],
        ],
      [
            'label' => '新闻资料',
            'icon'  => 'fa fa-chrome',
            'url'   => ['/mingrui-doc/index','type'=>'news'],
            'items' => [

            ],
        ],
      [
            'label' => '应用指南',
            'icon'  => 'fa fa-hand-o-right',
            'url'   => ['/mingrui-doc/index','type'=>'guide'],
            'items' => [

            ],
        ], 
/*        [
            'label' => '检测目录',
            'icon'  => 'fa fa-file-powerpoint-o',
            'url'   => ['/'],
            'items' => [

            ],
        ],*/
    ],
];

$menu[] = ['label' => '互动平台',
    'icon'             => 'fa fa-comments-o',
    'url'              => '#',
    'items'            => [
         [
            'label' => '积分',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/rest-client/score-list'],
        ],
        [
            'label' => '常见QA',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/mingrui-qa/index'],
        ],
        [
            'label' => '在线留言',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/comments/'],
        ],
                [
            'label' => '报告留言',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['/comments/reports'],
        ],
        [
            'label' => '联系方式',
            'icon'  => 'fa fa-pie-chart',
            'url'   => ['#'],
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
           /*  [
                'label' => '用户',
                'icon'  => 'fa fa-gears',
                'url'   => ['/admin/user'],
            ],
           */ 
            [
                'label' => '医生',
                'icon'  => 'fa fa-user-md',
                'url'   => ['/rest-client/index'],
                'items' => [

                ],
            ],

            [
                'label' => '患者',
                'icon'  => 'fa fa-user',
                'url'   =>  ['/restsample/index'],
                'items' => [

                ],
            ],
            [
                'label' => '医院',
                'icon'  => 'fa fa-hospital-o',
                'url'   =>   ['/rest-danwei/index'],
                'items' => [

                ],
            ],
        ],
    ];

 /******
    $menu[] = [
        'label' => '权限管理',
        'icon'  => 'fa fa-gears',
        'url'   => '#',
        'items' => [
            [
                'label' => '用户',
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
****/
/****
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
******/
} //if admin


 
return $menu;