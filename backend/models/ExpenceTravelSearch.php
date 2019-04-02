<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ExpenceTravel;

/**
 * ExpenceTravelSearch represents the model behind the search form of `backend\models\ExpenceTravel`.
 */
class ExpenceTravelSearch extends ExpenceTravel {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['vfrom', 'vto', 'mode', 'purpose', 'travelapproval', 'tickets', 'hotelbill', 'taxibill', 'foodbill', 'date', 'dc', 'update_at'], 'safe'],
            [['fare', 'convence', 'hexpence', 'miscellaneous', 'food'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = ExpenceTravel::find();

        // add conditions that should always apply here
        $query->where(["status" => 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'user_id' => $this->user_id,
            'status' => $this->status,
            'fare' => $this->fare,
            'convence' => $this->convence,
            'hexpence' => $this->hexpence,
            'miscellaneous' => $this->miscellaneous,
            'food' => $this->food,
            'date' => $this->date,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'vfrom', $this->vfrom])
                ->andFilterWhere(['like', 'vto', $this->vto])
                ->andFilterWhere(['like', 'mode', $this->mode])
                ->andFilterWhere(['like', 'purpose', $this->purpose])
                ->andFilterWhere(['like', 'travelapproval', $this->travelapproval])
                ->andFilterWhere(['like', 'tickets', $this->tickets])
                ->andFilterWhere(['like', 'hotelbill', $this->hotelbill])
                ->andFilterWhere(['like', 'taxibill', $this->taxibill])
                ->andFilterWhere(['like', 'foodbill', $this->foodbill])
                ->andFilterWhere(['like', 'dc', $this->dc]);

        return $dataProvider;
    }

}
