<?php

namespace apps\models;

use Yii;

/**
 * This is the model class for table "chpo".
 *
 * @property string $id
 * @property string $chpo
 * @property string $diseaseID
 * @property string $gene
 */
class Chpo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genelist_chpo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chpo'], 'string'],
            [['diseaseID', 'gene'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'chpo' => '描述',
            'diseaseID' => 'omim',
            'gene' => '基因',
        ];
    }
}
