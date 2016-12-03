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
            [['uid', 'score'], 'integer'],
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
            'uid' => 'Uid',
            'score' => '积分',
        ];
    }

    public  static function add($type){ 
    	$count = Yii::$app->params['score'][$type];
    	
    	$model =MingruiScore::find()->where(['uid'=>Yii::$app->user->Id])->one();
    	if(!$model){ 
    		$model = new MingruiScore();
    		$model->uid = Yii::$app->user->Id; 
    	}
    	$model->score +=$count;
    	$model->save();
    	Yii::$app->params['message.score'] = $count; 

    }
}
