<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "mingrui_notes".
 *
 * @property string $id
 * @property string $type
 * @property string $title
 * @property string $image
 * @property string $content
 * @property string $voice
 * @property string $createtime
 */
class MingruiNotes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_notes';
    }
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => false,
                'value'              => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['type'], 'string'],
            [['createtime'], 'safe'],
            [['title', 'image'], 'string', 'max' => 512],
            [['content', 'voice'], 'string', 'max' => 1024],
        ];
    }

    public function getVoiceUrl()
    {
        return $this->voice;
    }
    public function getImages()
    {
        return explode(';', $this->image);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'type'       => '类型',
            'title'      => '标题',
            'image'      => '图片',
            'content'    => '内容',
            'voice'      => '语音',
            'createtime' => 'Createtime',
        ];
    }
}
