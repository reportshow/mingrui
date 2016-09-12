<?php

$wechat           = [];
$wechat['config'] = [
    'appId'     => 'wx123567b0f784b9b9',
    'appSecret' => 'fb1e2313a4cc17e1b149d6a2b3234eb6',
    'token'     => 'sanrenxiyi',
];
$wechat['menu'] =  [
    [
        "name"       => "我的报告",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "查看报告",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat/my-report",
            ],
            [
                "type" => "view",
                "name" => "上传图片",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat/my-upload",
            ],
            [
                "type" => "view",
                "name" => "我的图片",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat/my-pic",
            ],

        ],
    ],

    [
        "name"       => "记事本",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "新建记事",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat/notes-new",
            ],
            [
                "type" => "view",
                "name" => "查看记事",
                "url"  => "http://ding.scicompound.com/mingrui/report/backend/web/?r=wechat/notes-index",
            ],
        ],
    ],

    [
        "type" => "click",
        "name" => "检查流程",
        "key"  => "WORK-FLOW",
    ],

];

return $wechat;
