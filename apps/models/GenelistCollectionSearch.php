<?php

namespace apps\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use apps\models\GenelistCollection;

/**
 * GenelistCollectionSearch represents the model behind the search form about `apps\models\GenelistCollection`.
 */
class GenelistCollectionSearch extends GenelistCollection
{
    public $gene;
    public $sick;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creator_info', 'createtime'], 'integer'],
            [[
            'gene','sick', //add--
            'omim', 'zhenduan', 'zhiliao', 'used'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent sick
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = GenelistCollection::find();
        $query->joinWith(['info']);
        // add conditions that should always apply here

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
            'id' => $this->id, 
            'creator_info' => $this->creator_info, 
            'createtime' => $this->createtime, 
        ]);

        $query->andFilterWhere(['like', 'omim', $this->omim])
            ->andFilterWhere(['like', 'zhenduan', $this->zhenduan])
            ->andFilterWhere(['like', 'zhiliao', $this->zhiliao])
            ->andFilterWhere(['like', 'used', $this->used])
            ->andFilterWhere(['like', 'genelist_information.sick', $this->sick])
            ->andFilterWhere(['like', 'genelist_information.gene', $this->gene])
            ;

        return $dataProvider;
    }
}
