<?php
namespace backend\models;

use yii\web\Controller;
use common\components\WechatMessage;

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
        //var_export($this->xml);
        if (trim($this->xml['Event']) == 'CLICK') {
         return   $this->clickevents();
        };

    }
    public function clickevents()
    { 
        $event = strtolower(trim($this->xml['EventKey']));
        
        $event = str_replace('-', '_', $event); 
        if (method_exists($this, $event)) {           
            return $this->$event();
        } else {
            return $this->reply->text('function not exists');
        }
    }
}
