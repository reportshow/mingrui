<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_attachment".
 *
 * @property string $id
 * @property string $report_id
 * @property string $image
 * @property string $title
 * @property string $description
 * @property string $createtime
 */
class MingruiAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_attachment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_id', 'image', 'createtime'], 'required'],
            [['report_id', 'createtime'], 'integer'],
            [['image', 'title'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_id' => '报告id',
            'image' => '自增图片地址',
            'title' => '标题',
            'description' => '描述',
            'createtime' => '时间',
        ];
    }
}
