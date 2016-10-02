<?php
namespace backend\widgets;

use yii\base\Widget;

class RestrepotTop extends Widget
{
    public $report_id;
    public function run()
    {  
        return $this->render('RestrepotTop', ['report_id' => $this->report_id]);
    }
 
}
