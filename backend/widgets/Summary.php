<?php
namespace backend\widgets;

use yii\base\Widget;

class Summary extends Widget
{
    public $model = [];
    public $omims = [];
    public function run()
    {
         return $this->render('Summary', ['model' => $this->model, 'omims' => $this->omims]);
    }
}
