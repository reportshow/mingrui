<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rest_sample".
 *
 * @property string $sample_id
 * @property string $name
 * @property string $type
 * @property string $ypkd_id
 * @property string $barcode
 * @property string $sex
 * @property string $birthday
 * @property string $age
 * @property string $tel1
 * @property string $tel2
 * @property string $email
 * @property string $address
 * @property string $symptom
 * @property string $date
 * @property integer $has_project
 * @property string $report_type
 * @property string $guanlian
 * @property string $pdf
 * @property integer $has_symptom
 * @property string $relation
 * @property string $related_sid
 * @property integer $xianzhengzhe
 * @property string $yangbenruku
 * @property string $heshuanruku
 * @property string $heshuanruku2
 * @property string $yangbenweizi
 * @property string $heshuanweizi
 * @property string $heshuanweizi2
 * @property string $note
 * @property integer $doctor_id
 * @property string $family_id
 * @property integer $sales_id
 * @property string $shenhe_status
 * @property string $clinic_no
 * @property string $nationality
 * @property string $patient_no
 * @property string $clinic_symptom
 * @property string $report_template
 * @property string $created
 * @property integer $xiedai
 * @property string $updated
 * @property string $timestamp
 * @property string $dengji_note
 * @property string $express
 * @property string $express_no
 * @property string $shouyang_date
 * @property integer $shouyanged
 *
 * @property RestBill $restBill
 * @property RestCouti $restCouti
 * @property RestProject[] $restProjects
 * @property RestReport[] $restReports
 * @property RestClient $doctor
 * @property RestFamily $family
 * @property RestSales $sales
 */
class RestSample extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_sample';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sample_id', 'name', 'type', 'sex', 'has_project', 'has_symptom', 'xianzhengzhe', 'shenhe_status', 'created', 'xiedai', 'updated', 'timestamp', 'shouyanged'], 'required'],
            [['symptom', 'note', 'clinic_symptom', 'timestamp', 'dengji_note'], 'string'],
            [['date', 'created', 'updated', 'shouyang_date'], 'safe'],
            [['has_project', 'has_symptom', 'xianzhengzhe', 'doctor_id', 'sales_id', 'xiedai', 'shouyanged'], 'integer'],
            [['sample_id', 'sex', 'related_sid', 'yangbenruku', 'heshuanruku', 'heshuanruku2', 'family_id', 'shenhe_status'], 'string', 'max' => 20],
            [['name', 'type', 'ypkd_id', 'barcode', 'birthday', 'age', 'tel1', 'tel2', 'report_type', 'guanlian', 'relation', 'report_template', 'express', 'express_no'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 254],
            [['address'], 'string', 'max' => 3000],
            [['pdf'], 'string', 'max' => 1000],
            [['yangbenweizi', 'heshuanweizi', 'heshuanweizi2'], 'string', 'max' => 50],
            [['clinic_no', 'nationality', 'patient_no'], 'string', 'max' => 300],
            [['heshuanweizi'], 'unique'],
            [['heshuanweizi2'], 'unique'],
            [['yangbenweizi'], 'unique'],

            /* [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestClient::className(), 'targetAttribute' => ['doctor_id' => 'id']],
        [['family_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestFamily::className(), 'targetAttribute' => ['family_id' => 'family_id']],
        [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestSales::className(), 'targetAttribute' => ['sales_id' => 'id']],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sample_id'       => '样本ID',
            'name'            => '姓名',
            'type'            => '样本类型',
            'ypkd_id'         => 'Ypkd ID',
            'barcode'         => 'Barcode',
            'sex'             => '性别',
            'birthday'        => '出生日期',
            'age'             => '检测年龄',
            'tel1'            => '联系方式',
            'tel2'            => '联系人',
            'email'           => 'Email',
            'address'         => '地址',
            'symptom'         => '主诉',
            'date'            => '送检日期',
            'has_project'     => 'Has Project',
            'report_type'     => 'Report Type',
            'guanlian'        => 'Guanlian',
            'pdf'             => 'Pdf',
            'has_symptom'     => 'Has Symptom',
            'relation'        => 'Relation',
            'related_sid'     => 'Related Sid',
            'xianzhengzhe'    => 'Xianzhengzhe',
            'yangbenruku'     => 'Yangbenruku',
            'heshuanruku'     => 'Heshuanruku',
            'heshuanruku2'    => 'Heshuanruku2',
            'yangbenweizi'    => 'Yangbenweizi',
            'heshuanweizi'    => 'Heshuanweizi',
            'heshuanweizi2'   => 'Heshuanweizi2',
            'note'            => 'Note',
            'doctor_id'       => 'Doctor ID',
            'family_id'       => 'Family ID',
            'sales_id'        => 'Sales ID',
            'shenhe_status'   => 'Shenhe Status',
            'clinic_no'       => 'Clinic No',
            'nationality'     => 'Nationality',
            'patient_no'      => 'Patient No',
            'clinic_symptom'  => '临床初诊',
            'report_template' => 'Report Template',
            'created'         => 'Created',
            'xiedai'          => 'Xiedai',
            'updated'         => 'Updated',
            'timestamp'       => 'Timestamp',
            'dengji_note'     => 'Dengji Note',
            'express'         => 'Express',
            'express_no'      => 'Express No',
            'shouyang_date'   => 'Shouyang Date',
            'shouyanged'      => 'Shouyanged',
        ];
    }

     
    public $name ='赵钱孙李';
     
    public function getRealname(){
      return  $this->__get('name');
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestBill()
    {
        return $this->hasOne(RestBill::className(), ['sample_id' => 'sample_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestCouti()
    {
        return $this->hasOne(RestCouti::className(), ['sample_id' => 'sample_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestProjects()
    {
        return $this->hasMany(RestProject::className(), ['sample_id' => 'sample_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestReports()
    {
        return $this->hasMany(RestReport::className(), ['sample_id' => 'sample_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(RestClient::className(), ['id' => 'doctor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamily()
    {
        return $this->hasOne(RestFamily::className(), ['family_id' => 'family_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(RestSales::className(), ['id' => 'sales_id']);
    }
}
