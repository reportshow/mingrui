<?php
namespace backend\widgets;

use yii\base\Widget;

class Nodata extends Widget
{
    public $message    = ''; //一条声音
    public $title      = '';
    public $background = '';
    public function run()
    {
        if (empty($this->title)) {
            $this->title = '抱歉';
        }

        $content = $this->render('Nodata', [
            'message'    => $this->message,
            'title'      => $this->title,
            'background' => $this->background,
        ]);

        return $this->render(
            '/normal/nodata',
            ['content' => $content]
        );
    }

}
