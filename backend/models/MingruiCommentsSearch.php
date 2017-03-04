<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MingruiComments;

/**
 * MingruiCommentsSearch represents the model behind the search form about `backend\models\MingruiComments`.
 */
class MingruiCommentsSearch extends MingruiComments
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'to_uid', 'createtime'], 'integer'],
            [['report_id', 'content', 'isread'], 'safe'],
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
       if(!$query) $query = MingruiComments::find();

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
            'to_uid' => $this->to_uid, 
            'createtime' => $this->createtime, 
        ]);

        $query->andFilterWhere(['like', 'report_id', $this->report_id])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'isread', $this->isread]);

       //echo $query->createCommand()->getRawSql(); exit;   
        return $dataProvider;
    }
}
