<?php
namespace backend\widgets;

use yii\base\Widget;

class Progressbig extends Widget
{

    public $total    = '56220';
    public $tag      = '';
    public $percent  ;
    public $partinfo;
    public $color;
    public $icon;

    public function init()
    {
        parent::init();

        
 
    }

    public function run()
    {
         //var_dump($this);exit;
        return $this->render('Progressbig', ['model' => $this]);
    }
}
