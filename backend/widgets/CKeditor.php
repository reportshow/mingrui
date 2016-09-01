<?php
namespace backend\widgets;

use yii\base\Widget;

class CKeditor extends Widget
{

    public $name       = '';
    public $placehoder = '';
    public $title      = '';
    public function run()
    {

        return $this->render('CKeditor', ['model' => $this]);
    }
}
