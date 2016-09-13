<?php

$wechat           = [];
$wechat['config'] = [
    'appId'     => 'wx41bc5a22461bb6ce',
    'appSecret' => '77a4a5504dcf7799ce9c57841ac1e72e',
    'token'     => 'doctor',
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
