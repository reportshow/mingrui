<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rest_sales".
 *
 * @property integer $id
 * @property string $name
 * @property string $sex
 * @property integer $age
 * @property string $birthplace
 * @property string $work_email
 * @property string $private_email
 * @property string $work_tel
 * @property string $private_tel
 * @property string $emergency_contact
 * @property string $idcard
 * @property string $school
 * @property string $education
 * @property string $experience
 * @property string $employed
 * @property string $area
 * @property string $openid
 * @property string $wechatid
 *
 * @property RestDanwei[] $restDanweis
 * @property RestEmployee $restEmployee
 * @property RestSample[] $restSamples
 */
class RestSales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'age', 'experience'], 'required'],
            [['age'], 'integer'],
            [['experience'], 'string'],
            [['employed'], 'safe'],
            [['name', 'sex', 'birthplace', 'work_tel', 'private_tel', 'emergency_contact', 'idcard', 'school', 'education', 'area', 'wechatid'], 'string', 'max' => 100],
            [['work_email', 'private_email'], 'string', 'max' => 254],
            [['openid'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sex' => 'Sex',
            'age' => 'Age',
            'birthplace' => 'Birthplace',
            'work_email' => 'Work Email',
            'private_email' => 'Private Email',
            'work_tel' => 'Work Tel',
            'private_tel' => 'Private Tel',
            'emergency_contact' => 'Emergency Contact',
            'idcard' => 'Idcard',
            'school' => 'School',
            'education' => 'Education',
            'experience' => 'Experience',
            'employed' => 'Employed',
            'area' => 'Area',
            'openid' => 'Openid',
            'wechatid' => 'Wechatid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestDanweis()
    {
        return $this->hasMany(RestDanwei::className(), ['sales_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestEmployee()
    {
        return $this->hasOne(RestEmployee::className(), ['sale_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestSamples()
    {
        return $this->hasMany(RestSample::className(), ['sales_id' => 'id']);
    }
}
