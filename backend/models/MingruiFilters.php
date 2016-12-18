<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mingrui_filters".
 *
 * @property integer $id
 * @property string $description
 * @property string $title
 * @property string $report_type
 * @property integer $user_id
 * @property integer $report_id
 */
class MingruiFilters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mingrui_filters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['title', 'report_type', 'user_id', 'report_id', 'filter_json'], 'required'],
             [['user_id', 'report_id', 'report_type'], 'integer'],
             [['description'], 'string', 'max' => 1024],
             [['title'], 'string', 'max' => 128],
             [['filter_json'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'title' => 'Title',
            'report_type' => 'Report Type',
            'user_id' => 'User ID',
            'report_id' => 'Report ID',
            'filter_json' => 'Filter JSON',
        ];
    }
}
