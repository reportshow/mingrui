<?php

namespace apps\models;

use Yii;

/**
 * This is the model class for table "genelist_symptom".
 *
 * @property string $id
 * @property string $number
 * @property string $symptom
 */
class GenelistSymptom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genelist_symptom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['symptom'], 'string'],
            [['number'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'symptom' => 'Symptom',
        ];
    }
}
