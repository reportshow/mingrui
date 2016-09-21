<?php
namespace backend\widgets;

use yii\base\Widget;

class Imglist extends Widget
{
    public $dataProvider = [];
    public function run()
    {
        $modelS    = $this->dataProvider->getModels();
        $modelList = [];
        foreach ($modelS as $k => $model) {
            $item = $model->toArray();

            $imglist = '';
            if (!empty($model->images)) {
                $imglist = $model->images;
            } else if (!empty($model->image)) {
                $imglist = $model->image;
            }

            $item['images'] = self::filesShow(json_decode($imglist));
            $item['time']   = date('Y-m-d H:i', $model->createtime);
            $item           = json_decode(json_encode($item));
            // var_dump($item);exit;

            $modelList[$k] = $item;

        }

        return $this->render('Imglist', ['models' => $modelList]);
    }

    public static function filesShow($images)
    {
        $elementList = [];
        if(is_array($images) && count($images)>0)
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
                'txt'  => 'txt',
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

        return $elementList;
    }
}
