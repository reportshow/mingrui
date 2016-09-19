<?php

$wechat           = [];
$wechat['config'] = [
    'appId'     => 'wxe7d7d82e913041cc',
    'appSecret' => 'a55977c014771490921a0503bf4efd7b',
    'token'     => 'doctor_mingrui',
];
$wechat['menu'] =  [
    [
        "name"       => "查看报告",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "查看报告",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat-doctor/report",
            ],
            [
                "type" => "view",
                "name" => "搜索报告",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat-doctor/search",
            ],
            [
                "type" => "view",
                "name" => "患者资料",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat-doctor/sicklist",
            ],

        ],
    ],

   [
        "type" => "click",
        "name" => "送检",
        "key"  => "SAMPLE-ORDER",
    ],

    [
        "type" => "click",
        "name" => "检查流程",
        "key"  => "WORK-FLOW",
    ],

];

return $wechat;
