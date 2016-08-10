<?php
namespace backend\widgets;

use yii\base\Widget;

class NumberBox extends Widget
{
    public $number  = 0;
    public $tag     = 'tag';
    public $link    = null;
    public $links   = [];
    public $bgcolor = '';
    public $bag     = ''; //背景大提示,
    public $icon    = '';

    public function init()
    {
        parent::init();
        if (!$this->bgcolor) {
            $colors        = ["red", "yellow", "aqua", "blue", "light-blue", "green", "navy", "teal", "olive", "lime", "orange", "fuchsia", "purple", "maroon", "black", "red-active", "yellow-active", "aqua-active", "blue-active", "light-blue-active", "green-active", "navy-active", "teal-active", "olive-active", "lime-active", "orange-active", "fuchsia-active", "purple-active", "maroon-active", "black-active"];
            $this->bgcolor = $colors[array_rand($colors)];
        }
    }

    public function run()
    {
        if (!is_array($this->link)) {
            $this->link = ['查看更多' => $this->link];
        }
        if (strpos($this->icon, ' ') > 0) {
            $this->bag = $this->icon;
        } else {
            $this->bag = 'ion ion-' . $this->icon;
        }

        return $this->render('NumberBox', ['model' => $this]);
    }
}
