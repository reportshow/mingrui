<?php

namespace backend\models;

use backend\models\RestReport;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RestReportSearch represents the model behind the search form about `backend\models\RestReport`.
 */
class RestReportSearch extends RestReport
{
    public $product_name;
    public $username;
    public $tel;

    public $pingjia;
    public $gene;
    public $linchuang;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'assigner_id', 'product_id', 'complete', 'analysis_id', 'yidai_complete', 'jxyanzhen', 'star', 'abiexported', 'locked', 'express_sent', 'sale_marked', 'yidai_marked'], 'integer'],
            [['username', 'product_name', 'tel', //新增的几个
            'gene','pingjia','linchuang',//再增加几个
            'report_id',  'created', 'updated', 'status', 'note', 'cnvsqlite', 'snpsqlite', 'cnvsave', 'snpsave', 'finish', 'xiafa', 'url', 'yidai_note', 'express', 'express_no', 'sample_id', 'pdf', 'conclusion', 'explain', 'mut_type', 'template', 'type', 'gene_template', 'ptype', 'csupload', 'family_id', 'date', 'abiresult', 'snpexplain', 'final_note', 'assigner_note', 'shenhe_date', 'time_stamp', 'yidaifinished_date', 'kyupload'], 'safe'],
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
    public function search($params, $query)
    {
        if (!$query) {
            $query = RestReport::find();
        }
        $query = $query->joinWith(['product']);
        $query = $query->joinWith(['sample']);
        $query = $query->joinWith(['pingjia']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'                 => $this->id,
            'created'            => $this->created,
            'updated'            => $this->updated,
            'assigner_id'        => $this->assigner_id,
            'product_id'         => $this->product_id,
            'complete'           => $this->complete,
            'finish'             => $this->finish,
            'xiafa'              => $this->xiafa,
            'analysis_id'        => $this->analysis_id,
            'yidai_complete'     => $this->yidai_complete,
            'jxyanzhen'          => $this->jxyanzhen,
            'star'               => $this->star,
            'date'               => $this->date,
            'abiexported'        => $this->abiexported,
            'shenhe_date'        => $this->shenhe_date,
            'locked'             => $this->locked,
            'express_sent'       => $this->express_sent,
            'sale_marked'        => $this->sale_marked,
            'yidaifinished_date' => $this->yidaifinished_date,
            'yidai_marked'       => $this->yidai_marked,
        ]);

        $query->andFilterWhere(['like', 'rest_report.report_id', $this->report_id])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'rest_report.note', $this->note])
            ->andFilterWhere(['like', 'cnvsqlite', $this->cnvsqlite])
            ->andFilterWhere(['like', 'snpsqlite', $this->snpsqlite])
            ->andFilterWhere(['like', 'cnvsave', $this->cnvsave])
            ->andFilterWhere(['like', 'snpsave', $this->snpsave])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'yidai_note', $this->yidai_note])
            ->andFilterWhere(['like', 'express', $this->express])
            ->andFilterWhere(['like', 'express_no', $this->express_no])
            ->andFilterWhere(['like', 'sample_id', $this->sample_id])
            ->andFilterWhere(['like', 'pdf', $this->pdf])
            ->andFilterWhere(['like', 'conclusion', $this->conclusion])
            ->andFilterWhere(['like', 'explain', $this->explain])
            ->andFilterWhere(['like', 'mut_type', $this->mut_type])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'gene_template', $this->gene_template])
            ->andFilterWhere(['like', 'ptype', $this->ptype])
            ->andFilterWhere(['like', 'csupload', $this->csupload])
            ->andFilterWhere(['like', 'family_id', $this->family_id])
            ->andFilterWhere(['like', 'abiresult', $this->abiresult])
            ->andFilterWhere(['like', 'snpexplain', $this->snpexplain])
            ->andFilterWhere(['like', 'final_note', $this->final_note])
            ->andFilterWhere(['like', 'assigner_note', $this->assigner_note])
            ->andFilterWhere(['like', 'time_stamp', $this->time_stamp])
            ->andFilterWhere(['like', 'kyupload', $this->kyupload])

            ->andFilterWhere(['like', 'rest_product.name', $this->product_name]) //<=====加入这句
            ->andFilterWhere(['like', 'rest_sample.name', $this->username])//<=====加入这句
            ->andFilterWhere(['like', 'rest_sample.tel', $this->tel])

            ->andFilterWhere(['like', 'pingjia.pingjia', $this->pingjia]) //<=====加入这句
            ->andFilterWhere(['like', 'pingjia.linchuang', $this->linchuang])//<=====加入这句
            ->andFilterWhere(['like', 'snpsave', $this->gene])       
            ; 


        return $dataProvider;
    }
}
