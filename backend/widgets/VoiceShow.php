<?php
namespace backend\widgets;

use yii\base\Widget;
use Yii;
use backend\models\VoiceRecord;
 

class VoiceShow extends Widget
{
    public $voice = []; //一条声音
    public static $instance;

    public static function begin($config = [])
    {
        if (!self::$instance) {
            self::$instance = new VoiceShow();
        }

        return self::$instance->render('VoiceShow', ['init' => 'yes']);
    }
    public function run()
    {

        $this->voice->url     = VoiceRecord::voicePath($this->voice);
        $this->voice->voiceid = md5($this->voice->serverId);
        return $this->render('VoiceShow', ['voice' => $this->voice]);
    }

     

}
