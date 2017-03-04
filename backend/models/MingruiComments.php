<?php

namespace backend\models;

use common\models\User;
use backend\models\RestClient;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "mingrui_comments".
 *
 * @property string $id
 * @property string $uid
 * @property string $to_uid
 * @property string $report_id
 * @property string $content
 * @property string $createtime
 */
class MingruiComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'report_id', 'content'], 'required'],
            [['uid', 'to_uid'], 'integer'],
            [['createtime', 'report_id'], 'safe'],
            [['content'], 'safe'],
        ];
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
    public static function getOnegroup($id)
    {
        $comments = MingruiComments::find()
            ->where(['report_id' => $id])
            ->joinWith(['creator'])
            ->all();
        return $comments;
    }
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }

    public function getDoctor()
    {
        $doctor_id = str_replace('gb','',$this->report_id) ;
        if($doctor_id){ 
			return RestClient::findOne($doctor_id);
        }
        
    }
    public function getUnread(){ 
    	return $this->find()
    	->where(['isread'=>0])->count();
    }


    public function getTouser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_uid']);
    }
    public function getPosition()
    {
        // var_export(  Yii::$app->authManager->checkAccess($this->creator->id,'admin'));
        //  var_export(  Yii::$app->authManager->getRoles(  $this->creator->id) );

        // exit ("/////");
        $isadmin = Yii::$app->authManager->checkAccess($this->creator->id, 'admin');

        if ($isadmin) {
            return 'right';
        } else {
            return 'left';
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'uid'        => 'Uid',
            'to_uid'     => 'To Uid',
            'report_id'  => 'Report id',
            'content'    => 'Content',
            'createtime' => 'Createtime',
        ];
    }
}
