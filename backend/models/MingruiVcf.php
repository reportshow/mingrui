<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;
/**
 * This is the model class for table "mingrui_vcf".
 *
 * @property string $id
 * @property string $title
 * @property string $notes
 * @property string $vcf
 */
class MingruiVcf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_vcf';
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
            [['title', 'uid'], 'required'],
            [['createtime','status'], 'safe'],
            [['title', 'notes', 'vcf'], 'string', 'max' => 255],
        ];
    }
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'title' => '标题',
            'notes' => '说明',
            'vcf'   => 'VCF文件',
        ];
    }
}
