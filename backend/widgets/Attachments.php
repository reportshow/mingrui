<?php
namespace backend\widgets;

use yii\base\Widget;

class Attachments extends Widget
{
    public $model             = [];
    public $field             = null; //取模型的这个字段
    public static $instance = null;
    public  static function begin($config = [])
    { 
        if (static::$instance) {
            return;
        }

        static::$instance =  new Attachments();

        return static::$instance->render('Attachments', ['init' => true]);
    }
    public function run()
    {

        $imglist = '';
        if ($this->field) {
            $field   = $this->field;
            $imglist = $this->model->$field;
        } else if (!empty($this->model->images)) {
            $imglist = $this->model->images;
        } else if (!empty($this->model->image)) {
            $imglist = $this->model->image;
        }

        $files = self::filesShow(json_decode($imglist));
        return $this->render('Attachments', ['files' => $files]);
    }

    public static function filesShow($images)
    {
        $elementList = [];
        if (is_array($images) && count($images) > 0) {
            foreach ($images as $key => $imageObj) {
                $filepath = $imageObj->path;
                $filename = $imageObj->name;
                if (!($filepath = trim($filepath))) {
                    continue;
                }

                $pathinfo = pathinfo($filename);

                if (empty($pathinfo["extension"])) {
                    $ext = 'NULL';
                } else {
                    $ext = strtolower($pathinfo["extension"]);
                }

                $fileExts = [
                    'zip'  => 'zip', 'rar'  => 'rar',
                    'wav'  => 'wav', 'mp3'  => 'mp3',
                    'xls'  => 'xls',
                    'xlsx' => 'xls',
                    'mp4'  => 'mp4', 'wmv'  => 'wmv',
                    'null' => 'file',
                    'pdf'  => 'pdf',
                    'ppt'  => 'ppt', 'pptx' => 'ppt', 'pub' => 'pub',
                    'wma'  => 'sound',
                    'txt'  => 'txt', 'css'  => 'css',
                    'doc'  => 'doc',
                    'docx' => 'doc',
                ];
                if (strpos('==png,jpg,jpeg,bmp,gif,', $ext) > 0) {
                    $elementList[] = ['type' => 'image', 'url' => $filepath];

                } else if (array_key_exists($ext, $fileExts)) {
                    $icon          = 'images/icon/' . $fileExts[$ext] . '.png';
                    $elementList[] = [
                        'type' => 'file', 'icon'        => $icon,
                        'url'  => $filepath, 'filename' => $filename];

                }

            }
        }

        return json_decode(json_encode($elementList));
    }
}
