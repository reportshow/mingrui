<?php

namespace backend\models;

use Yii;

class VoiceRecord
{
    public static function saveRecordVoice($json)
    {
        $voices = json_decode($json);
        foreach ($voices as $key => $voice) {
            $path   = self::voicePath($voice);
            $result = Yii::$app->wechat->getMedia($voice->serverId);
            if ($result) {
                //exit( $path);
                file_put_contents($path, $result);
            }
        }

    }

    public static function voicePath($voice)
    {
        $serverId = md5($voice->serverId);
        //return "upload/voice/Untitled1.wav";
        return "upload/voice/" . $serverId . ".amr";
    }
}
