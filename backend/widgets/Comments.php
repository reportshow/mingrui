<?php
namespace backend\widgets;

use yii\base\Widget;

class Comments extends Widget
{
    public $comments = [];
    public $other    = [];
    public $id = 10;
    public $action = 'rest-report/send-comment';
    public $formaction = '';
    public function run()
    {
        
        $this->formaction = [$this->action, 'id'=>$this->id];
        return $this->render('Comments', ['model' => $this]);
    }
}
