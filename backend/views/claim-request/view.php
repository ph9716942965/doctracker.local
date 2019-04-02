<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\ProjectBudgetLine;
use backend\models\Program;
use backend\models\Locationdescription;

if ($model->request_type == 'Other Expenses') {
    $updateUrl = Url::to(["updateother", "id" => $model->id]);
} elseif ($model->request_type == 'Local Conveyance') {
    $updateUrl = Url::to(["update", "id" => $model->id]);
} elseif ($model->request_type == 'Travel Expenses') {
    $updateUrl = Url::to(["updatetravel", "id" => $model->id]);
} else {
    $updateUrl = Url::to(["updateother", "id" => $model->id]);
}


/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Claim Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-request-view">
    <?= Yii::$app->CommonHtml->goBack(\yii\helpers\Url::to(["index"])); ?>
    <h1><?php //Html::encode($this->title)   ?> </h1>
    <p>


        <!----------------------------------------------------------->
        <?php
        $USERAUTH = new CheckAuth2($_SESSION['login_info']['username']);

        /* if($USERAUTH->Checkuser()=='EMP'){
          if($model->state_id==1 or $model->state_id==2){
          //echo "<a href=".$updateUrl.'" class="btn btn-lg btn-success">Update</a>"';
          }
          }elseif($USERAUTH->Checkuser()=='RO'){
          if($model->state_id==2){
          //echo "<a href=".$updateUrl.' class="btn btn-lg btn-success">Approve</a>"';
          //include_once('_formreturnEMP.php');
          }
          }elseif($USERAUTH->Checkuser()=='HO'){
          if($model->state_id==3){
          echo "<a href=".$updateUrl.' class="btn btn-lg btn-success">Approve</a>"';
          include_once('_formreturnRO.php');
          } echo Html::a('Delete', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
          'confirm' => 'Are you sure you want to delete this item?',
          'method' => 'post',
          ],
          ]);
          }elseif($USERAUTH->Checkuser()=='AC'){
          if($model->state_id==4){
          echo "<a href=".$updateUrl.' class="btn btn-lg btn-success">Approve</a>';
          include_once('_formreturnHO.php');
          }
          } */


        /*
          if($USERAUTH->Checkuser()=='AC'){
          include_once('_formreturnHO.php');
          }elseif($USERAUTH->Checkuser()=='HO'){
          include_once('_formreturnRO.php');
          echo Html::a('Delete', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
          'confirm' => 'Are you sure you want to delete this item?',
          'method' => 'post',
          ],
          ]);

          } */
//elseif($USERAUTH->Checkuser()=='RO'){
        //  include_once('_formreturnEMP.php');
//}
//ToHoReturn();
        ?>

        <!------------------------------------------>

        <?php //Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])  ?>

        <?php //Html::a('Approve', ['update', 'id' => $model->id], ['class' => 'btn btn-success'])  ?>
        <?php if ($USERAUTH->Checkuser() != 'EMP') { ?>
                <!--<a href="<?php // $updateUrl    ?>" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-thumbs-up"></span>Approve</a>
            -->
        <?php } else { ?>
                   <!--<a href="<?php // $updateUrl    ?>" class="btn btn-lg btn-success">Update</a> -->

        <?php } ?>
        <?php /* <?= Html::a('Delete', ['delete', 'id' => $model->id], [
          'class' => 'btn btn-danger',
          'data' => [
          'confirm' => 'Are you sure you want to delete this item?',
          'method' => 'post',
          ],
          ]) ?> */ ?>
    </p>



    <?php
    DetailView::widget([
        'model' => $model,
        'attributes' => [

            [ 'format' => 'html',
                'label' => 'disc',
                'attribute' => 'rep_link',
                'filter' => ['1' => 'text', '2' => 'jpg'], //with custome sarch
                'value' => function ($data) {
            return '<SMALL>' . $data->user_id . '</SMALL>';
        }
            ],
        //'id',
        //'user_id',
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
        //'active'
        ],
    ])
    ?>

</div>
<div class="claim-request-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php // $USERAUTH=new CheckAuth2($_SESSION['login_info']['username']);  ?>
    <div class="card">
        <fieldset>
            <legend>Employee Form:</legend>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group field-claimrequest-user_id required">
                        <label class="control-label" for="claimrequest-user_id">Employee Code</label>
                        <input type="text" id="claimrequest-user_id" class="form-control"  value="<?= emp_name($model->user_id) ?>" readonly="true" >
                    </div> 
                </div>
                <?php /*  <div class="col-md-2"> <?= $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?> </div> */ ?>
                <div class="col-md-3"><?= $form->field($model, 'request_type')->textInput(['readonly' => true]) ?></div>
                <div class="col-md-3"><?= $form->field($model, 'date')->textInput(['readonly' => true]) ?></div>
                
              <?php  if($model->dc){ echo '<div class="col-md-3">'.$form->field($model, 'dc')->textInput(['readonly' => true]).'</div>'; } ?>
            
           
           <?php if($model->request_type!='Other Expenses'){ ?>
		    
            <div class="col-md-3"><?= $form->field($model, 'visit_from')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-3"> <?= $form->field($model, 'visit_to')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-3"><?= $form->field($model, 'mode')->textInput(['readonly' => true]) ?></div>
            
		   <?php } ?>
           
                 <?php //if($model->amount2!='' || $model->amount2!='0' or $model->amount2!=0) {  echo "<pre>";print_r($model->amount2);exit; ?>
           <?php  if($model->amount2){ ?>         
           
                <div class="col-md-3"><?= $form->field($model, 'amount2')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-3"> <?= $form->field($model, 'amount3')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-3"><?= $form->field($model, 'amount4')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-3"> <?= $form->field($model, 'amount5')->textInput(['readonly' => true]) ?> </div>
            
           <?php } ?>
		  
           
                <div class="col-md-3"><?= $form->field($model, 'amount')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-3"> <?= $form->field($model, 'amountinword')->textInput(['readonly' => true]) ?> </div>
                <div class="col-md-6"><?= $form->field($model, 'purpose')->textarea(['readonly' => true]) ?> </div>
          </div>

        </fieldset>
    </div>
    <?php /*     * *****************RO SECTION********* */ ?>

    <?php if (Authstatus($_SESSION['login_info']['username']) == 2 || Authstatus($_SESSION['login_info']['username']) == 3 || Authstatus($_SESSION['login_info']['username']) == 4) { ?>
        <?php if ($model->fund_agency != '') { ?>
            <div class="card">
                <fieldset>
                    <legend>RO Form:</legend>
                    <div class="row">
        <div class="col-md-4">
            <label class="control-label" for="claimrequest-fund_agency">Funding Agency</label>
            <input type="text" id="claimrequest-fund_agency" class="form-control" name="ClaimRequest[fund_agency]" value="<?= fundagency_name($model->fund_agency) ?>" readonly="" aria-required="true" aria-invalid="false">
        </div>
                        <?php // $form->field($model, 'fund_agency')->textInput(['readonly' => true]) ?>
                        <div class="col-md-4"> <?= $form->field($model, 'nature_service')->textInput(['readonly' => true]) ?> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8"> <?= $form->field($model, 'ro_comment')->textarea(['readonly' => true]) ?> </div>
                    </div>
                </fieldset>
            </div>
        <?php
        }
    }
    ?>
    <?php ///////END RO SECTION////   ?>

    <?PHP //////// HO SECTION ///////?>
    <?php if (Authstatus($_SESSION['login_info']['username']) == 3 || Authstatus($_SESSION['login_info']['username']) == 4) { ?>
    <?php if ($model->naturehead != '') { ?>
            <div class="card">
                <fieldset>
                    <legend>HO Form:</legend>
        <div class="row">
        <div class="col-md-4"> <?= $form->field($model, 'naturehead')->textInput(['readonly' => true]) ?> </div>
                       
        <div class="col-md-4">
            <label class="control-label">Project</label>
            <input type="text"  class="form-control"  value="<?= project_name($model->project_id) ?>" readonly="" aria-required="true" aria-invalid="false">  
        </div>
        <div class="col-md-4">
            <label class="control-label" >Project Budget Line</label>
            <input type="text" class="form-control" value="<?= project_budget_line_name($model->project_budget_line_id) ?>" readonly="" aria-required="true" aria-invalid="false">  
        </div>
        </div>
        <div class="row">
       <div class="col-md-4">
            <label class="control-label" >Costcenter</label>
            <input type="text"  class="form-control" value="<?= costcentersub_name($model->costcenter_id) ?>" readonly="" aria-required="true" aria-invalid="false">  
        </div>
        <div class="col-md-4">
            <label class="control-label" >Program</label>
            <input type="text" class="form-control"  value="<?= program_name($model->program_id) ?>" readonly="" aria-required="true" aria-invalid="false">  
        </div> 
       <div class="col-md-4">
            <label class="control-label" >Location Description</label>
            <input type="text" class="form-control"  value="<?= locationdescription_name($model->locationdescription_id) ?>" readonly="" aria-required="true" aria-invalid="false">  
        </div>          
        </div>            
                    <div class="row">
                        <div class="col-md-8"><?= $form->field($model, 'ho_comment')->textarea(['readonly' => true]) ?> </div>
                    </div>
                </fieldset>
            </div>
        <?php
        }
    }
    ?>

    <?php //***********Accounts Section************ */?>
<?php // if(Authstatus($_SESSION['login_info']['username'])==4){    ?>
<?php if ($model->tds != '') { ?>
        <div class="card">
            <fieldset>
                <legend>Accountant Form:</legend>
                <div class="row">
                    <div class="col-md-2"><?= $form->field($model, 'tds')->textInput(['readonly' => true]) ?> </div>
                    <div class="col-md-2"> <?= $form->field($model, 'advance')->textInput(['readonly' => true]) ?> </div>
                    <div class="col-md-2"><?= $form->field($model, 'net')->textInput(['readonly' => true]) ?> </div>
                    <div class="col-md-2"> <?= $form->field($model, 'refnumber')->textInput(['readonly' => true]) ?> </div>
                    <div class="col-md-2"> <?= $form->field($model, 'refdate')->textInput(['readonly' => true]) ?> </div>
                </div>
            </fieldset>
        </div>
<?php } ?>

   <div class="card"> <div class="row"><div class="col-md-12"><?= uploads($model->id) ?></div></div>
    <div class="row">

    </div>
    </div>
   

<?php ActiveForm::end(); ?>
