<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "mingrui_reportstore".
 *
 * @property string $id
 * @property string $uid
 * @property string $sick
 * @property string $product
 * @property string $tel
 * @property string $diagnose
 * @property string $attachements
 * @property string $createtime
 */
class MingruiReportstore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_reportstore';
    }
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => false,
                //'value'              => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'createtime'], 'integer'],
            [['diagnose', 'attachements'], 'string'],
            [['sick', 'tel'], 'string', 'max' => 64],
            [['product'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '医生的id',
            'sick' => '患者姓名',
            'product' => '检测项目',
            'tel' => '联系电话',
            'diagnose' => '临床诊断',
            'attachements' => '报告',
            'createtime' => '时间',
        ];
    }
}
