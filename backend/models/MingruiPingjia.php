<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
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

    public static $pingjiaText =
        [1 => ['key' => '★', 'label' => '疑似阳性',''],
        2  => ['key' => '★★', 'label' => '阳性'],
        3  => ['key' => '★★★', 'label' => '阳性+好案例'],
        4  => ['key' => '■', 'label' => '阴性'],
        5  => ['key' => '■ ■', 'label' => '阳性+特殊案例'],
        //6 =>['key'=>' x', 'label'=>'x'],
    ];
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
                'value'=> new Expression('NOW()'),
            ],
        ];
    }
    public static function getTextArray(){
        $text = [];
        foreach (self::$pingjiaText as $key => $value) {
            $text[$key] = $value['key'] .' '. $value['label'] .' ';
        }
        return $text;
    }
    public function getPingjaX()
    {
        return self::$pingjiaText[$this->pingjia];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_id'], 'required'],
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
            'id'         => 'ID',
            'report_id'  => 'Report ID',
            'uid'        => 'Uid',
            'pingjia'    => 'Pingjia',
            'linchuang'  => '临床',
            'createtime' => 'Createtime',
        ];
    }
}
