<?php
namespace backend\widgets;

use yii\base\Widget;

class Totals extends Widget
{

    public $total    = '56220';
    public $tag      = '';
    public $increase = '0';
    public $color;
    public $arrow;
    public function init()
    {
        parent::init();

        $inc = intval($this->increase);

        if ($inc > 0) {
            $this->color = 'red';
            $this->arrow = 'up';
        }else if ($inc < 0) {
            $this->color = 'green';
            $this->arrow = 'down';
        } else if ($inc == 0) {
            $this->color = 'yellow';
            $this->arrow = 'left';
        }
    }

    public function run()
    {
         //var_dump($this);exit;
        return $this->render('Totals', ['model' => $this]);
    }
}
