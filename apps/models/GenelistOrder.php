<?php

namespace apps\models;

use Yii;

/**
 * This is the model class for table "genelist_order".
 *
 * @property string $id
 * @property string $name
 * @property string $tel
 * @property string $city
 * @property string $createtime
 * @property string $state
 */
class GenelistOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genelist_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createtime'], 'integer'],
            [['name', 'city', 'state'], 'string', 'max' => 8],
            [['tel'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'tel' => '电话',
            'city' => '城市',
            'createtime' => '时间',
            'state' => '状态',
        ];
    }
}
