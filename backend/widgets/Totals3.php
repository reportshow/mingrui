<?php
namespace backend\widgets;

use yii\base\Widget;

class Totals3 extends Widget
{

    public $total = '56220';
    public $tag   = '';
    public $bars  = "";

    public function run()
    {
        for($i=0;$i<8;$i++)$this->bars .=  rand(0,100).','; 
        return $this->render('Totals3', ['model' => $this]);
    }
}
