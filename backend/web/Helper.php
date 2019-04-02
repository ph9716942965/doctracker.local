<?php

class MyCommand {

    public function get($query) {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($query);
        $res = $command->execute();
        $res = $command->queryAll();
        return $res;
    }

}

function emp_name($id) {
    return \backend\models\User::find()->select('username')->where(["id"=>$id])->asArray()->one()['username'];
}

//$obj=new MyCommand;
function checkauth($user_id, $return_url = null) {
    return \backend\models\User::find()->select('id')->where(["username"=>$user_id])->asArray()->one()['id'];
/*
    $obj = new MyCommand;
    $q = 'select id from user where username ="' . $user_id . '"';
    return $obj->get($q)[0]['id'];
    return $user_id;*/
}

function child($user_id) {
    return \backend\models\User::find()->select('id,username')->where(["parent_id"=>$user_id])->asArray()->all();
/*
    $obj = new MyCommand;
    $q = 'SELECT id,username FROM `user` WHERE `parent_id`=' . $user_id;
    return $obj->get($q);*/
}

function Authid($user_id) {//return user id
    return \backend\models\User::find()->select('id')->where(["username"=>$user_id])->asArray()->one()['id'];
/*
    $obj = new MyCommand;
    $q = 'select id from user where username ="' . $user_id . '"';
    return $obj->get($q)[0]['id'];*/
}

function AllUsersIdByStatus($selfid, $user_level_id = null) { //return all users list from users
   // return \backend\models\User::find()->select('id')->where(["parent_id"=>$selfid])->orwhere(["id"=>$selfid])->asArray()->all();

    $obj = new MyCommand;
    $q = 'SELECT `id` FROM `user` WHERE `parent_id`=' . $selfid . ' or `id`=' . $selfid;
//$q='SELECT `id` FROM `user` WHERE `level_id`='.$user_level_id.' or `parent_id`='.$selfid;
    return $obj->get($q);
}

function AllUsersIdByStatus_condition($arr) {
    $condition = '';
    $users_under_list = $arr;
    foreach ($users_under_list as $v) {
        $condition.=' or user_id=' . $v['id'];
    }
    return $condition;
}

function Authstatus($user_id) { //check user Level ID
    return \backend\models\User::find()->select('level_id')->where(["username"=>$user_id])->asArray()->one()['level_id'];
    /*$obj = new MyCommand;
    $q = 'select level_id from user where username ="' . $user_id . '"';
    return $obj->get($q)[0]['level_id'];*/
}

function Return_only_ho($RID) {
    $q = 'SELECT `status_id` FROM `claim_request_log` where `request_id`=' . $RID . ' order by `id` desc limit 0,2';
    $obj = new MyCommand;
    $re = $obj->get($q);
    @$o = $re[1]['status_id'];
    $n = $re[0]['status_id'];
    if ($o == 3 && $n == 2) {
        return false;
    } else {
        return true;
    }
}

function Rstatus($RID=null) {

    $q = 'SELECT `status_id` FROM `claim_request_log` where `request_id`=' . $RID . ' order by `id` desc limit 0,2';
   // echo $q;exit;
    $obj = new MyCommand;
   @ $re = $obj->get($q);
    @$o = $re[1]['status_id'];
    $n = $re[0]['status_id'];
    /* $q='SELECT * FROM `claim_request_status` where  `request_id`='.$RID;
      $obj=new MyCommand;
      $re=$obj->get($q);
      $o=$re[0]['old'];
      $n=$re[0]['new']; */
    if ($o == $n || sizeof($re) == 1) {
        $com = $re[0]['status_id'];
        // $com=$re[0]['new'];
        if ($com == 1 || $com == 2) {
            return 'Pending At RO level';
        } elseif ($com == 3) {
            return 'Pending At HO level';
        } elseif ($com == 4) {
            return 'Pending At A/c Level';
        }
    }
    if ($o == 2 && $n == 1) {
        return 'Return By RO';
    } elseif ($o == 3 && $n == 2) {
        return 'Return By HO';
    } elseif ($o == 4 && $n == 3) {
        return 'Return By Account Level';
    } elseif ($o == 1 && $n == 2) {
        return 'Pending By RO';
    } elseif ($o == 2 && $n == 3) {
        return 'Approved By RO';
    } elseif ($o == 3 && $n == 4) {
        return 'Approved By HO';
    } elseif ($o == 4 && $n == 5) {
        return 'Approved By Ac';
    } elseif ($o == 1 && $n == 3) {
        return 'Approved By RO';
    } elseif ($o == 3 && $n == 1) {
        return 'Return By Ho';
    } else {
        // return "";
    }
//return $re;
}

function readonly_sub($false, $fld) {
    $has_A = stripos($false, $fld) !== false;
    if ($has_A) {
        return false;
    } else {
        return true;
    }
}

function readonly($id = null, $level = null, $fld = null){
    $lv = Authstatus($level);
    $obj = new MyCommand;
    $q = 'SELECT `state_id` FROM `claim_request` WHERE `id`=' . $id;
    $cid = $obj->get($q)[0]['state_id'];
    $false = '';
    $true = '';
    if ($lv == 1) {

        if ($cid == 1 or $cid == 2) {
            $false.='~ mode ~ visit_to ~ visit_from ~ amount ~ amountinword ~ purpose ~';
            $has_A = stripos($false, $fld) !== false;
            if ($has_A) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    } elseif ($lv == 2) {
        $false.='~ fund_agency ~ nature_service ~ ro_comment ~ ';
        if ($cid == 2) {
            $has_A = stripos($false, $fld) !== false;
            if ($has_A) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
    if ($lv == 3) {
        $false.='ho_comment';
        if ($cid == 3) {
            $has_A = stripos($false, $fld) !== false;
            if ($has_A) {
                return false;
            } else {
                return true;
            }
        }
    }

    if ($lv == 4) {
        $false.='~ tds ~ advance ~ net ~ refnumber ~ refdate ';
        if ($cid == 4) {
            $has_A = stripos($false, $fld) !== false;
            if ($has_A) {
                return false;
            } else {
                return true;
            }
        }
        /* $has_A = stripos($false, $fld) !== false;
          if($has_A){
          return false;
          }
          else{
          return true;
          } */
    }
    return \backend\models\ClaimRequest::find()->select('state_id')->where(["id"=>$id])->asArray()->one()['state_id'];
}

function uploads($id) {
    $uploads= \backend\models\Upload::find()->select('url')->where(["request_id"=>$id])->asArray()->all();

   /* $q = 'SELECT `url` FROM `upload` WHERE `request_id`=' . $id;
    $obj = new MyCommand;
    $uploads = $obj->get($q);*/
    if (sizeof($uploads) > 0) {
        $return = '';
        foreach ($uploads as $img) {
            $return.='<a href="' . $img['url'] . '"><img src="' . $img['url'] . '" height="70" width="70" ></a> ';
        }
        return '<label class="control-label">Total Uploads</label> (' . sizeof($uploads) . ')<br>' . $return . '<hr>';
    }
}

function AssetPurchseModelValidation($level_id) {

    $RO = ['ro_id', 'asset_category_id', 'name', 'members_of_purchase_committee', 'date', 'vendor_id', 'amount', 'project_id', 'file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice', 'user_id'];
    $HO = ['ro_id', 'asset_category_id', 'name', 'members_of_purchase_committee', 'date', 'vendor_id', 'amount', 'project_id', 'file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice', 'natural_head', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_centre_id', 'cost_centre_sub_id', 'lo', 'user_id'];
    $AC = ['ro_id', 'asset_category_id', 'name', 'members_of_purchase_committee', 'date', 'vendor_id', 'amount', 'project_id', 'file_purchase_request_apporval', 'file_quotation', 'file_purchase_commite', 'file_purchase_order', 'file_pro_forma_final_invoice', 'natural_head', 'program_id', 'funding_agency_id', 'funding_agency_bu_id', 'cost_centre_id', 'cost_centre_sub_id', 'lo', 'ref_number', 'ref_date', 'user_id'];

    if ($level_id == backend\models\Level::RO) {
        return $RO;
    } elseif ($level_id == backend\models\Level::HO) {
        return $HO;
    } elseif ($level_id == backend\models\Level::ACCOUNTS) {
        return $AC;
    } else {
        return [];
    }
}

function ClaimRequestModelValidation($user_id) {
    $l = Authstatus($user_id);
    $EMP = ['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4', 'amount5', 'amountinword', 'purpose'];
    $RO = ['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4', 'amount5', 'amountinword', 'purpose', 'fund_agency', 'nature_service', 'ro_comment'];
    $HO = ['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4', 'amount5', 'amountinword', 'purpose', 'fund_agency', 'nature_service', 'ro_comment', 'naturehead', 'project_id', 'project_budget_line_id', 'costcenter_id', 'program_id', 'locationdescription_id', 'ho_comment'];
    $AC = ['user_id', 'state_id', 'visit_from', 'visit_to', 'mode', 'date', 'amount', 'amount2', 'amount3', 'amount4', 'amount5', 'amountinword', 'purpose', 'fund_agency', 'nature_service', 'ro_comment', 'naturehead', 'project_id', 'project_budget_line_id', 'costcenter_id', 'program_id', 'locationdescription_id', 'ho_comment', 'tds', 'advance', 'net', 'refnumber', 'refdate'];

    if ($l == 1) {
        return $EMP;
    } elseif ($l == 2) {
        return $RO;
    } elseif ($l == 3) {
        return $HO;
    } elseif ($l == 4) {
        return $AC;
    } else {
        return $EMP;
    }
    //return $l;
}

function RequestModelValidation($user_id) {
    $l = Authstatus($user_id);
    $RO = ['user_id', 'status_id', 'visitfrom', 'visitto',];
    $AC = ['user_id', 'status_id', 'visitfrom', 'visitto', 'mode', 'date', 'amount', 'amountinword', 'amount2', 'amount3', 'amount4', 'amount5', 'project', 'budgetline', 'program', 'locationdescription', 'tds', 'advance', 'net', 'refnumber', 'refdate'];
    $HO = ['user_id', 'status_id', 'visitfrom', 'visitto', 'mode', 'date', 'amount', 'amountinword', 'amount2', 'amount3', 'amount4', 'amount5', 'project', 'budgetline', 'program', 'locationdescription'];
    $EMP = ['user_id', 'status_id', 'visitfrom', 'visitto', 'mode', 'date', 'amount', 'amountinword', 'amount2', 'amount3', 'amount4', 'amount5'];
    //echo $l;exit;
    if ($l == 1) {
        return $EMP;
    } elseif ($l == 2) {
        return $RO;
    } elseif ($l == 3) {
        return $HO;
    } elseif ($l == 4) {
        return $AC;
    } else {
        return $EMP;
    }
}

class CheckAuth2 extends MyCommand {

    public $SID;

    function __construct($sid = null) {
        // parent::__construct();
        //public static $SID
        $this->SID = $sid;
    }
    public static function obj($obj)
   {
      return new CheckAuth2($obj);
   }

    function Return_st($cr_id){
        $status=$this->Rstatus($cr_id);
        return $status;
       // echo "<pre>";print_r($status);exit;
    }
    

    function user_id() {
        return \backend\models\User::find()->select('id')->where(["username"=>$this->SID])->asArray()->one()['id'];
    }
    
    function email() {
        
        $q = 'SELECT `email` FROM `user` WHERE `username`="' . $this->SID . '"';
        return (isset($this->get($q)[0]['email'])) ? $this->get($q)[0]['email'] : '';
    }

    

    function joindate() {
        $q = 'SELECT `created_at` FROM `user` WHERE `username`="' . $this->SID . '"';
        return isset($this->get($q)[0]['created_at']) ? $this->get($q)[0]['created_at'] : "";
    }

    function username() {
        return $this->SID;
    }

    public function Checkuser($user_id = null) {
        if ($user_id == null) {
            $q = 'select level_id from user where username ="' . $this->SID . '"';
        } else {
            $q = 'select level_id from user where username ="' . $user_id . '"';
        }
        @$id = $this->get($q)[0]['level_id'];
        if ($id == 4) {
            return 'AC';
        } elseif ($id == 3) {
            return 'HO';
        } elseif ($id == 2) {
            return 'RO';
        } else {
            return 'EMP';
        }
        // return ($id==4)?'AC':($id==3)?'HO':($id==2)?'RO':($id==1)?'EMP':'EMP'; 
    }

    private function Rstatus($RID) {

        $q = 'SELECT `status_id` FROM `claim_request_log` where `request_id`=' . $RID . ' order by `id` desc limit 0,2';
        $obj = new MyCommand;
        @$re = $obj->get($q);
        @$o = $re[1]['status_id'];
        $n = $re[0]['status_id'];
        if ($o == $n || sizeof($re) == 1) {
            $com = $re[0]['status_id'];
            if ($com == 1 || $com == 2) {return 'Pending At RO level';}
            elseif ($com == 3) { return 'Pending At HO level';} 
            elseif ($com == 4) { return 'Pending At A/c Level';  }
        }
        if ($o == 2 && $n == 1) { return 'Return By RO';} 
        elseif ($o == 3 && $n == 2) {return 'Return By HO';
        } elseif ($o == 4 && $n == 3) { return 'Return By Account Level';
        } elseif ($o == 1 && $n == 2) { return 'Pending By RO';
        } elseif ($o == 2 && $n == 3) { return 'Approved By RO';
        } elseif ($o == 3 && $n == 4) { return 'Approved By HO';
        } elseif ($o == 4 && $n == 5) { return 'Approved By Ac';
        } elseif ($o == 1 && $n == 3) { return 'Approved By RO';
        } elseif ($o == 3 && $n == 1) { return 'Return By Ho';
        } else { // return "";
        }
    //return $re;
    }

    function name() {
        
    }

}

function fundagency_name($id){
    return \backend\models\FundingAgency::find()->select('name')->where(["id"=>$id])->asArray()->one()['name'];
   // $im= \backend\models\FundingAgency::find()->select("name")->where(["id"=>$id])->one();
}

function notnew($id,$insec=null) { //check history of return
    $r= \backend\models\ClaimRequestLog::find()->select('MAX(`status_id`) as max_status_id')->where(["request_id"=>$id])->asArray()->one()['max_status_id'];
   if($insec=='HO'){
    return ($r>3)?false:true;
   }elseif($insec=='RO'){
    return ($r>2)?false:true;
   }else{
       return true;
   }
}



function project_name($id) {
    return \backend\models\Project::find()->select('name')->where(["id"=>$id])->asArray()->one()['name'];
}

function project_budget_line_name($id) {
    return \backend\models\ProjectBudgetLine::find()->select('name')->where(["id"=>$id])->asArray()->one()['name'];
}

function costcenter_name($id) {
    return \backend\models\CostCentre::find()->select('name')->where(["id"=>$id])->asArray()->one()['name'];
}

function costcentersub_name($id) {
    return \backend\models\CostCentreSub::find()->select('name')->where(["id"=>$id])->asArray()->one()['name'];
}

function program_name($id) {
    return \backend\models\Program::find()->select('name')->where(["id"=>$id])->asArray()->one()['name'];
}

function locationdescription_name($id) {
    return \backend\models\Locationdescription::find()->select('dis')->where(["id"=>$id])->asArray()->one()['dis'];
}

function allcomments($id,$by=2){
    $obj = new MyCommand;
    if($by==2){
        $UID='RO Comments';
        $q='select ro_comment as comment,update_at from claim_request where id='.$id.' union select comment,update_at from comment_log where request_id='.$id.' and comment_by=2 ORDER BY `update_at` DESC';  
    }elseif($by==3){
        $UID='HO Comments';
        $q='select ho_comment as comment,update_at from claim_request where id='.$id.' union select comment,update_at from comment_log where request_id='.$id.' and comment_by=2 ORDER BY `update_at` DESC';  
    }elseif($by==4){
        $UID='AC Comments';
        $q='select ac_comment as comment,update_at from claim_request where id='.$id.' union select comment,update_at from comment_log where request_id='.$id.' and comment_by=4 ORDER BY `update_at` DESC';  
    }
     $com= $obj->get($q); $r='';
        foreach($com as $v){
            if($v['comment']){    
                $r.= '<div class="col-md-8"> <label class="control-label">'.$UID.' ('.$v['update_at'].')</label> <input type="textarea" class="form-control"  value="'.$v['comment'].'" readonly="true" aria-invalid="false"></div><br>';
            }
        }
        return $r;
    }



function field_gen($value,$label){
    return '<div class="col-md-4">
            <label class="control-label">'.$label.'</label>
            <input type="text" class="form-control"  value="'.$value.'" readonly="true" aria-invalid="false">
        </div>';
}
