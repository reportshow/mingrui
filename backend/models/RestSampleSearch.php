<?php

namespace backend\models;

use backend\models\RestSample;
use common\models\SqlModelsProvider;
use yii\base\Model;
//use yii\data\SqlDataProvider;
use yii\data\ActiveDataProvider;

/**
 * RestSampleSearch represents the model behind the search form about `backend\models\RestSample`.
 */
class RestSampleSearch extends RestSample
{

    public $pingjia;
    public $gene;
    public $linchuang;

    public $product_name;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sample_id', 'name', 'type', 'ypkd_id', 'barcode', 'sex', 'birthday', 'age', 'tel1', 'tel2', 'email', 'address', 'symptom', 'date', 'report_type', 'guanlian', 'pdf', 'relation', 'related_sid', 'yangbenruku', 'heshuanruku', 'heshuanruku2', 'yangbenweizi', 'heshuanweizi', 'heshuanweizi2', 'note', 'family_id', 'shenhe_status', 'clinic_no', 'nationality', 'patient_no', 'clinic_symptom', 'report_template', 'created', 'updated', 'timestamp', 'dengji_note', 'express', 'express_no', 'shouyang_date',
                'gene', 'pingjia', 'linchuang', //再增加几个
                'product_name', //再增加几个
                'report_id',
            ], 'safe'],
            [['has_project', 'has_symptom', 'xianzhengzhe', 'doctor_id', 'sales_id', 'xiedai', 'shouyanged'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $query = '')
    {
        if (!$query) {
            $query = RestSample::find();
        }

        $query = $query->joinWith(['pingjia']);
        $query = $query->joinWith('restReports');
        $query = $query->joinWith(['restReports.product']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'date'                      => $this->date,
            'has_project'               => $this->has_project,
            'has_symptom'               => $this->has_symptom,
            'xianzhengzhe'              => $this->xianzhengzhe,
            'doctor_id'                 => $this->doctor_id,
            'sales_id'                  => $this->sales_id,
            'Date(rest_sample.created)' => $this->created,
            'xiedai'                    => $this->xiedai,
            'updated'                   => $this->updated,
            'shouyang_date'             => $this->shouyang_date,
            'shouyanged'                => $this->shouyanged,
            'sex'                       => $this->sex,
        ]);

        $query->andFilterWhere(['like', 'sample_id', $this->sample_id])
            ->andFilterWhere(['like', 'rest_sample.name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'ypkd_id', $this->ypkd_id])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
        //->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'birthday', $this->birthday])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'tel1', $this->tel1])
            ->andFilterWhere(['like', 'tel2', $this->tel2])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'symptom', $this->symptom])
            ->andFilterWhere(['like', 'report_type', $this->report_type])
            ->andFilterWhere(['like', 'guanlian', $this->guanlian])
            ->andFilterWhere(['like', 'pdf', $this->pdf])
            ->andFilterWhere(['like', 'relation', $this->relation])
            ->andFilterWhere(['like', 'related_sid', $this->related_sid])
            ->andFilterWhere(['like', 'yangbenruku', $this->yangbenruku])
            ->andFilterWhere(['like', 'heshuanruku', $this->heshuanruku])
            ->andFilterWhere(['like', 'heshuanruku2', $this->heshuanruku2])
            ->andFilterWhere(['like', 'yangbenweizi', $this->yangbenweizi])
            ->andFilterWhere(['like', 'heshuanweizi', $this->heshuanweizi])
            ->andFilterWhere(['like', 'heshuanweizi2', $this->heshuanweizi2])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'family_id', $this->family_id])
            ->andFilterWhere(['like', 'shenhe_status', $this->shenhe_status])
            ->andFilterWhere(['like', 'clinic_no', $this->clinic_no])
            ->andFilterWhere(['like', 'nationality', $this->nationality])
            ->andFilterWhere(['like', 'patient_no', $this->patient_no])
            ->andFilterWhere(['like', 'clinic_symptom', $this->clinic_symptom])
            ->andFilterWhere(['like', 'report_template', $this->report_template])
            ->andFilterWhere(['like', 'timestamp', $this->timestamp])
            ->andFilterWhere(['like', 'dengji_note', $this->dengji_note])
            ->andFilterWhere(['like', 'express', $this->express])
            ->andFilterWhere(['like', 'express_no', $this->express_no]);

        $query
            ->andFilterWhere(['like', 'rest_report.report_id', $this->report_id]) //<=====加入这句
            ->andFilterWhere(['like', 'rest_product.name', $this->product_name]) //<=====加入这句
            ->andFilterWhere(['like', 'mingrui_pingjia.pingjia', $this->pingjia]) //<=====加入这句
            ->andFilterWhere(['like', 'mingrui_pingjia.linchuang', $this->linchuang]); //<=====加入这句
        if ($this->gene) {
            $like = '": ["%' . $this->gene . '%",';
            $query->andFilterWhere(['like', 'snpsave', "%{$like}%", false]);
        }

        //
        //
        $query->select('rest_report.report_id, rest_sample.*');        
        $query->indexBy('indexby');
        //echo $query->createCommand()->getRawSql(); exit;
        return $dataProvider;


        $dataProvider = new SqlModelsProvider([
            'query' => $query,
            'class' => get_class($this),
        ]);
        return $dataProvider;
    }

}
