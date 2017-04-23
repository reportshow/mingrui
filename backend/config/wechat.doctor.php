<?php

$wechat           = [];
$wechat['config'] = [
    'appId'     => 'wxe7d7d82e913041cc',
    'appSecret' => 'a55977c014771490921a0503bf4efd7b',
    'token'     => 'doctor_mingrui',
];
$wechat['menu'] = [
    [
        "name"       => "报告管理",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "查看报告",
                "url"  => "http://www.mono-mr.com/backend/web/?r=wechat-doctor/report",
            ],
            [
                "type" => "view",
                "name" => "搜索报告",
                "url"  => "http://www.mono-mr.com/backend/web/?r=wechat-doctor/search",
            ],
            [
                "type" => "view",
                "name" => "患者资料",
                "url"  => "http://www.mono-mr.com/backend/web/?r=wechat-doctor/sicklist",
            ],

        ],
    ],

    [
        "name"       => "一键下单",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "确认送检",
                "key"  => "SAMPLE-ORDER",
                'url'=>'http://www.mono-mr.com/backend/web/?r=wechat-doctor/doorder',
            ],
        ],
    ],
   [
        "name"       => "基因查询",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "基因查询",
                'url'=>'http://www.mono-mr.com/apps/web/index.php?r=gene',
            ],
            [
                "type" => "click",
                "name" => "常见问题",
                "key"  => "WORK-FLOW",
                'url'=>'http://www.mono-mr.com/backend/web/?r=/mingrui-qa',
            ],
        ]
    ]
];

return $wechat;
