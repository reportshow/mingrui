<?php
 
 include_once "SDK/CCPRestSDK.php";


//主帐号,对应开官网发者主账号下的 ACCOUNT SID
$accountSid = Yii::$app->params['sms']['accountSid'];

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
$accountToken =  Yii::$app->params['sms']['accountToken'];

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
$appId = Yii::$app->params['sms']['appId'];

//请求地址，格式如下，不需要写https://
//$serverIP = 'sandboxapp.cloopen.com';
$serverIP = 'app.cloopen.com';
//请求端口
$serverPort = '8883';

//REST版本号
$softVersion = '2013-12-26';