<?php
 
 include_once "SDK/CCPRestSDK.php";


//主帐号,对应开官网发者主账号下的 ACCOUNT SID
$accountSid = '8aaf0708573c3ddd0157408261dc0330';

//主帐号令牌,对应官网开发者主账号下的 AUTH TOKEN
$accountToken = '4cf1486fb7d3426ebb0144cb02e6a933';

//应用Id，在官网应用列表中点击应用，对应应用详情中的APP ID
//在开发调试的时候，可以使用官网自动为您分配的测试Demo的APP ID
$appId = '8aaf0708573c3ddd0157408262f00336';

//请求地址，格式如下，不需要写https://
$serverIP = 'sandboxapp.cloopen.com';

//请求端口
$serverPort = '8883';

//REST版本号
$softVersion = '2013-12-26';