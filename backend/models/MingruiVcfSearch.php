<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MingruiVcf;

/**
 * MingruiVcfSearch represents the model behind the search form about `backend\models\MingruiVcf`.
 */
class MingruiVcfSearch extends MingruiVcf
{
     public $creator_name;
     public $pingjia;
     public $linchuang;
      /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'createtime', 'task_id'], 'integer'],
            
            [['creator_name','pingjia','linchuang',
	    'sick', 'sex', 'vcf', 'status', 'tel', 'product', 'diagnose', 'gene'], 'safe'],
            [['age'], 'number'],
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
        if (!$query) {
            $query = MingruiVcf::find();
        } 
        $query =$query->orderBy('id DESC');
        $query = $query->joinWith(['creator']);
        $query = $query->joinWith(['pingjia']);
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
            'mingrui_vcf.id' => $this->id, 
           // 'uid' => $this->uid, 
            'age' => $this->age, 
          //  'createtime' => $this->createtime, 
            'task_id' => $this->task_id, 
        ]);

        $query->andFilterWhere(['like', 'sick', $this->sick])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'vcf', $this->vcf])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'product', $this->product])
            ->andFilterWhere(['like', 'diagnose', $this->diagnose])
            ->andFilterWhere(['like', 'gene', $this->gene])
	                ->andFilterWhere(['like', 'mingrui_pingjia.pingjia', $this->pingjia]) //<=====加入这句
                  ->andFilterWhere(['like', 'mingrui_pingjia.linchuang', $this->linchuang]) //<=====加入这句    
            ->andFilterWhere(['like', 'user.nickname', $this->creator_name]);

        return $dataProvider;
    }
}
