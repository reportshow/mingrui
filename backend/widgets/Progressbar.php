<?php
namespace backend\widgets;

use yii\base\Widget;

class Progressbar extends Widget
{
    public $done    = 10;
    public $total   = 100;
    public $percent = '30%';
    public $tag     = 'tag';
    public $link    = '#';
    public $bgcolor = '';
    public $color   = '';

    public function init()
    {
        parent::init();
        if (!$this->color) {
            $colors      = ["red", "yellow", "aqua", "blue", "light-blue", "green", "navy", "teal", "olive", "lime", "orange", "fuchsia", "purple", "maroon", "black", "red-active", "yellow-active", "aqua-active", "blue-active", "light-blue-active", "green-active", "navy-active", "teal-active", "olive-active", "lime-active", "orange-active", "fuchsia-active", "purple-active", "maroon-active", "black-active"];
            $this->color = $colors[array_rand($colors)];
        }
    }

    public function run()
    {
        $total               = $this->total;
        $total == 0 ? $total = 1 : null;

        $percent                  = intval(100 * $this->done / $total);
        $percent > 100 ? $percent = 100 : null;

        $this->percent = $percent . '%';

        return $this->render('Progressbar', ['model' => $this]);
    }
}
