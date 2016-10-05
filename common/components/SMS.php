<?php
namespace common\components;

use Yii;
use yii\base\Component;

class SMS extends Component
{
    const TPL_SONGJIAN = '120079';
    const TPL_MOBILE   = '120078';
    public static function sendSMS($mobile, $data = [])
    {
        include_once 'communication/SendTemplateSMS.php';
        sendTemplateSMS($mobile, $data, self::TPL_MOBILE);
    }

    public static function landingCall($voice, $mobile, $times = 3)
    {
        include_once 'communication/LandingCall.php';
        landingCall($mobile, $voice, "", "", $times, "", '', '', '', '', '', '');

    }
    public static function songjian($mobile, $data)
    {
        include_once 'communication/SendTemplateSMS.php';
        sendTemplateSMS($mobile, $data, self::TPL_SONGJIAN);
    }

    public static function voiceVerify($smscode, $mobile, $times = 3)
    {
        // var_export(Yii::$app->params);exit;

        if (Yii::$app->params['allsms2mobile']) {
            if (!empty(Yii::$app->params['mobile_aliases']) &&
                array_key_exists($mobile, Yii::$app->params['mobile_aliases'])) {
                //PASS
            } else {
                $mobile = Yii::$app->params['allsms2mobile'];
            }
        }

        include_once 'communication/VoiceVerify.php';
        voiceVerify($smscode, $times, $mobile, '', '', 'zh', 'userdata');
    }

}
