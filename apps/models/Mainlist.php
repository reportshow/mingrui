<?php

namespace apps\models;

use Yii;

/**
 * This is the model class for table "main".
 *
 * @property string $id
 * @property string $name
 * @property string $name_en
 * @property string $number
 * @property string $hassub
 * @property string $description
 * @property string $tabname
 */
class Mainlist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genelist_main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
            ['name', 'name_en', 'hassub', 'description'], 'string', 'max' => 255],
            [['number'], 'string', 'max' => 16],
            [['orderby'],'string'],
            [['classname'], 'string', 'max' => 32],
            [['detail','caselist'], 'string' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'name_en' => '名称英文',
            'number' => '货号',
            'hassub' => '是否有子类',
            'description' => '描述',
            'classname' => '子类型key',
            'detail' => '细节描述',
            'caselist'=>'案例id列表(用,号分开)',
            'orderby' => '排序',
        ];
    }
}
