<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mycodes".
 *
 * @property string $id
 * @property string $uid
 * @property string $codes
 */
class Mycodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mycodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid'], 'integer'],
            [['codes'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => '我的id',
            'codes' => '我的自选股',
        ];
    }
}
