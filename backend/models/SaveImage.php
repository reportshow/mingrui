<?php

namespace backend\models;

use yii\web\UploadedFile;

/**
 * This is the model class for table "mingrui_mypic".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $images
 * @property string $createtime
 */
class SaveImage
{
    public static function save($model, $field)
    {
        $imageupList = UploadedFile::getInstances($model, $field);
        $id          = $model->id;
        $classname   = $model->className();
        $classname = substr($classname , strrpos($classname ,'\\')+1);
        $dir         = "upload/{$classname}/";
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        $imglist = [];

        foreach ($imageupList as $index => $image) {

            $imgpath   = "{$dir}/{$id}-{$index}.png";
            $imglist[] = $imgpath;
            $image->saveAs($imgpath);
        }
        $model->$field = join(';', $imglist);
        $model->save();
    }

}
