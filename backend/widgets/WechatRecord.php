<?php
namespace backend\widgets;

use Yii;
use yii\base\Widget;

class WechatRecord extends Widget
{
    public $dataProvider = [];
    public function run()
    {
        //$config = json_encode(Yii::$app->wehcat->jsApiConfig());
        $config = json_encode(
            Yii::$app->wechat->jsApiConfig([
                'jsApiList' => [
                    'startRecord', 'stopRecord', 'onVoiceRecordEnd', 'playVoice', 'pauseVoice', 'stopVoice', 'onVoicePlayEnd',
                    'uploadVoice', 'downloadVoice','translateVoice',
                ],
            ], false)
        );

        return $this->render('WechatRecord', ['config' => $config]);
    }

}
