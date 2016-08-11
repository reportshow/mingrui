<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rest_report".
 *
 * @property integer $id
 * @property string $report_id
 * @property string $created
 * @property string $updated
 * @property string $status
 * @property string $note
 * @property integer $assigner_id
 * @property integer $product_id
 * @property integer $complete
 * @property string $cnvsqlite
 * @property string $snpsqlite
 * @property string $cnvsave
 * @property string $snpsave
 * @property string $finish
 * @property string $xiafa
 * @property integer $analysis_id
 * @property integer $yidai_complete
 * @property string $url
 * @property string $yidai_note
 * @property string $express
 * @property string $express_no
 * @property string $sample_id
 * @property string $pdf
 * @property string $conclusion
 * @property string $explain
 * @property integer $jxyanzhen
 * @property string $mut_type
 * @property integer $star
 * @property string $template
 * @property string $type
 * @property string $gene_template
 * @property string $ptype
 * @property string $csupload
 * @property string $family_id
 * @property string $date
 * @property string $abiresult
 * @property string $snpexplain
 * @property integer $abiexported
 * @property string $final_note
 * @property string $assigner_note
 * @property string $shenhe_date
 * @property integer $locked
 * @property integer $express_sent
 * @property integer $sale_marked
 * @property string $time_stamp
 * @property string $yidaifinished_date
 * @property string $kyupload
 * @property integer $yidai_marked
 *
 * @property RestProject[] $restProjects
 * @property RestEmployee $assigner
 * @property RestProduct $product
 * @property RestSample $sample
 * @property RestYidai[] $restYidais
 * @property RestYidaics[] $restYidaics
 */
class RestReport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rest_report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'updated', 'status', 'complete', 'jxyanzhen', 'abiexported', 'locked', 'express_sent', 'sale_marked', 'yidai_marked'], 'required'],
            [['created', 'updated', 'finish', 'xiafa', 'date', 'shenhe_date', 'yidaifinished_date'], 'safe'],
            [['note', 'cnvsave', 'snpsave', 'yidai_note', 'explain', 'abiresult', 'snpexplain', 'final_note', 'assigner_note', 'time_stamp'], 'string'],
            [['assigner_id', 'product_id', 'complete', 'analysis_id', 'yidai_complete', 'jxyanzhen', 'star', 'abiexported', 'locked', 'express_sent', 'sale_marked', 'yidai_marked'], 'integer'],
            [['report_id', 'status', 'sample_id', 'ptype'], 'string', 'max' => 20],
            [['cnvsqlite', 'snpsqlite', 'express', 'express_no', 'pdf', 'conclusion', 'mut_type', 'template', 'type', 'gene_template'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 1000],
            [['csupload', 'kyupload'], 'string', 'max' => 100],
            [['family_id'], 'string', 'max' => 50],
            [['report_id'], 'unique'],

/*            [['assigner_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestEmployee::className(), 'targetAttribute' => ['assigner_id' => 'id']],
[['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
[['sample_id'], 'exist', 'skipOnError' => true, 'targetClass' => RestSample::className(), 'targetAttribute' => ['sample_id' => 'sample_id']],*/

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                 => 'ID',
            'report_id'          => 'Report ID',
            'created'            => 'Created',
            'updated'            => 'Updated',
            'status'             => 'Status',
            'note'               => 'Note',
            'assigner_id'        => 'Assigner ID',
            'product_id'         => 'Product ID',
            'complete'           => 'Complete',
            'cnvsqlite'          => 'Cnvsqlite',
            'snpsqlite'          => 'Snpsqlite',
            'cnvsave'            => 'Cnvsave',
            'snpsave'            => 'Snpsave',
            'finish'             => 'Finish',
            'xiafa'              => 'Xiafa',
            'analysis_id'        => 'Analysis ID',
            'yidai_complete'     => 'Yidai Complete',
            'url'                => 'Url',
            'yidai_note'         => 'Yidai Note',
            'express'            => 'Express',
            'express_no'         => 'Express No',
            'sample_id'          => 'Sample ID',
            'pdf'                => 'Pdf',
            'conclusion'         => '结论',
            'explain'            => 'Explain',
            'jxyanzhen'          => 'Jxyanzhen',
            'mut_type'           => 'Mut Type',
            'star'               => 'Star',
            'template'           => 'Template',
            'type'               => 'Type',
            'gene_template'      => '检查类型',
            'ptype'              => 'Ptype',
            'csupload'           => 'Csupload',
            'family_id'          => 'Family ID',
            'date'               => 'Date',
            'abiresult'          => 'Abiresult',
            'snpexplain'         => 'Snpexplain',
            'abiexported'        => 'Abiexported',
            'final_note'         => 'Final Note',
            'assigner_note'      => 'Assigner Note',
            'shenhe_date'        => 'Shenhe Date',
            'locked'             => 'Locked',
            'express_sent'       => 'Express Sent',
            'sale_marked'        => 'Sale Marked',
            'time_stamp'         => 'Time Stamp',
            'yidaifinished_date' => 'Yidaifinished Date',
            'kyupload'           => 'Kyupload',
            'yidai_marked'       => 'Yidai Marked',
        ];
    }
    public function getX()
    {
        return 'xx';
    }
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getRestProjects()
    // {
    //     return $this->hasMany(RestProject::className(), ['report_id' => 'id']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getAssigner()
    // {
    //     return $this->hasOne(RestEmployee::className(), ['id' => 'assigner_id']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getProduct()
    // {
    //     return $this->hasOne(RestProduct::className(), ['id' => 'product_id']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    public function getSample()
    {
        return $this->hasOne(RestSample::className(), ['sample_id' => 'sample_id']);
    } 
    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getRestYidais()
    // {
    //     return $this->hasMany(RestYidai::className(), ['report_id' => 'id']);
    // }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getRestYidaics()
    // {
    //     return $this->hasMany(RestYidaics::className(), ['report_id' => 'id']);
    // }
}
