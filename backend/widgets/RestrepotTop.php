<?php
namespace backend\widgets;

use yii\base\Widget;

class RestrepotTop extends Widget
{
    public $model_id;
    public function run()
    {  
        return $this->render('RestrepotTop', ['model_id' => $this->model_id]);
    }
 
}
