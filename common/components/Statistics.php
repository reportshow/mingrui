<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\Event;


class Statistics extends Component
{
    const TPL_SONGJIAN = '120079';
    const TPL_MOBILE   = '120078';
 	
 	  function __construct(){ 
       //exit('fffff');
 	}
    public static function doCount(){ 
    	 $controllerID = Yii::$app->controller->id;
         $actionID     = Yii::$app->controller->action->id;

         self::countAdd( $controllerID);

    }
    public static function countAdd($actId) { 
    	$data = self::getCache('statistics'); 
    	if(empty($data[$actId])){
    		$data[$actId]=0;
    	}

    	$data[$actId] = $data[$actId]+1;
        self::saveCache('statistics', $data);
    }
    public function getCache($name){ 
    	$file =  self::cachefile($name);
    	if(!file_exists($file)){ 
    		return [];
    	}
    	include $file;
    	return $CACHE;
    }
    public function saveCache($name, $obj){ 
    	$file =  self::cachefile($name);
    	$data = "<?php  \n  \$CACHE=" . var_export($obj,1) . ";  ?>";
    	file_put_contents($file, $data);

    }
    public function cachefile($name){ 
    	return "".$name .'.php';
    }
}
