<?php
namespace backend\widgets;

use yii\base\Widget;

class Imglist  extends Widget
{
    public $dataProvider = [];
    public function run()
    { 
        return $this->render('Imglist', ['models' => $this->dataProvider->getModels()]);
    }
}
