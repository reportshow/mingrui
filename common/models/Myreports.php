<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "myreports".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $report_ids
 */
class Myreports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'myreports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'integer'],
            ['report_ids','required'],
            [['report_ids'], 'string', 'max' => 255],
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
            'report_ids' => '收藏的公告id列表',
        ];
    }

    /**
     * @param $code
     */
    public static function isStore($code) {
        static $reports;
        if($reports === null) {
            $reports = self::find()->where('uid=:uid',[':uid' => Yii::$app->user->id])->one();
            $treports = explode('_',trim($reports->report_ids));
            return in_array($code,$treports);
        }
        return false;
    }
}
