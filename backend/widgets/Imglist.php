<?php
namespace backend\widgets;

use yii\base\Widget;

class Imglist extends Widget
{
    public $dataProvider = [];
    public function run()
    {
        $modelS    = $this->dataProvider->getModels();
        

        return $this->render('Imglist', ['models' => $modelS]);
    }
 
}
