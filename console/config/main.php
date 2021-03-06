<?php
$params = array_merge(
    require (__DIR__ . '/../../common/config/params.php'),
    require (__DIR__ . '/../../common/config/params-local.php'),
    require (__DIR__ . '/params.php'),
    require (__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-console',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases'             => [
        '@shark' => '@vendor/shark/simple_html_dom',
    ],
    'modules'             => [
        'spider' => [
            'basePath' => '@console/modules/spider',
            'class'    => 'console\modules\spider\Module',
        ],
    ],
    'components'          => [
        'log' => [
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => [],  
                ],
            ],
        ],
    ],
    'params'              => $params,
];
