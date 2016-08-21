<?php

namespace backend\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "mingrui_comments".
 *
 * @property string $id
 * @property string $uid
 * @property string $to_uid
 * @property string $report_id
 * @property string $content
 * @property string $createtime
 */
class MingruiComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'report_id', 'content'], 'required'],
            [['uid', 'to_uid', 'report_id'], 'integer'],
            [['createtime'], 'safe'],
            [['content'], 'string', 'max' => 1024],
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

    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
    public function getTouser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_uid']);
    }
    public function getPosition()
    {
        if ($this->to_uid) {
            return 'right';
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'uid'        => 'Uid',
            'to_uid'     => 'To Uid',
            'report_id'  => 'Report xd',
            'content'    => 'Content',
            'createtime' => 'Createtime',
        ];
    }
}
