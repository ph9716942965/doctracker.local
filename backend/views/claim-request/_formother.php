<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\ProjectBudgetLine;
use backend\models\Program;
use backend\models\Locationdescription;
use backend\models\FundingAgency;
$lu=$_SESSION['login_info']['username'];
/*
$im= \backend\models\CostCentre::find()->asArray()->where(["id"=>1])->one();

    echo "314<pre>";print_r($im['name']);exit; */
/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-request-form">
<ul class="nav nav-tabs" style="margin-bottom: 10px;">
        <li ><a class="custom-control-label" for="radio" onclick="return confirm('Are you sure ? Data will be lost');"  href="<?=Url::toRoute('claim-request/create')?>">Local Conveyance</a></li>
        <li><a class="custom-control-label" for="radio" onclick="return confirm('Are you sure ? Data will be lost');"  href="<?=Url::toRoute('claim-request/createtravel')?>">Travel Expenses</a></li>
        <li class="active"><a class="custom-control-label" for="radio"  href="#">Other Expenses</a></li>
</ul>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   
    <div class="row" >
        <div class="col-md-3">
        
        <?php 
            if(Authstatus($_SESSION['login_info']['username'])==1){
               // echo $form->field($model, 'user_id')->textInput(['readonly'=>true]);?>
               <div class="form-group field-claimrequest-user_id required">
	<label class="control-label" for="claimrequest-user_id">Employee Code</label>
	<input type="text" id="claimrequest-user_id" class="form-control"  value="<?= emp_name($model->user_id) ?>" readonly="true" >
</div>
       <?php }else{
           $emp= child(Authid($_SESSION['login_info']['username']));
           echo $form->field($model, 'user_id')->DropdownList(ArrayHelper::map($emp,'id','username'));
        }
        ?>
        
        </div>
        <div class="col-md-3"> <?= $form->field($model, 'date')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax",'required'=>true]) ?> </div>
  
        </div>
    
   
 
   <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'amount')->textInput(['maxlength' => true,'onkeyup'=>'ajaxamount2word()','type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'amountinword')->textInput(['maxlength' => true,'readonly'=>true]) ?> </div>
   <div class="col-md-6"><?= $form->field($model, 'purpose')->textarea(['maxlength' => true]) ?> </div>
   </div>


   
   <?php /*******************RO SECTION********* */?>
   <?php if(Authstatus($_SESSION['login_info']['username'])==2||Authstatus($_SESSION['login_info']['username'])==3 || Authstatus($_SESSION['login_info']['username'])==4){ ?>
      
     <?php include_once('_ROsecinput.php'); ?>
  <?php /*
<div class="row">
   <div class="col-md-4"><?= $form->field($model, 'fund_agency')->DropdownList(ArrayHelper::map(FundingAgency::find()->all(),'id','name'),['prompt'=>'Select Funding Agency']) ?> </div>
   <div class="col-md-4"> <?= $form->field($model, 'nature_service')->textInput(['maxlength' => true]) ?> </div>
</div>
<div class="row">
   <div class="col-md-8"> <?= $form->field($model, 'ro_comment')->textarea(['maxlength' => true]) ?> </div>
</div>
*/ ?>

   <?php } ?>
  <?php ///////END RO SECTION////?>

  <?PHP //////// HO SECTION ///////?>
  <?php if(Authstatus($_SESSION['login_info']['username'])==3 || Authstatus($_SESSION['login_info']['username'])==4){ ?>
  <?php 
  require_once('_HOSECTION.php');
    ?>

  <?php }?>
   
   <?php //***********Accounts Section************ */ ?>

<?php if(Authstatus($_SESSION['login_info']['username'])==4){ ?>

 <div class="row">
   <div class="col-md-2"><?= $form->field($model, 'tds')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'advance')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"><?= $form->field($model, 'net')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'refnumber')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'refdate')->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax",'required'=>true]) ?>
 </div>
   </div>
<?php }?>
  
  

   <div class="row">
   <div class="col-md-3">
   <?= $form->field($model, 'imageFile[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
  <?php /*
   <?= $form->field($model, 'imageFile2[]')->fileinput() ?>
   <?= $form->field($model, 'imageFile3[]')->fileinput() ?>
   <?= $form->field($model, 'imageFile4[]')->fileinput() ?>
   <?= $form->field($model, 'imageFile5[]')->fileinput() ?>*/?>


   
   </div>
   </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
<?php //echo "<pre>";print_r($model);exit; ?>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
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