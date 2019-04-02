<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * VendorSearch represents the model behind the search form of `backend\models\Vendor`.
 */
class VendorSearch extends Vendor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ro_id', 'applicability', 'district_id', 'pincode', 'contact_no', 'company_pincode', 'company_district_id', 'bank_pincode', 'bank_district_id', 'status'], 'integer'],
            [['vendor_no', 'name_unit', 'vendor_type', 'salutation', 'first_name', 'middle_name', 'last_name', 'nationality', 'address', 'email_id', 'pan_no', 'company_name', 'parent_company_name', 'website', 'company_address', 'bank_name', 'branch_id', 'branch_name', 'branch_address', 'bank_account_name', 'bank_currency', 'bank_account_no', 'bank_account_type', 'ifsc_code', 'swift_code', 'iban', 'cb_bank_name', 'cb_address', 'cb_account_no', 'cb_swift_code', 'updated_at', 'created_at'], 'safe'],
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vendor::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
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
            'applicability' => $this->applicability,
            'district_id' => $this->district_id,
            'pincode' => $this->pincode,
            'contact_no' => $this->contact_no,
            'company_pincode' => $this->company_pincode,
            'company_district_id' => $this->company_district_id,
            'bank_pincode' => $this->bank_pincode,
            'bank_district_id' => $this->bank_district_id,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'vendor_no', $this->vendor_no])
                ->andFilterWhere(['like', 'name_unit', $this->name_unit])
                ->andFilterWhere(['like', 'vendor_type', $this->vendor_type])
                ->andFilterWhere(['like', 'salutation', $this->salutation])
                ->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'middle_name', $this->middle_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'nationality', $this->nationality])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'email_id', $this->email_id])
                ->andFilterWhere(['like', 'pan_no', $this->pan_no])
                ->andFilterWhere(['like', 'company_name', $this->company_name])
                ->andFilterWhere(['like', 'parent_company_name', $this->parent_company_name])
                ->andFilterWhere(['like', 'website', $this->website])
                ->andFilterWhere(['like', 'company_address', $this->company_address])
                ->andFilterWhere(['like', 'bank_name', $this->bank_name])
                ->andFilterWhere(['like', 'branch_id', $this->branch_id])
                ->andFilterWhere(['like', 'branch_name', $this->branch_name])
                ->andFilterWhere(['like', 'branch_address', $this->branch_address])
                ->andFilterWhere(['like', 'bank_account_name', $this->bank_account_name])
                ->andFilterWhere(['like', 'bank_currency', $this->bank_currency])
                ->andFilterWhere(['like', 'bank_account_no', $this->bank_account_no])
                ->andFilterWhere(['like', 'bank_account_type', $this->bank_account_type])
                ->andFilterWhere(['like', 'ifsc_code', $this->ifsc_code])
                ->andFilterWhere(['like', 'swift_code', $this->swift_code])
                ->andFilterWhere(['like', 'iban', $this->iban])
                ->andFilterWhere(['like', 'cb_bank_name', $this->cb_bank_name])
                ->andFilterWhere(['like', 'cb_address', $this->cb_address])
                ->andFilterWhere(['like', 'cb_account_no', $this->cb_account_no])
                ->andFilterWhere(['like', 'cb_swift_code', $this->cb_swift_code]);

        // display_array($query->createCommand()->rawsql);
        // exit;

        return $dataProvider;
    }
}
