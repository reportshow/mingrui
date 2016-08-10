<?php

$params = array_merge(
    require (__DIR__ . '/params.php'),
    require (__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-api',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'api\controllers',
    'modules'             => [

    ], 
    'components'          => [
        'user'     => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'request'    => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class'      => 'yii\web\Response',
            'formatters' => [
                'jsonFormat' => 'api\components\JsonFormatter',
            ],
        ],

    ],
    'params'              => $params,
];
