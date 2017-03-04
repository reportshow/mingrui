<?php
define('CURL_SSLVERSION_TLSv1',1);

$params = array_merge(
    require (__DIR__ . '/../../common/config/params.php'),
    require (__DIR__ . '/../../common/config/params-local.php'),
    require (__DIR__ . '/params.php'),
    require (__DIR__ . '/params-local.php')
);

return [
    'name'                => '明睿单病云管家',
    'id'                  => 'app-backend',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap'           => ['log'],
    'modules'             => [
        'admin'      => [
            'class' => 'mdm\admin\Module',
        ],
        'normaldata' => [
            'class' => 'backend\modules\normaldata\Module',
        ],
        'datas'      => [
            'class' => 'backend\modules\datas\Module',
        ],

    ],
    'aliases'             => [
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin', 
        '@dosamigos/datepicker'=>'@vendor/2amigos/yii2-date-picker-widget/src/DatePicker',      
    ],
    'as access'           => [
        'class'        => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*', //允许访问的节点， ！！没有加入的就默认不被访问
            //'admin/*',//允许所有人访问admin节点及其子节点
        ],
    ],

    'components'          => [
        'authManager'  => [
            'class'        => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
      /*'statistics' =>[
    	'class' =>'common\components\Statistics',
       ], */
         'statistics' =>[
		    'class' =>'common\components\Statistics',
		    //'on beforeAction' => ['common\components\Statistics','assign']
		],

        'user'         => [
            'identityClass' => 'common\models\User',
            //  'enableAutoLogin' => true,
            'on afterLogin' => function($event) {
                $user = $event->identity;
                $user->lastlogin();
              
            }
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [
                        'position' => \yii\web\View::POS_HEAD,
                    ],
                ],
/*                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-black-light',
                ],*/
            ],
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        /*
        'errorHandler' => [
            'errorAction' => 'site/index',
        ],
        */
        /*
    'urlManager' => [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
    ],
    ],
     */
    ],
    'params'              => $params,
];
