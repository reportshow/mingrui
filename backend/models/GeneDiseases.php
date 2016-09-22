<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gene_diseases".
 *
 * @property integer $id
 * @property string $gene
 * @property string $diseases
 */
class GeneDiseases extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gene_diseases';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gene'], 'string', 'max' => 20],
            [['diseases'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gene' => 'Gene',
            'diseases' => 'Diseases',
        ];
    }
}
