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
            [['id', 'uid', 'pingjia', 'createtime'], 'integer'],
            [['sick', 'product', 'sex','tel', 'diagnose', 'gene', 'attachements'], 'safe'],
            [['age'],'number'],
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
    public function search($params, $query='')
    {
        if(!$query) $query = MingruiReportstore::find();

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
            'pingjia' => $this->pingjia, 
            'createtime' => $this->createtime, 
            'age' => $this->age, 
            'sex' => $this->sex, 
        ]);

        $query->andFilterWhere(['like', 'sick', $this->sick])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'diagnose', $this->diagnose])
            ->andFilterWhere(['like', 'gene', $this->gene])
            ->andFilterWhere(['like', 'attachements', $this->attachements])
            ->andFilterWhere(['like', 'extra1', $this->extra1])
           ->andFilterWhere(['like', 'extra2', $this->extra2])
           ->andFilterWhere(['like', 'extra3', $this->extra3]);;

        return $dataProvider;
    }
}
