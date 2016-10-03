<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "omims".
 *
 * @property integer $id
 * @property integer $omim_id
 * @property string $disease_id
 * @property string $gene
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
            [['disease_id'], 'string', 'max' => 255],
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
            'omim_id' => 'Omim ID',
            'disease_id' => 'Disease ID',
            'gene' => 'Gene',
        ];
    }
}
