<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "mingrui_pingjia".
 *
 * @property string $id
 * @property string $report_id
 * @property string $uid
 * @property integer $pingjia
 * @property string $linchuang
 * @property string $createtime
 */
class MingruiPingjia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_pingjia';
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
    public function rules()
    {
        return [
            [['report_id' ], 'required'],
            [['report_id', 'uid', 'pingjia'], 'integer'],
            [['linchuang'], 'string'],
            [['createtime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_id' => 'Report ID',
            'uid' => 'Uid',
            'pingjia' => 'Pingjia',
            'linchuang' => 'Linchuang',
            'createtime' => 'Createtime',
        ];
    }
}
