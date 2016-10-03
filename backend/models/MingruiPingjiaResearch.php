<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MingruiPingjia;

/**
 * MingruiPingjiaResearch represents the model behind the search form about `backend\models\MingruiPingjia`.
 */
class MingruiPingjiaResearch extends MingruiPingjia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'report_id', 'uid', 'pingjia'], 'integer'],
            [['linchuang', 'createtime'], 'safe'],
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
        $query = MingruiPingjia::find();

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
            'report_id' => $this->report_id, 
            'uid' => $this->uid, 
            'pingjia' => $this->pingjia, 
            'createtime' => $this->createtime, 
        ]);

        $query->andFilterWhere(['like', 'linchuang', $this->linchuang]);

        return $dataProvider;
    }
}
