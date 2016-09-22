<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "geneareas".
 *
 * @property integer $id
 * @property integer $startcoord
 * @property integer $endcoord
 * @property string $gene
 * @property integer $report_count
 */
class Geneareas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'geneareas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startcoord', 'endcoord', 'report_count'], 'integer'],
            [['gene'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'startcoord' => 'Startcoord',
            'endcoord' => 'Endcoord',
            'gene' => 'Gene',
            'report_count' => 'Report Count',
        ];
    }
}
