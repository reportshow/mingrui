<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "genetypes".
 *
 * @property integer $id
 * @property integer $startcoord
 * @property integer $endcoord
 * @property string $gene
 * @property string $tag
 * @property string $descr
 * @property string $hgvs
 * @property string $disease
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
            [['startcoord', 'endcoord'], 'integer'],
            [['gene', 'tag'], 'string', 'max' => 36],
            [['descr', 'hgvs', 'disease'], 'string', 'max' => 255],
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
            'tag' => 'Tag',
            'descr' => 'Descr',
            'hgvs' => 'Hgvs',
            'disease' => 'Disease',
        ];
    }
}
