<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
//$USERAUTH=new CheckAuth;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClaimRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Claim Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-request-index">
<div class="pull-right">
        <?php echo common\widgets\Alert::widget() ?>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php
    if(\CheckAuth2::obj($_SESSION['login_info']['username'])->Checkuser()!='AC'){
        echo Html::a('Create Claim Request', ['create'], ['class' => 'btn btn-success']);
    }
    ?>
       
    </p>
    <?php
//echo "<pre>";
//print_r($dataProvider);
$data=[];
/*
foreach($dataProvider as $v){
   // echo "<pre>";print_r($v);exit;
    //print_r(Rstatus());
   // print_r($v);
}*/

//exit;


    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'request_type',
            [
            'label' => 'Employee Code',
            'attribute'=>'user_id',
            'value'=>function ($data){ return isset($data->user_id)?emp_name($data->user_id):"";}],
            [
               'label' => 'Amount INR',
               'attribute'=>'amount', 
                  'filter'=>false,
               'value'=>function ($data){
                       $r=isset($data->amount)?$data->amount:0;
                       $r+=isset($data->amount2)?$data->amount2:0;
                       $r+=isset($data->amount3)?$data->amount3:0;
                       $r+=isset($data->amount4)?$data->amount4:0;
                       $r+=isset($data->amount5)?$data->amount5:0;
                        return $r;
                } 
            ],
           /* [
                'attribute'=>'purpose',
                 
                'value'=>function ($data){ return isset($data->purpose)?substr($data->purpose,0,30):'';} 
             ],*/
            
            
             [
                'label' => 'Status',
                'attribute'=>'state_id', 
                'filter'=>['1'=>'Pending at RO level','2'=>'Pending at Ho level','3'=>'Approved By Ho'], //with custome sarch
                'value'=>function($data){
                    //$r= isset($data->state_id)?$data->state_id:0;
                    //echo "<pre>";print_r($data->state_id);exit;
                    //return $data->state_id;
                  return Rstatus($data->id);
                    } 
             ],

             [
                'label' => 'Submitted Date',
                //'attribute'=>'Amount0', // $model->date=date("d-m-Y", strtotime($model->date));
                  // 'filter'=>['1'=>'text','2'=>'jpg'], //with custome sarch
                'value'=>function ($data){ return isset($data->create_at)?date("d-m-Y", strtotime($data->create_at)):'';} 
             ],
             
            //'id',
           // 'user_id',
            //'state_id',
            //'visit_from',
            //'visit_to',
            //'mode',
            //'date',
            //'amount',
            //'amount2',
            //'amount3',
            //'amount5',
            //'amountinword',
            //'purpose',
            //'dc',
            //'fund_agency',
            //'nature_service',
            //'ro_comment',
            //'naturehead',
            //'project_id',
            //'project_budget_line_id',
            //'costcenter_id',
            //'program_id',
            //'locationdescription_id',
            //'ho_comment',
            //'tds',
            //'advance',
            //'net',
            //'refnumber',
            //'refdate',
            //'create_at',
            //'update_at',
            //'active',

            //['class' => 'yii\grid\ActionColumn'],
            [
                'header' => 'Action',
                'headerOptions' => [
                'style' => 'color:#3c8dbc'],
                'content' => function($data) {
                $deleteUrl = Url::to(["delete", "id" => $data->id]);
                $viewUrl = Url::to(["view", "id" => $data->id]);
                if($data->request_type=='Other Expenses'){
                    $updateUrl = Url::to(["updateother", "id" => $data->id]);
                }elseif($data->request_type=='Local Conveyance'){
                    $updateUrl = Url::to(["update", "id" => $data->id]);
                }elseif($data->request_type=='Travel Expenses'){
                    $updateUrl = Url::to(["updatetravel", "id" => $data->id]);
                }else{
                    $updateUrl = Url::to(["updateother", "id" => $data->id]);
                }
              
                $USERAUTH=new CheckAuth2;
                   //if($data->state_id==){           }
                if($USERAUTH->Checkuser($_SESSION['login_info']['username'])=='EMP'){
                    $return =" <a role='menuitem' tabindex='-1' title='View' aria-label='View'  href='{$viewUrl}'><span class='glyphicon glyphicon glyphicon-eye-open'></span></a>";
                   if($data->id==8){
                   // echo $data->state_id;exit;
                   }
                    if($data->state_id==1 or $data->state_id==2){
                        if(Return_only_ho($data->id)){
                            $return.="<a role='menuitem' tabindex='-1' title='Update' aria-label='Update'  href='{$updateUrl}'><span class='glyphicon glyphicon glyphicon-pencil'></span></a>";
                        }
                    }
                }
                elseif($USERAUTH->Checkuser($_SESSION['login_info']['username'])=='RO'){
                    $return =" <a role='menuitem' tabindex='-1' title='View' aria-label='View'  href='{$viewUrl}'><span class='glyphicon glyphicon glyphicon-eye-open'></span></a>";
                    if($data->state_id==2){
                        $return.="<a role='menuitem' tabindex='-1' title='Take Action' aria-label='Update'  href='{$updateUrl}'><span class='glyphicon glyphicon glyphicon-pencil'></span></a>";
                    }
                }
                elseif($USERAUTH->Checkuser($_SESSION['login_info']['username'])=='HO'){
                    $return =" <a role='menuitem' tabindex='-1' title='View' aria-label='View'  href='{$viewUrl}'><span class='glyphicon glyphicon glyphicon-eye-open'></span></a>";
                    if($data->state_id==3){
                        $return.="<a role='menuitem' tabindex='-1' title='Take Action' aria-label='Update'  href='{$updateUrl}'><span class='glyphicon glyphicon glyphicon-pencil'></span></a>";
                       // $return.="<a role='menuitem' tabindex='-1' id='delwithcnfm' title='Delete' data-method='post' aria-label='Delete' href='".Url::to(["delete", "id" => $data->id])."'  data-id = ".$data->id." class = 'atrData'><span class='glyphicon glyphicon-trash'></span></a>";
                    }
                }elseif($USERAUTH->Checkuser($_SESSION['login_info']['username'])=='AC'){
                    $return =" <a role='menuitem' tabindex='-1' title='View' aria-label='View'  href='{$viewUrl}'><span class='glyphicon glyphicon glyphicon-eye-open'></span></a>";
                    if($data->state_id==4){
                        $return.="<a role='menuitem' tabindex='-1' title='Take Action' aria-label='Update'  href='{$updateUrl}'><span class='glyphicon glyphicon glyphicon-pencil'></span></a>";
                        }
                }


              /*  $return =" <a role='menuitem' tabindex='-1' title='View' aria-label='View'  href='{$viewUrl}'><span class='glyphicon glyphicon glyphicon-eye-open'></span></a>";
               if($USERAUTH->Checkuser($_SESSION['login_info']['username'])!='AC'){
                $return.="<a role='menuitem' tabindex='-1' title='Update' aria-label='Update'  href='{$updateUrl}'><span class='glyphicon glyphicon glyphicon-pencil'></span></a>";
               }
               if($USERAUTH->Checkuser($_SESSION['login_info']['username'])=='HO'){
                $return.="<a role='menuitem' tabindex='-1' title='Delete' data-method='post' aria-label='Delete'  data-id = ".$data->id." class = 'atrData'><span class='glyphicon glyphicon-trash'></span></a>";
               }*/
                return  $return;
            }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<script>
$('#delwithcnfm').click(function(){
    return confirm('Are you sure you want to delete this item?');
});

</script>