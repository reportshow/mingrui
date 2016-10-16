<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "omims".
 *
 * @property integer $id
 * @property integer $omim_id
 * @property string $gene
 * @property string $synopsis
 */
class Omims extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'omims';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['omim_id'], 'integer'],
            [['gene'], 'string', 'max' => 20],
            [['synopsis'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'omim_id' => 'Omim ID',
            'gene' => 'Gene',
            'synopsis' => 'Synopsis',
        ];
    }
}
