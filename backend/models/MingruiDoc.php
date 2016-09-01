<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_doc".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $doc
 * @property string $createtime
 */
class MingruiDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'createtime'], 'required'],
            [['description'], 'string'],
            [['createtime'], 'integer'],
            [['title', 'doc'], 'string', 'max' => 1024],
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
            'doc' => '文档',
            'createtime' => 'Createtime',
        ];
    }
}
