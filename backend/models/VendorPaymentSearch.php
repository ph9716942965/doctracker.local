<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Vendorpayment;

/**
 * VendorpaymentSearch represents the model behind the search form of `backend\models\Vendorpayment`.
 */
class VendorpaymentSearch extends Vendorpayment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status_id', 'vendor_id', 'project_id', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_center_id', 'cost_centre_sub'], 'integer'],
            [['service_by', 'purpose', 'upload_approval', 'upload_bill', 'natural_head', 'lo', 'comment_ho', 'cv_ref', 'cr_date', 'comment_ac'], 'safe'],
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
        $level_id=Authstatus($_SESSION['login_info']['username']);
        $id=Authid($_SESSION['login_info']['username']);
        //echo $id;exit;
        if( $level_id==2){
            $query1 = Vendorpayment::find()->where(['user_id' => $id])->andWhere('status_id=2')->orderBy(['id' => SORT_ASC]);
            $query= Vendorpayment::find()->where(['user_id' => $id])->andWhere('status_id>2')->orderBy(['id' => SORT_DESC]);
            // echo $query->createCommand()->getRawSql();exit;
            // echo $query->sqlrow();exit;
            $query->union($query1, false);
        }else if($level_id==3){
            $query = Vendorpayment::find()->Where('status_id>2')->orderBy(['id' => SORT_ASC]);
        }else if($level_id==4){
            $query = Vendorpayment::find()->Where('status_id>3')->orderBy(['id' => SORT_ASC]);
        }else{
            $query = Vendorpayment::find()->Where('status_id=null')->orderBy(['id' => SORT_ASC]);//No record Will Found
        }
       // $query = Vendorpayment::find();

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
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'vendor_id' => $this->vendor_id,
            'amount' => $this->amount,
            'project_id' => $this->project_id,
            'program_id' => $this->program_id,
            'funding_agency_id' => $this->funding_agency_id,
            'funding_agency_bu_id' => $this->funding_agency_bu_id,
            'cost_center_id' => $this->cost_center_id,
            'cost_centre_sub' => $this->cost_centre_sub,
        ]);

        $query->andFilterWhere(['like', 'service_by', $this->service_by])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'upload_approval', $this->upload_approval])
            ->andFilterWhere(['like', 'upload_bill', $this->upload_bill])
            ->andFilterWhere(['like', 'natural_head', $this->natural_head])
            ->andFilterWhere(['like', 'lo', $this->lo])
            ->andFilterWhere(['like', 'comment_ho', $this->comment_ho])
            ->andFilterWhere(['like', 'cv_ref', $this->cv_ref])
            ->andFilterWhere(['like', 'cr_date', $this->cr_date])
            ->andFilterWhere(['like', 'comment_ac', $this->comment_ac]);

        return $dataProvider;
    }
}
