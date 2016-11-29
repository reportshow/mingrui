<?php
return [
    'language' => 'zh-CN',
    'timeZone'=>'PRC',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
