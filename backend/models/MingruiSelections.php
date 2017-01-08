<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_selections".
 *
 * @property integer $id
 * @property integer $report_type
 * @property integer $user_id
 * @property integer $report_id
 * @property string $selection_json
 */
class MingruiSelections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_selections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_type', 'user_id', 'report_id', 'selection_json'], 'required'],
            [['report_type', 'user_id', 'report_id'], 'integer'],
            [['selection_json'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'report_type' => 'Report Type',
            'user_id' => 'User ID',
            'report_id' => 'Report ID',
            'selection_json' => 'Selection Json',
        ];
    }
}
