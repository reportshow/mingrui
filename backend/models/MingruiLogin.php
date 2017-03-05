<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_login".
 *
 * @property string $id
 * @property string $uid
 * @property string $logintime
 */
class MingruiLogin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_login';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'logintime', 'thistime'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'logintime' => 'Logintime',
            'thistime'=>'',
        ];
    }
    public static function lastlogin(){ 

    	$lastlogin = MingruiLogin::find()
    	 ->where(['uid'=>Yii::$app->user->Id])    	  
    	 ->one(); 
    	if(!$lastlogin){ return time();}
    	//var_dump($lastlogin);  exit;
        return $lastlogin->logintime;
    }

    public function saveTime(){ 
    	 if($this->thistime){ 
			$this->logintime = $this->thistime;
    	 };

    	$this->thistime = time();;
    	$this->save();
    	
    }
}
