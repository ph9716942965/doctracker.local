<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ClaimRequest;

/**
 * ClaimRequestSearch represents the model behind the search form of `backend\models\ClaimRequest`.
 **/

class ClaimRequestSearch extends ClaimRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'state_id', 'project_id', 'project_budget_line_id', 'costcenter_id', 'program_id', 'locationdescription_id', 'active'], 'integer'],
            [['request_type', 'visit_from', 'visit_to', 'mode', 'date', 'amountinword', 'purpose', 'dc', 'fund_agency', 'nature_service', 'ro_comment', 'naturehead', 'ho_comment', 'refnumber', 'refdate', 'create_at', 'update_at'], 'safe'],
            [['amount', 'amount2', 'amount3', 'amount4', 'amount5', 'tds', 'advance', 'net'], 'number'],
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
        // echo "<pre>";print_r($_SESSION['login_info']);exit;
        $id=Authid($_SESSION['login_info']['username']);
        $level_id=Authstatus($_SESSION['login_info']['username']);
        $users_under_list=AllUsersIdByStatus($id);

        //echo "<pre>";print_r($users_under_list);exit;
        if($level_id==1){
            $query1 = ClaimRequest::find()->where(['user_id' => $id, 'active' => 1])->andWhere('state_id<3')->orderBy(['id' => SORT_ASC]);
            $query= ClaimRequest::find()->where(['user_id' => $id, 'active' => 1])->andWhere('state_id>3')->orderBy(['id' => SORT_DESC]);
            $query->union($query1, false);
        }elseif($level_id==2){
            $query = ClaimRequest::find()->where("user_id = $id ".AllUsersIdByStatus_condition($users_under_list)." and active=1")->andWhere('state_id=2')->orderBy(['id' => SORT_ASC]);
            $query1 = ClaimRequest::find()->where("user_id = $id ".AllUsersIdByStatus_condition($users_under_list)." and active=1")->andWhere('state_id!=2')->orderBy(['id' => SORT_DESC]);
            $query->union($query1, false);
        }elseif($level_id==3){
            $query = ClaimRequest::find()->select('distinct `claim_request`.*')
                ->innerJoin('claim_request_log','`claim_request_log`.`request_id`=`claim_request`.id')
                ->where(['claim_request.active' =>1])->andWhere('claim_request.state_id=3')->andWhere('claim_request_log.status_id>2')->orderBy(['claim_request.id' => SORT_DESC]);
            $query2 = ClaimRequest::find()->select('distinct `claim_request`.*')
                ->innerJoin('claim_request_log','`claim_request_log`.`request_id`=`claim_request`.id')
                ->where(['claim_request.active' =>1])->andWhere('claim_request.state_id!=3')->andWhere('claim_request_log.status_id>2')->orderBy(['claim_request.id' => SORT_DESC]);
            $query->union($query2,false);
        }elseif($level_id==4){
            $query = ClaimRequest::find()->select('distinct `claim_request`.*')
                ->innerJoin('claim_request_log','`claim_request_log`.`request_id`=`claim_request`.id')
                ->where(['claim_request.active' =>1])->andWhere('claim_request.state_id=4')->andWhere('claim_request_log.status_id>3')->orderBy(['claim_request.id' => SORT_ASC]);
            $queryAC = ClaimRequest::find()->select('distinct `claim_request`.*')
                ->innerJoin('claim_request_log','`claim_request_log`.`request_id`=`claim_request`.id')
                ->where(['claim_request.active' =>1])->andWhere('claim_request.state_id=5')->andWhere('claim_request_log.status_id>3')->orderBy(['claim_request.id' => SORT_DESC]);
           // $query = ClaimRequest::find()->where('active=1 and state_id=4')->orderBy(['id' => SORT_ASC]);
           // $queryAC = ClaimRequest::find()->where('active=1 and state_id=5')->orderBy(['id' => SORT_DESC]);
            $query->union($queryAC, false);
        }else{
            $query = ClaimRequest::find()->where(['active' => 1])->orderBy(['id' => SORT_DESC]);
        }
        // echo $query->createCommand()->rawsql;
        //  exit;
        
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
            'state_id' => $this->state_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'amount2' => $this->amount2,
            'amount3' => $this->amount3,
            'amount4' => $this->amount4,
            'amount5' => $this->amount5,
            'project_id' => $this->project_id,
            'project_budget_line_id' => $this->project_budget_line_id,
            'costcenter_id' => $this->costcenter_id,
            'program_id' => $this->program_id,
            'locationdescription_id' => $this->locationdescription_id,
            'tds' => $this->tds,
            'advance' => $this->advance,
            'net' => $this->net,
            'refdate' => $this->refdate,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'request_type', $this->request_type])
            ->andFilterWhere(['like', 'visit_from', $this->visit_from])
            ->andFilterWhere(['like', 'visit_to', $this->visit_to])
            ->andFilterWhere(['like', 'mode', $this->mode])
            ->andFilterWhere(['like', 'amountinword', $this->amountinword])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'dc', $this->dc])
            ->andFilterWhere(['like', 'fund_agency', $this->fund_agency])
            ->andFilterWhere(['like', 'nature_service', $this->nature_service])
            ->andFilterWhere(['like', 'ro_comment', $this->ro_comment])
            ->andFilterWhere(['like', 'naturehead', $this->naturehead])
            ->andFilterWhere(['like', 'ho_comment', $this->ho_comment])
            ->andFilterWhere(['like', 'refnumber', $this->refnumber]);

        return $dataProvider;
    }

    public function searchex($params)
    {
        $id=Authid($_SESSION['login_info']['username']);
        $query = ClaimRequest::find();
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
            'state_id' => $this->state_id,
            'date' => $this->date,
            'amount' => $this->amount,
            'amount2' => $this->amount2,
            'amount3' => $this->amount3,
            'amount4' => $this->amount4,
            'amount5' => $this->amount5,
            'project_id' => $this->project_id,
            'project_budget_line_id' => $this->project_budget_line_id,
            'costcenter_id' => $this->costcenter_id,
            'program_id' => $this->program_id,
            'locationdescription_id' => $this->locationdescription_id,
            'tds' => $this->tds,
            'advance' => $this->advance,
            'net' => $this->net,
            'refdate' => $this->refdate,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'request_type', $this->request_type])
            ->andFilterWhere(['like', 'visit_from', $this->visit_from])
            ->andFilterWhere(['like', 'visit_to', $this->visit_to])
            ->andFilterWhere(['like', 'mode', $this->mode])
            ->andFilterWhere(['like', 'amountinword', $this->amountinword])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'dc', $this->dc])
            ->andFilterWhere(['like', 'fund_agency', $this->fund_agency])
            ->andFilterWhere(['like', 'nature_service', $this->nature_service])
            ->andFilterWhere(['like', 'ro_comment', $this->ro_comment])
            ->andFilterWhere(['like', 'naturehead', $this->naturehead])
            ->andFilterWhere(['like', 'ho_comment', $this->ho_comment])
            ->andFilterWhere(['like', 'refnumber', $this->refnumber]);

        return $dataProvider;
    }
}
