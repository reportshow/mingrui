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
    
    public static $pingjiaText = ['1'=>'★','2'=>'★★',3=>'★★★',4=>'■',5=>'■ ■'];
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
    public function getPingjaX(){
        return self::$pingjiaText[$this->pingjia];
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
            'linchuang' => '临床',
            'createtime' => 'Createtime',
        ];
    }
}
