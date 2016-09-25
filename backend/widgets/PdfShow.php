<?php
namespace backend\widgets;

use yii\base\Widget;

class PdfShow extends Widget
{
    public $pdfurl = '';
    /*public static $hasbegined = false;
    public static function begin($config = [])
    {
    if (static::$hasbegined) {
    return;
    }

    static::$hasbegined = true;

    $tmp = new PdfShow();

    return $tmp->render('Attachments', ['init' => true]);
    }*/
    public function run()
    {
        return $this->render('PdfShow', ['pdfurl' => $this->pdfurl]);
    }

}
