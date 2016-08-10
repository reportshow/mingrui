<?php
namespace backend\widgets;

use yii\base\Widget;

class Piechart extends Widget
{

    public $data = [];
    public $tag  = '';
    public $bars = "";

    public function run()
    {

        return $this->render('Piechart', ['model' => $this->data]);
    }
}
