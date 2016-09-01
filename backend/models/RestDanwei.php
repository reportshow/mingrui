<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rest_danwei".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sales_id
 *
 * @property RestClient[] $restClients
 * @property RestSales $sales
 */
class RestDanwei extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_danwei';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sales_id'], 'integer'],
            [['name'], 'string', 'max' => 1000],
             
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
            'sales_id' => '销售id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestClients()
    {
        return $this->hasMany(RestClient::className(), ['hospital_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(RestSales::className(), ['id' => 'sales_id']);
    }
}
