<?php
namespace backend\widgets;

use yii\base\Widget;

class ChartLine extends Widget
{
    public $labels     = [];
    public $data       = [];
    public $link       = '#';
    public $bgcolor    = '';
    public $bag        = ''; //背景大提示
    public $fillcolors = [  '#A3E8F9', '#6CDCF7', '#45D9FD', '#00C0EF', '#04A6CE', '#0486A7', '#036882', '#03495A'];

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        return $this->render('ChartLine', ['model' => $this]);
    }
}
