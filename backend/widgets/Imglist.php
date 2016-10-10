<?php
namespace backend\widgets;

use yii\base\Widget;

class Imglist extends Widget
{
    public $dataProvider = [];
    public $nullMessage = '当前页面没有数据，提交一个吧:-)';
    public function run()
    {
        $modelS    = $this->dataProvider->getModels();
        
        if (count($modelS) < 1) {
        	 return $this->render('Nodata', ['message' => $this->nullMessage ]);
        }

        return $this->render('Imglist', ['models' => $modelS]);
    }
 
}
