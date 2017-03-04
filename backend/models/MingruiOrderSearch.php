<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MingruiOrder;

/**
 * MingruiOrderSearch represents the model behind the search form about `backend\models\MingruiOrder`.
 */
class MingruiOrderSearch extends MingruiOrder
{
    
    public $docotr_name;
    public $doctor_tel;
    public $doctor_area;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'doctor'], 'integer'],
            [['createtime', 'status', 'assigned', 'notes','docotr_name','doctor_tel','doctor_area'], 'safe'],
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
        $query = MingruiOrder::find();
        $quer = $query->joinWith(['mydoctor'])
         ->joinWith(['mydoctor.hospital']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort' => [
			        'defaultOrder' => [
			            'createtime' => SORT_DESC,            
			        ]
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
            'mingrui_order.id' => $this->id, 
            'doctor' => $this->doctor, 
            'Date(createtime)' => $this->createtime, 
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'assigned', $this->assigned])
            ->andFilterWhere(['like', 'notes', $this->notes])

            ->andFilterWhere(['like', 'rest_client.name', $this->docotr_name])
            ->andFilterWhere(['like', 'rest_client.tel', $this->doctor_tel])
            ->andFilterWhere(['like', 'rest_danwei.name', $this->doctor_area])
            ;



        return $dataProvider;
    }
}
