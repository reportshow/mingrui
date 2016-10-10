<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use backend\models\RestClient;
use yii\db\Expression;
/**
 * This is the model class for table "mingrui_order".
 *
 * @property string $id
 * @property string $doctor
 * @property string $createtime
 * @property string $status
 * @property string $assigned
 * @property string $notes
 */
class MingruiOrder extends \yii\db\ActiveRecord
{
    public static $statutText = ['init'=>'发起','assigned'=>'已安排','going'=>'收件中','done'=>'完成'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_order';
    }
    public function behaviors()
    {
        return [
            [
                'class'              => TimestampBehavior::className(),
                'createdAtAttribute' => 'createtime',
                'updatedAtAttribute' => false,
                'value'=>new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doctor', 'assigned'], 'required'],
            [['id', 'doctor'], 'integer'],
            [['createtime'], 'safe'],
            [['status', 'notes'], 'string'],
            [['assigned'], 'string', 'max' => 16],
        ];
    }

    public function getMydoctor(){

        $d= $this->hasOne(RestClient::className(), [ 'id' =>'doctor'   ]);
        //var_export($d->toArray());exit;
       return $d;
    }
    public function getStatustxt(){
        
        $txt =  self::$statutText[$this->status];
        if($this->status=='init'){
            return $txt . "<i class='redpoint' > </i>";
        }
        return $txt;

    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor' => '医生id',
            'createtime' => '创建时间',
            'status' => '状态',
            'statustxt' => '状态',
            'assigned' => '处理人',
            'notes' => '备注',
        ];
    }
}
