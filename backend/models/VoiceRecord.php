<?php

namespace backend\models;
use Yii;
use backend\components\Functions;

class VoiceRecord
{
    public static function saveRecordVoice($json)
    {

        $voices = json_decode($json);
        if (is_object($voices)) {
            foreach ($voices as $key => $voice) {
                $amr    = self::voicePath($voice);
                $result = Yii::$app->wechat->getMedia($voice->serverId);
                if ($result) {
                    file_put_contents($amr, $result);

                    if (1) {
                        $mp3 = self::makemp3($amr);
                        return $mp3;
                    }
                }
            }
        }

    }

    public static function voicePath($voice)
    {
        $serverId = md5($voice->serverId);
        $amr      = "upload/voice/" . $serverId . ".amr";
        if (!Functions::ismobile()) {
            $mp3 = self::makemp3($amr);
            return $mp3;
        }
        return $amr;

    }

    public static function makemp3($amr)
    {
        $mp3 = $amr . '.mp3';
        if (!file_exists($mp3)) {
            exec("avconv -i $amr $mp3", $output);
        }

        return $mp3;
    }
}
