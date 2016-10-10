<?php

$wechat           = [];
$wechat['config'] = [
    'appId'     => 'wx370db2383bd1ffaf',
    'appSecret' => '9cb5d237cc1edc2429aeb8fb9b0fef0e',
    'token'     => 'guest_jingzhun6688',
];
$wechat['menu'] = [
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
        'url'=>'javascript:;',
    ],

];

return $wechat;
