<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Expencelocal;

/**
 * ExpencelocalSearch represents the model behind the search form of `backend\models\Expencelocal`.
 */
class ExpencelocalSearch extends Expencelocal {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['vfrom', 'vto', 'mode', 'amount_w', 'purpose', 'upload', 'date', 'dc', 'update_at'], 'safe'],
            [['amount'], 'number'],
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
        $query = Expencelocal::find();

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
            'amount' => $this->amount,
            'date' => $this->date,
            'update_at' => $this->update_at,
        ]);

        $query->andFilterWhere(['like', 'vfrom', $this->vfrom])
                ->andFilterWhere(['like', 'vto', $this->vto])
                ->andFilterWhere(['like', 'mode', $this->mode])
                ->andFilterWhere(['like', 'amount_w', $this->amount_w])
                ->andFilterWhere(['like', 'purpose', $this->purpose])
                ->andFilterWhere(['like', 'upload', $this->upload])
                ->andFilterWhere(['like', 'dc', $this->dc]);

        return $dataProvider;
    }

}
