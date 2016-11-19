<?php
namespace backend\widgets;

use yii\base\Widget;

class LoadingPage extends Widget
{ 
    public $finish=null;
    public function run()
    {
        
        return $this->render(
            'LoadingPage',
            ['finish'=>$this->finish]
        );
    }

}
