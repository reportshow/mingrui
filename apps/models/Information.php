<?php

namespace apps\models;

use Yii;
use apps\models\Chpo;

/**
 * This is the model class for table "information".
 *
 * @property string $id
 * @property string $class
 * @property string $classid
 * @property string $sick
 * @property string $sick_en
 * @property string $gene
 * @property string $method
 * @property string $omim
 * @property string $background
 * @property string $wide
 * @property string $DM
 * @property string $mutation
 * @property string $grosins
 * @property string $grosdel
 * @property string $complex
 * @property string $prom
 * @property string $deletion
 * @property string $insertion
 * @property string $indel
 * @property string $splice
 * @property string $amplet
 * @property string $OTHERS
 * @property string $refseq
 */
class Information extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genelist_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class', 'genecount', 'sick', 'sick_en', 'gene', 'method', 'omim', 'background', 'wide', 'DM', 'mutation', 'grosins', 'grosdel', 'complex', 'prom', 'deletion', 'insertion', 'indel', 'splice', 'amplet', 'OTHERS', 'refseq'], 'string', 'max' => 255],
        ];
    }

    public function getOmiminfo(){ 

    	return Chpo::find()->where (['diseaseID'=>'OMIM:'.$this->omim] )->one();
    	 
    }

    public function getOtherinfo(){ 

    	return Chpo::find()->where (['gene'=>$this->gene] )->all();
    	 
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'class' => '疾病大类',
            'genecount' => '基因数',
            'sick' => '疾病名称',
            'sick_en' => '疾病英文',
            'gene' => '基因',
            'method' => '遗传方式',
            'omim' => 'Omim',
            'background' => '背景',
            'wide' => '外显子数',
            'DM' => 'Dm',
            'mutation' => 'Mutation',
            'grosins' => 'Grosins',
            'grosdel' => 'Grosdel',
            'complex' => 'Complex',
            'prom' => 'Prom',
            'deletion' => 'Deletion',
            'insertion' => 'Insertion',
            'indel' => 'Indel',
            'splice' => 'Splice',
            'amplet' => 'Amplet',
            'OTHERS' => 'Others',
            'refseq' => 'Refseq',
        ];
    }
}
