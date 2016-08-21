<?php
namespace backend\widgets;

use yii\base\Widget;

class Comments extends Widget
{
    public $comments = [];
    public $other    = [];
    public function run()
    {
        return $this->render('Comments', ['model' => $this]);
    }
}
