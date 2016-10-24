<?php
namespace backend\widgets;

use yii\base\Widget;

/*

 */

class NavTabs extends Widget
{
    public $position;
    public $header = 'xxx';
    public $icon   = 'th';
    public $data   = ['news' => ['icon' => 'th', 'name' => 'xxx', 'content' => 'xxxxxx']];
    public function run()
    {

        if (!$this->position) {
            $this->position = 'left';
        }
        
        return $this->render('NavTabs', ['model' => $this]);
    }

}
