<?php

namespace apps\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use apps\models\Information;

/**
 * InformationSearch represents the model behind the search form about `apps\models\Information`.
 */
class InformationSearch extends Information
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['key', 'class', 'genecount', 'sick', 'sick_en', 'gene', 'method', 'omim', 'background', 'wide', 'DM', 'mutation', 'grosins', 'grosdel', 'complex', 'prom', 'deletion', 'insertion', 'indel', 'splice', 'amplet', 'OTHERS', 'refseq'], 'safe'],
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
        $query = Information::find();

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

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'genecount', $this->genecount])
            ->andFilterWhere(['like', 'sick', $this->sick])
            ->andFilterWhere(['like', 'sick_en', $this->sick_en])
            ->andFilterWhere(['like', 'gene', $this->gene])
            ->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'omim', $this->omim])
            ->andFilterWhere(['like', 'background', $this->background])
            ->andFilterWhere(['like', 'wide', $this->wide])
            ->andFilterWhere(['like', 'DM', $this->DM])
            ->andFilterWhere(['like', 'mutation', $this->mutation])
            ->andFilterWhere(['like', 'grosins', $this->grosins])
            ->andFilterWhere(['like', 'grosdel', $this->grosdel])
            ->andFilterWhere(['like', 'complex', $this->complex])
            ->andFilterWhere(['like', 'prom', $this->prom])
            ->andFilterWhere(['like', 'deletion', $this->deletion])
            ->andFilterWhere(['like', 'insertion', $this->insertion])
            ->andFilterWhere(['like', 'indel', $this->indel])
            ->andFilterWhere(['like', 'splice', $this->splice])
            ->andFilterWhere(['like', 'amplet', $this->amplet])
            ->andFilterWhere(['like', 'OTHERS', $this->OTHERS])
            ->andFilterWhere(['like', 'refseq', $this->refseq]);

        return $dataProvider;
    }
}
