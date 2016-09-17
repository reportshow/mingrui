<?php

namespace backend\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "mingrui_doc".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $doc
 * @property string $createtime
 */
class MingruiDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_doc';
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
            [['title','uid' ], 'required'],
            [['description'], 'string'],
            [['createtime'], 'integer'],
            [['title', 'doc'], 'string', 'max' => 1024],
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
            'id' => 'ID',
            'title' => '标题',
            'description' => '内容',
            'doc' => '文档',
            'createtime' => 'Createtime',
        ];
    }
}
