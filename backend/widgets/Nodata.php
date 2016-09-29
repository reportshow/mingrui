<?php
namespace backend\widgets;

use yii\base\Widget;

class Nodata extends Widget
{
    public $message = ''; //一条声音

    public function run()
    {

        return $this->render('Nodata', ['message' => $this->message]);
    }

}
