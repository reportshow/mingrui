<?php

namespace apps\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use apps\models\Mainlist;

/**
 * MainlistSearch represents the model behind the search form about `apps\models\Mainlist`.
 */
class MainlistSearch extends Mainlist
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'name_en', 'number', 'description', 'hassub', 'classname'], 'safe'],
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
        $query = Mainlist::find();
        $query = $query->orderBy('orderby');

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'hassub', $this->hassub])
            ->andFilterWhere(['like', 'classname', $this->classname]);

        return $dataProvider;
    }
}
