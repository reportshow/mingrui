<?php

$wechat           = [];
$wechat['config'] = [
    'appId'     => 'wx2e2b79657aeebc95',
    'appSecret' => 'dd00404e0d0e4edbb9ed88d068855941',
    'token'     => 'sanrenxiyi',
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
