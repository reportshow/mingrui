<?php
namespace backend\widgets;

use yii\base\Widget;

class GuestbookDrop extends Widget
{
    public $message;
    public function run()
    {

        return $this->render('GuestbookDrop', ['message' =>  $this->message]);
    }

}
