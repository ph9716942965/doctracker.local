<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Expence;

/**
 * ExpencelocalSearch represents the model behind the search form of `backend\models\Expencelocal`.
 */
class ExpenceSearch extends Expence
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'purpose', 'amount', 'expencetype', 'createby', 'dc', 'date'], 'safe'],
           
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Expence::find();

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
           // ['id', 'purpose', 'amount', 'expencetype', 'createby', 'dc', 'date']
            'id' => $this->id,
            'purpose' => $this->purpose,
            'amount' => $this->amount,
            'expencetype' => $this->expencetype,
            'date' => $this->date,
            'createby' => $this->createby,
            'dc' => $this->dc,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'amount', $this->amount])
            ->andFilterWhere(['like', 'expencetype', $this->expencetype])
            ->andFilterWhere(['like', 'createby', $this->createby])
            ->andFilterWhere(['like', 'dc', $this->dc]);

        return $dataProvider;
    }
}
