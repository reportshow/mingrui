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
 * @property string $gene
 * @property string $pingjia
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
            [['uid', 'pingjia', 'createtime'], 'integer'],
            [['diagnose', 'attachements'], 'string'],
            [['sick', 'tel', 'gene'], 'string', 'max' => 64],
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
            'gene' => '异常基因',
            'pingjia' => '星级评价',
            'attachements' => '报告',
            'createtime' => '时间',
        ];
    }
}
