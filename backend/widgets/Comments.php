<?php
namespace backend\widgets;

use yii\base\Widget;
use backend\models\MingruiComments;

class Comments extends Widget
{
    public $comments   = [];
    public $other      = [];
    public $id         = 0;
    public $action     = 'rest-report/send-comment';
    public $formaction = '';
    public function run()
    {
        $this->formaction = [$this->action, 'id' => $this->id];
        
        if(count($this->comments) < 1){
            $this->comments = MingruiComments::getOnegroup($this->id);
        }
        return $this->render('Comments', ['model' => $this]);
    }

    
}
