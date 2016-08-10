<?php
namespace backend\widgets;

use yii\base\Widget;

class ProgressTable extends Widget
{

    public $orders = [];

    public function init()
    {
        parent::init();

    }

    public function run()
    {
        $orders = [];
        foreach ($this->orders as $key => $value) {
            $rand = '';
            for ($i = 0; $i < 8; $i++) {
                $rand .= (rand(0, 200) - 50) . ',';
            }
           
            $orders[] = $value;
        }

        return $this->render('ProgressTable', ['orders' => $orders]);
    }
}
