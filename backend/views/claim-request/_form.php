<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\FundingAgency;
use backend\models\CostCentre;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="claim-request-form">
<ul class="nav nav-tabs"  style="margin-bottom: 10px;">
        <li class="active"><a class="custom-control-label" for="radio"  <?php //Url::toRoute('claim-request/create')?>>Local Conveyance</a></li>
        <li><a class="custom-control-label" for="radio" onclick="return confirm('Are you sure ? Data will be lost');" href="<?=Url::toRoute('claim-request/createtravel')?>">Travel Expenses</a></li>
        <li ><a class="custom-control-label" for="radio" onclick="return confirm('Are you sure ? Data will be lost');"  href="<?=Url::toRoute('claim-request/createother')?>">Other Expenses</a></li>
</ul>
<div class="row">
<div class="col-md-12" >
<div id="flashmessage"></div>

</div>
</div>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   
    <div class="row">
        <div class="col-md-2">
        <?php 
            if(Authstatus($_SESSION['login_info']['username'])==1){ ?>
<div class="form-group field-claimrequest-user_id required">
	<label class="control-label" for="claimrequest-user_id">Employee Code</label>
	<input type="text" id="claimrequest-user_id" class="form-control"  value="<?= emp_name($model->user_id) ?>" readonly="true" >
</div> 
              
     <?php   }else{
           $emp= child(Authid($_SESSION['login_info']['username']));
           echo $form->field($model, 'user_id')->DropdownList(ArrayHelper::map($emp,'id','username'));
        }
        ?>
       
        </div>
        </div>
   
    <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'visit_from')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'visit_to')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-3">
   <?= $form->field($model, 'mode')->DropdownList(['Auto'=>'Auto','Cab'=>'Cab','Other'=>'Other']) ?>
   <?php // $form->field($model, 'mode')->textInput(['maxlength' => true]) ?></div>
   <div class="col-md-3">
   
   <?= $form->field($model, 'date')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax"]) ?>
   <?php
/* $form->field($model, 'date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose'=>true
    ]
]);
*/
?>
   
   <?php // $form->field($model, 'date')->textInput() ?></div>
   </div>
   <?php /*
   <div class="row">
   <div class="col-md-2"><?= $form->field($model, 'amount2')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'amount3')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"><?= $form->field($model, 'amount4')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'amount5')->textInput(['maxlength' => true]) ?> </div>
   </div>
*/ ?>
   <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'amount')->textInput(['maxlength' => true,'onkeyup'=>'ajaxamount2word()','type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'amountinword')->textInput(['maxlength' => true,'readonly'=>true]) ?> </div>
   <div class="col-md-6"><?= $form->field($model, 'purpose')->textarea(['maxlength' => true]) ?> </div>
   </div>

   <div class="row">
    </div>
   
   <?php /*******************RO SECTION********* */?>
   <?php if(Authstatus($_SESSION['login_info']['username'])==2||Authstatus($_SESSION['login_info']['username'])==3 || Authstatus($_SESSION['login_info']['username'])==4){ ?>
  <?php include_once('_ROsecinput.php'); ?>
    <!--<div class="row">-->

    <?php

//$FundingAgency = ArrayHelper::map(FundingAgency::find()->all(),'id','name');

/*
   <div class="col-md-4">
   <label class="control-label" for="claimrequest-fund_agency">Funding Agency</label>
   <?= Select2::widget([
    'name' => 'fund_agency',
    'data' => $FundingAgency,
    //'size' => Select2::SMALL,
    'options' => ['placeholder' => 'Select Funding Agency ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); */ ?>
   
   
   <?php // $form->field($model, 'fund_agency')->DropdownList($FundingAgency,['prompt'=>'Select Funding Agency']) ?> </div>
 <?php /* <div class="col-md-4"> <?= $form->field($model, 'nature_service')->textInput(['maxlength' => true]) ?> </div>
   </div>
   <div class="row">
   <div class="col-md-8"> <?= $form->field($model, 'ro_comment')->textarea(['maxlength' => true]) ?> </div>
   </div>
*/ ?>
   <?php } ?>
  <?php ///////END RO SECTION////?>

  <?PHP //////// HO SECTION ///////?>
  <?php if(Authstatus($_SESSION['login_info']['username'])==3 || Authstatus($_SESSION['login_info']['username'])==4){ ?>
  
<?php include_once('_HOsecinput.php');?>

  <?php }?>
   
   <?php //***********Accounts Section************ */?>
<?php if(Authstatus($_SESSION['login_info']['username'])==4){ ?>

 <div class="row">
   <div class="col-md-4"><?= $form->field($model, 'tds')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-4"> <?= $form->field($model, 'advance')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-4"><?= $form->field($model, 'net')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'refnumber')->textInput(['maxlength' => true]) ?> </div>
   
   <div class="col-md-4">
   
   <?= $form->field($model, 'refdate')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax",'required'=>true]) ?>

    <?php /* $form->field($model, 'refdate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose'=>true
    ]
]);*/ ?> </div>
   </div>
<?php }?>
  
  

   <div class="row">
   <div class="col-md-3">
   <!--<input name="file" id="file" size="27" type="file" /><br />-->
   <?= $form->field($model, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
   <?php /*<?= $form->field($model, 'imageFile2[]')->fileinput() ?>
   <?= $form->field($model, 'imageFile3[]')->fileinput() ?>
   <?= $form->field($model, 'imageFile4[]')->fileinput() ?>
   <?= $form->field($model, 'imageFile5[]')->fileinput() ?> */?>


   
   </div>
   </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
        <?php // Html::Button('Add more', ['class' => 'btn btn-success','id'=>'addmore','onclick'=>'add_more()']) ?>
    </div>
    <?php
   /* $USERAUTH=new CheckAuth2($_SESSION['login_info']['username']);

    if($USERAUTH->Checkuser()=='EMP'){
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
    }  */
?>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
function init() {
	document.getElementById('file').onchange=function() {
		document.getElementById('file').target = 'upload_target'; //'upload_target' is the name of the iframe
	}
}
function add_more(){
   
    var user_id=$("#claimrequest-user_id").val();
    var visit_from=$("#claimrequest-visit_from").val();
    var visit_to=$("#claimrequest-visit_to").val();
    var mode=$("#claimrequest-mode").val();
    var date =$("#claimrequest-date").val();
    var amount=$("#claimrequest-amount").val();
    var amountinword=$("#claimrequest-amountinword").val();
    var purpose=$("#claimrequest-purpose").val();
    var ref='tes';
    if(visit_from != '' && visit_to!='' && mode!='' && date!='' && amount!='' && amountinword!='' && purpose!=''){
        $.ajax({

        });
    }else{
        $("#flashmessage").html('<div class="alert alert-danger" role="alert"><strong>Please !</strong> please fill all mandatory fields and try submitting again.</div>');
    }
   
}
function ajaxamount2word(){
        
        var rupe = document.getElementById("claimrequest-amount").value;
        // var reqid = document.getElementById("claim_id").value;
        //alert(rupe);
         if(rupe==''){
            $('#claimrequest-amountinword').val('zero');
         }else{
           // $('#claimrequest-amountinword').val('zero');
            //alert(rupe);
         //console.log("Co2",year)
         $.ajax({
             url: '<?php echo Url::to(["site/num2word"]); ?>',
             type: 'post',
             data: {
                
                rupe : rupe,
                // _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
             },
           
             success: function (data) {
                $("#claimrequest-amountinword").val(data)
                console.log(data)
             },
             error: function (jsonResponse) {
                 console.log(jsonResponse);
                 
             }
         });
         }
     }
     </script> 
