<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rest_product".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property integer $pduration
 * @property integer $fduration
 * @property string $notes
 * @property string $template
 * @property string $panel
 * @property integer $assigner_id
 * @property integer $chip_id
 * @property integer $shenher_id
 * @property integer $gene_size
 * @property double $jiage
 * @property string $genes
 * @property integer $fnshenher_id
 * @property integer $ydshenher_id
 * @property string $status
 *
 * @property RestEmployee $assigner
 * @property RestXinpian $chip
 * @property RestEmployee $fnshenher
 * @property RestEmployee $shenher
 * @property RestEmployee $ydshenher
 * @property RestProject[] $restProjects
 * @property RestReport[] $restReports
 */
class RestProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'pduration', 'fduration', 'jiage'], 'required'],
            [['pduration', 'fduration', 'assigner_id', 'chip_id', 'shenher_id', 'gene_size', 'fnshenher_id', 'ydshenher_id'], 'integer'],
            [['notes', 'genes'], 'string'],
            [['jiage'], 'number'],
            [['name', 'type', 'template', 'panel'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['assigner_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestEmployee::className(), 'targetAttribute' => ['assigner_id' => 'id']],
            [['chip_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestXinpian::className(), 'targetAttribute' => ['chip_id' => 'id']],
            [['fnshenher_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestEmployee::className(), 'targetAttribute' => ['fnshenher_id' => 'id']],
            [['shenher_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestEmployee::className(), 'targetAttribute' => ['shenher_id' => 'id']],
            [['ydshenher_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestEmployee::className(), 'targetAttribute' => ['ydshenher_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'pduration' => 'Pduration',
            'fduration' => 'Fduration',
            'notes' => 'Notes',
            'template' => 'Template',
            'panel' => 'Panel',
            'assigner_id' => 'Assigner ID',
            'chip_id' => 'Chip ID',
            'shenher_id' => 'Shenher ID',
            'gene_size' => 'Gene Size',
            'jiage' => 'Jiage',
            'genes' => 'Genes',
            'fnshenher_id' => 'Fnshenher ID',
            'ydshenher_id' => 'Ydshenher ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigner()
    {
        return $this->hasOne(RestEmployee::className(), ['id' => 'assigner_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChip()
    {
        return $this->hasOne(RestXinpian::className(), ['id' => 'chip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFnshenher()
    {
        return $this->hasOne(RestEmployee::className(), ['id' => 'fnshenher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShenher()
    {
        return $this->hasOne(RestEmployee::className(), ['id' => 'shenher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYdshenher()
    {
        return $this->hasOne(RestEmployee::className(), ['id' => 'ydshenher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestProjects()
    {
        return $this->hasMany(RestProject::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestReports()
    {
        return $this->hasMany(RestReport::className(), ['product_id' => 'id']);
    }
}
