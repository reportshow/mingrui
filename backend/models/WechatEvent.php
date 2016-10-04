<?php
namespace backend\models;

use common\components\WechatMessage;
use yii\web\Controller;

/**
 * Site controller
 */
class WechatEvent
{
    public $xml;
    public $reply;
    public function __construct($xml)
    {
        $this->xml = $xml;
        if ($this->xml) {
            $this->reply = new WechatMessage($this->xml);
        }
    }

    public function response()
    {
        //exit($this->reply->text('response')); 
        $Event = strtoupper(trim($this->xml['Event']));

        switch ($Event) {
            case 'CLICK':
                return $this->event_click();
                break;
            case 'SCAN':
                return $this->event_scan();
                break;

            default:
                # code...
                break;
        }

    }
    public function event_click()
    {
        //exit($this->reply->text('xxxxx')); 

        $eventname = strtolower(trim($this->xml['EventKey']));

        $eventname = str_replace('-', '_', $eventname);

        if (method_exists($this, $eventname)) {
           // return $this->sample_order(); 
            //return $this->$eventname();
            return call_user_func(array($this, $eventname));

        } else {
            return $this->reply->text('function not exists');
        }
    }
    public function event_scan()
    {

        if (method_exists($this, 'scan')) {
            $scene_id = strtolower(trim($this->xml['EventKey']));
            return $this->$scan($scene_id);
        }
    }
}
