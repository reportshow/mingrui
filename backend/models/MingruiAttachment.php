<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
            [['report_id', 'createtime'], 'required'],
            [['report_id', 'createtime'], 'integer'],
            [[ 'title'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024],
            [['image'], 'string' ],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => false,
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'report_id'   => '原报告id',
            'image'       => '报告图片',
            'title'       => '标题',
            'description' => '描述',
            'createtime'  => '时间',
        ];
    }
}
