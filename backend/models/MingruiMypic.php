<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_mypic".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $images
 * @property string $createtime
 */
class MingruiMypic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_mypic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[  'title', 'createtime'], 'required'],
            [[  'createtime'], 'integer'],
            [['description', 'images'], 'string'],
            [['title'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'description' => '描述',
            'images' => '图片',
            'createtime' => 'Createtime',
        ];
    }
}
