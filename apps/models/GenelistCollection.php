<?php

namespace apps\models;

use Yii;
use apps\models\Information;

/**
 * This is the model class for table "genelist_collection".
 *
 * @property string $id
 * @property string $geneinfo_id
 * @property string $zhenduan
 * @property string $zhiliao
 * @property integer $creator_info
 * @property string $used
 * @property string $createtime
 */
class GenelistCollection extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genelist_collection';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['omim',  'createtime'], 'integer'],
            [['zhenduan', 'creator_info','zhiliao'], 'string'],
            [['used'], 'string', 'max' => 1],
        ];
    }

    public function getInfo(){ 
    	//return Information::find()->where (['omim'=>$this->omim] )->one();
    	return $this->hasOne(Information::className(), ['omim' => 'omim']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'omim' => 'omim',
            'zhenduan' => '诊断',
            'zhiliao' => '治疗',
            'creator_info' => '创建者资料',
            'used' => '启用',
            'createtime' => '提交时间',
        ];
    }
}
