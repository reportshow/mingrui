<?php

namespace backend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "mingrui_score".
 *
 * @property string $id
 * @property string $uid
 * @property string $score
 */
class MingruiScore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_score';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'score'], 'integer'],
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
            'cid' => 'Cid',
            'score' => '积分',
        ];
    }

    public  static function add($type){ 
    	$count = Yii::$app->params['score'][$type];
    	//$uid = Yii::$app->user->Id;
    	$cid = Yii::$app->user->Identify->role_tab_id;

    	$model =MingruiScore::find()->where(['cid'=>$cid])->one();
    	if(!$model){ 
    		$model = new MingruiScore();
    		$model->uid = $cid; 
    	}
    	$model->score +=$count;
    	$model->save();
    	Yii::$app->params['message.score'] = $count; 

    }
}
