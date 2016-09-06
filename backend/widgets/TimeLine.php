<?php
namespace backend\widgets;

use yii\base\Widget;

class TimeLine extends Widget
{
    public $dataProvider = [];
    public function run()
    { 
        return $this->render('TimeLine', ['models' => $this->dataProvider->getModels()]);
    }
}
