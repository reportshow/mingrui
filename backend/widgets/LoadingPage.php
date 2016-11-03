<?php
namespace backend\widgets;

use yii\base\Widget;

class LoadingPage extends Widget
{ 
    public function run()
    {
        
        return $this->render(
            'LoadingPage',
            []
        );
    }

}
