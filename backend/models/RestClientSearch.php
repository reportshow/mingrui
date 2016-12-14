<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RestClient;

/**
 * RestClientSearch represents the model behind the search form about `backend\models\RestClient`.
 */
class RestClientSearch extends RestClient
{
    public $hospitalname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'age', 'hospital_id'], 'integer'],
            [[
            'hospitalname',
            'name', 'sex', 'birthplace', 'email', 'tel', 'school', 'education', 
            'experience', 'employed', 'department', 'worktime', 'position', 
            'speciality', 'hobby', 'notes', 'zhuren', 'pianhao'], 'safe'],
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
    public function search($params,$query=null)
    {
        if(!$query) $query = RestClient::find();

        $query = $query->joinWith(['hospital']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
 
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            //var_dump($params);exit;
            return $dataProvider;
        }
  
        // grid filtering conditions
        $query->andFilterWhere([
            'rest_client.id' => $this->id, 
            'age' => $this->age, 
            'hospital_id' => $this->hospital_id, 
        ]);

        $query->andFilterWhere(['like', 'rest_client.name', $this->name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'birthplace', $this->birthplace])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'school', $this->school])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'employed', $this->employed])
            ->andFilterWhere(['like', 'department', $this->department])
            ->andFilterWhere(['like', 'worktime', $this->worktime])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'speciality', $this->speciality])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'zhuren', $this->zhuren])
            ->andFilterWhere(['like', 'pianhao', $this->pianhao]) 
            ->andFilterWhere(['like', 'rest_danwei.name', $this->hospitalname]);

        //echo $query->createCommand()->getRawSql(); exit;   
        return $dataProvider;
    }
}
