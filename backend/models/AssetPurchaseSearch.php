<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AssetPurchase;

/**
 * AssetPurchaseSearch represents the model behind the search form of `backend\models\AssetPurchase`.
 */
class AssetPurchaseSearch extends AssetPurchase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ro_id', 'asset_category_id', 'vendor_id', 'project_id', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_centre_id', 'cost_centre_sub_id', 'status', 'user_id'], 'integer'],
            [['name', 'purpose', 'members_of_purchase_committee', 'date', 'file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice', 'natural_head', 'lo', 'ho_comment', 'ref_number', 'ref_date', 'ac_comment', 'created_at', 'updated_at'], 'safe'],
            [['amount'], 'number'],
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
        $query = AssetPurchase::find();

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
            'ro_id' => $this->ro_id,
            'asset_category_id' => $this->asset_category_id,
            'date' => $this->date,
            'vendor_id' => $this->vendor_id,
            'amount' => $this->amount,
            'project_id' => $this->project_id,
            'program_id' => $this->program_id,
            'funding_agency_id' => $this->funding_agency_id,
            'funding_agency_bu_id' => $this->funding_agency_bu_id,
            'cost_centre_id' => $this->cost_centre_id,
            'cost_centre_sub_id' => $this->cost_centre_sub_id,
            'ref_date' => $this->ref_date,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'members_of_purchase_committee', $this->members_of_purchase_committee])
            ->andFilterWhere(['like', 'file_purchase_request_apporval', $this->file_purchase_request_apporval])
            ->andFilterWhere(['like', 'file_quotation', $this->file_quotation])
            ->andFilterWhere(['like', 'file_purchase_commite', $this->file_purchase_commite])
            ->andFilterWhere(['like', 'file_purchase_order', $this->file_purchase_order])
            ->andFilterWhere(['like', 'file_pro_forma_final_invoice', $this->file_pro_forma_final_invoice])
            ->andFilterWhere(['like', 'natural_head', $this->natural_head])
            ->andFilterWhere(['like', 'lo', $this->lo])
            ->andFilterWhere(['like', 'ho_comment', $this->ho_comment])
            ->andFilterWhere(['like', 'ref_number', $this->ref_number])
            ->andFilterWhere(['like', 'ac_comment', $this->ac_comment]);

        return $dataProvider;
    }
}
