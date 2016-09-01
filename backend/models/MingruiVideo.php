<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_video".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $youku_url
 * @property string $createtime
 */
class MingruiVideo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['createtime'], 'integer'],
            [['title', 'youku_url'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'title' => '标题',
            'description' => '描述',
            'youku_url' => '视频地址',
            'createtime' => '发布时间',
        ];
    }
}
