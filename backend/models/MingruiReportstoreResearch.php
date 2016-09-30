<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MingruiReportstore;

/**
 * MingruiReportstoreResearch represents the model behind the search form about `backend\models\MingruiReportstore`.
 */
class MingruiReportstoreResearch extends MingruiReportstore
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'createtime'], 'integer'],
            [['sick', 'product', 'tel', 'diagnose', 'attachements'], 'safe'],
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
    public function search($params)
    {
        $query = MingruiReportstore::find();

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
            'uid' => $this->uid, 
            'createtime' => $this->createtime, 
        ]);

        $query->andFilterWhere(['like', 'sick', $this->sick])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'diagnose', $this->diagnose])
            ->andFilterWhere(['like', 'attachements', $this->attachements]);

        return $dataProvider;
    }
}
