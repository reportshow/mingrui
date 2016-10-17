<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;
use yii\web\UploadedFile;

/**
 * This is the model class for table "mingrui_vcf".
 *
 * @property string $id
 * @property string $uid
 * @property string $sick
 * @property integer $age
 * @property string $sex
 * @property string $vcf
 * @property string $status
 * @property string $tel
 * @property string $product
 * @property string $diagnose
 * @property string $gene
 * @property string $createtime
 * @property string $task_id
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
            [['uid', 'sick', 'product', 'diagnose', 'sex'], 'required'],
            [['uid', 'createtime', 'task_id'], 'integer'],
            [['sex', 'diagnose'], 'string'],
            [['age'], 'number'],
            [['sick'], 'string', 'max' => 16],
            [['vcf'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 8],
            [['sick'], 'string', 'max' => 16],
            [['tel', 'gene'], 'string', 'max' => 32],
            [['product'], 'string', 'max' => 128],
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
            'uid' => '医生id',
            'sick' => '患者姓名',
            'age' => '年龄',
            'sex' => '性别',
            'vcf'   => 'VCF文件',
            'status'=>'状态',
            'tel' => '联系电话',
            'product' => '检测项目',
            'diagnose' => '临床诊断',
            'gene' => '异常基因',
            'createtime' => '上传时间',
            'task_id' => 'Task ID',
        ];
    }

    public function getTaskStatus()
    {
         if($this->task_id >= 0) {
              $vcf_url = Yii::$app->params['vcfservice'] . '/api/task/status/' . $this->task_id;
              return @file_get_contents($vcf_url);
         }
    }
    
}
