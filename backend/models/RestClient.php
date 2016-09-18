<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rest_client".
 *
 * @property integer $id
 * @property string $name
 * @property string $sex
 * @property integer $age
 * @property string $birthplace
 * @property string $email
 * @property string $tel
 * @property string $school
 * @property string $education
 * @property string $experience
 * @property string $employed
 * @property string $department
 * @property string $worktime
 * @property string $position
 * @property string $speciality
 * @property string $hobby
 * @property string $notes
 * @property string $zhuren
 * @property integer $hospital_id
 * @property string $pianhao
 *
 * @property RestDanwei $hospital
 * @property RestSample[] $restSamples
 */
class RestClient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'experience'], 'required'],
            [['age', 'hospital_id'], 'integer'],
            [['experience', 'notes', 'pianhao'], 'string'],
            [['name', 'sex', 'birthplace', 'tel', 'school', 'education', 'employed', 'department', 'position', 'speciality', 'hobby', 'zhuren'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 254],
            [['worktime'], 'string', 'max' => 1000],
            
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
            'sex' => '性别',
            'age' => '年龄',
            'birthplace' => 'Birthplace',
            'email' => '邮箱',
            'tel' => '电话',
            'school' => 'School',
            'education' => 'Education',
            'experience' => 'Experience',
            'employed' => 'Employed',
            'department' => '部门',
            'worktime' => 'Worktime',
            'position' => 'Position',
            'speciality' => 'Speciality',
            'hobby' => 'Hobby',
            'notes' => 'Notes',
            'zhuren' => 'Zhuren',
            'hospital_id' => 'Hospital ID',
            'pianhao' => 'Pianhao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHospital()
    {
        return $this->hasOne(RestDanwei::className(), ['id' => 'hospital_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestSamples()
    {
        return $this->hasMany(RestSample::className(), ['doctor_id' => 'id']);
    }

    public function commentCount(){
        $gb_id = 'gb'.$this->id;
       return MingruiComments::find()->where(['report_id'=>$gb_id])->count();
    }
    public function comments(){

    }
}
