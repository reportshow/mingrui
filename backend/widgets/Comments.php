<?php
namespace backend\widgets;

use yii\base\Widget;

class Comments extends Widget
{
    public $comments = [];
    public $other    = [];
    public $id = 10;
    public function run()
    {
        return $this->render('Comments', ['model' => $this]);
    }
}
