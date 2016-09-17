<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "genetypes".
 *
 * @property integer $id
 * @property string $startCoord
 * @property string $endCoord
 * @property string $gene
 * @property string $tag
 * @property string $descr
 * @property string $hgvs
 * @property string $vartype
 */
class Genetypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genetypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['startCoord', 'endCoord', 'vartype'], 'string', 'max' => 10],
            [['gene'], 'string', 'max' => 20],
            [['tag'], 'string', 'max' => 30],
            [['descr', 'hgvs'], 'string', 'max' => 127],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'startCoord' => 'Start Coord',
            'endCoord' => 'End Coord',
            'gene' => 'Gene',
            'tag' => 'Tag',
            'descr' => 'Descr',
            'hgvs' => 'Hgvs',
            'vartype' => 'Vartype',
        ];
    }
}
