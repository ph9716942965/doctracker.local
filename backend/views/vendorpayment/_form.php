<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\FundingAgency;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Project;
use kartik\depdrop\DepDrop;
use backend\models\CostCentre;
use backend\models\CostCentreSub;
use backend\models\Program;
use backend\models\Locationdescription;
use backend\models\Vendor;
use backend\models\FundingAgencyBu;
$USERAUTH=new CheckAuth2($_SESSION['login_info']['username']);
?>

<div class="vendorpayment-form">
    <?php $form = ActiveForm::begin(); ?>
  <?php  if($USERAUTH->Checkuser()=='HO' || $USERAUTH->Checkuser()=='RO' || $USERAUTH->Checkuser()=='AC'){ ?>
    <div class="card">   
<?php if(($model->isNewRecord == false) && $USERAUTH->Checkuser()!='RO'){?>
	<div class="row" >
    <?= field_gen(backend\models\User::get_empname($model->user_id),'Employee Code') ?>
    <?= field_gen( $model->vendor_id,'Vendor') ?>
    <?= field_gen($model->service_by,'Service By') ?>
    <?= field_gen($model->amount,'Amount') ?>
    <?= field_gen($model->purpose,'Purpose') ?>
    <?= field_gen($model->project_id,'Project Id') ?>
	</div>
<?php }else{ ?>
	<div class="row" >
    <div class="col-md-4">
    <div class="form-group field-claimrequest-user_id required">
	<label class="control-label" for="claimrequest-user_id">Employee Code</label>
	<input type="text" id="claimrequest-user_id" class="form-control"  value="<?= backend\models\User::get_empname($model->user_id) ?>" readonly="true" >
	</div> 
    <?php // $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?> </div>
        <div class="col-md-4">
        <label class="control-label" for="claimrequest-vendor_id">Vendor</label>
   <?= Select2::widget([
    'name' => 'VendorPayment[vendor_id]',
   'data' => ArrayHelper::map(Vendor::find()->where(['status' => 1])->all(),'id','name_unit'),
    'value' => $model->vendor_id,
    'options' => ['placeholder' => 'Select vendor ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>
        </div>
        <div class="col-md-4"> <?= $form->field($model, 'service_by')->textInput() ?> </div> 
    </div>

    <div class="row" >
    <div class="col-md-4"> <?= $form->field($model, 'amount')->textInput(['type' => 'number','min'=>0, 'oninput'=>"validity.valid||(value='');"]) ?> </div>
    <div class="col-md-4"><?= $form->field($model, 'purpose')->textInput() ?> </div>
    <div class="col-md-4"> <?= $form->field($model, 'project_id')->DropdownList(ArrayHelper::map(Project::find()->all(),'id','name'),['id'=>'cat-id','prompt'=>'Select Project']) ?>	
    </div>
    </div>
<?php } ?>

    <div class="row" >
    <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
			<?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='RO')?$form->field($model, 'imageFile')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
            <?php //$form->field($model, 'imageFile')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[upload_approval]" value="<?php echo $model->upload_approval; ?>" >
                                <br/>
                                <?php if (!empty($model->upload_approval)) { ?>
                                    <a title="Download" href="<?php echo $model->upload_approval; ?>"><img src="<?php echo $model->upload_approval; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
    <div class="col-md-4">
            <div style="border:1px dotted darkblue;padding: 10px">
			<?php 
			echo ($model->isNewRecord || $USERAUTH->Checkuser()=='RO')?$form->field($model, 'imageFile2')->fileInput(['multiple' => false, 'accept' => 'image/*']):"";
			?>
			<?php // $form->field($model, 'imageFile2')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
                <?php if ($model->isNewRecord == false) { ?>
                                <input type="hidden" name="ClaimRequest[upload_bill]" value="<?php echo $model->upload_bill; ?>" >
                                <br/>
                                <?php if (!empty($model->upload_bill)) { ?>
                                    <a title="Download" href="<?php echo $model->upload_bill; ?>"><img src="<?php echo $model->upload_bill; ?>" height="70" width="70" ></a>
                <?php } } ?>
        </div>
    </div>
    
    </div>
</div>
<?php }?>
    <?php // $form->field($model, 'vendor_id')->textInput() ?>
    
<!-------------------- HO SEC --------------------->     
<!------------------------------------------------->
<?php 
if(($USERAUTH->Checkuser()=='HO' || $USERAUTH->Checkuser()=='AC') /*&& $model->isNewRecord*/){ ?>
<?= $USERAUTH->Checkuser()=='HO'?'<div id="approve" >':'<div id="hosec" >' ?>
<div class="card"> 
<?php if(($model->isNewRecord == false) && $USERAUTH->Checkuser()!='HO'){?>
<div class="row" >
	<?= field_gen( $model->program_id,'Program') ?>
	<?= field_gen( $model->funding_agency_id,'Funding Agency') ?>
	<?= field_gen( $model->funding_agency_bu_id,'BU') ?>
	<?= field_gen( $model->cost_center_id,'cost_center_id') ?>
	<?= field_gen( $model->cost_centre_sub,'Cost Center Sub') ?>
	<?= field_gen( $model->lo,'LO') ?>
	<?= field_gen( $model->comment_ho,'HO Comment') ?>
</div>
<?php }else{?> 
    <div class="row" >
        <div class="col-md-4"><?= $form->field($model, 'natural_head')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4">
        <label class="control-label" for="VendorPayment-program_id">Program</label>
   <?= Select2::widget([
    'name' => 'VendorPayment[program_id]',
    'id'=>'mySelect2',
    'data' => ArrayHelper::map(Program::find()->all(),'id','name'),
    'value'=>$model->isNewRecord?false:$model->program_id,
    'options' => ['placeholder' => 'Select program ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>
        </div>
        <div class="col-md-4">
        <label class="control-label" for="VendorPayment-fund_agency">Funding Agency</label>
   <?= Select2::widget([
    'name' => 'VendorPayment[funding_agency_id]',
    'id'=>'jsfai',
    'data' => ArrayHelper::map(FundingAgency::find()->all(),'id','name'),
    'value'=>$model->isNewRecord?false:$model->funding_agency_id,
    'options' => ['placeholder' => 'Select Funding Agency ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>
</div>
    </div>
    <div class="row" >
        <div class="col-md-4">
        <label class="control-label" for="VendorPayment-funding_agency_bu_id">BU</label>
   <?= Select2::widget([
    'name' => 'VendorPayment[funding_agency_bu_id]',
    'id'=>'jsfabi',
    //'data' =>$model->isNewRecord?false:ArrayHelper::map(FundingAgencyBu::find()->select('id,name')->where(['id'=>$model->funding_agency_bu_id])->asArray()->all()),
    'value'=>$model->isNewRecord?false:$model->funding_agency_bu_id,
    'options' => ['placeholder' => 'Select funding Agency Bu ...'],
    'pluginOptions' => [
        'allowClear' => false
    ],
]) ?>
        </div>
        <div class="col-md-4">
        <label class="control-label" for="VendorPayment-cost_center_id">Cost Centre</label>
   <?= Select2::widget([
    'name' => 'VendorPayment[cost_center_id]',
    'id'=>'cost_center_id',
    'data' => ArrayHelper::map(CostCentre::find()->all(),'id','name'),
    'value'=>$model->isNewRecord?false:$model->cost_center_id,
    'options' => ['placeholder' => 'Select Cost Centre ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>
        </div>
        <div class="col-md-4">
        <label class="control-label" for="VendorPayment-cost_centre_sub">Cost Center Sub</label>
   <?= Select2::widget([
    'name' => 'VendorPayment[cost_centre_sub]',
    'id'=>'cost_centre_sub',
   // 'data' =>$model->isNewRecord?ArrayHelper::map(CostCentreSub::find()->select('id,name')->where(['id'=>$model->cost_centre_sub])->asArray()->all()),
    'value'=>$model->isNewRecord?false:$model->cost_centre_sub,
    'options' => ['placeholder' => 'Select cost Center Sub...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]) ?>
        </div>
    </div>
    <div class="row" >
        <div class="col-md-4">
        <?= $form->field($model, 'lo',[
                    'template' => "<b>LO</b>\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'your_custom_class_name' ]])
                    ->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-8">
        <?= $form->field($model, 'comment_ho',[
                    'template' => "<b>HO Comment</b>\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'your_custom_class_name' ]])
                    ->textarea(['maxlength' => true]) ?>

        </div>
      
    </div>
	<?php }?>
</div>
 </div>
<?php }?>  

<?php //include_once('_HOApproval.php'); ?>
    <?php
/***********************
 * 
    **  AC FORM **
 * 
 ***********************/
    ?> 
    <?php 
 if ($model->isNewRecord == false && $USERAUTH->Checkuser()=='AC') { ?>
 <?= $USERAUTH->Checkuser()=='AC'?'<div id="approve" >':'<div id="acsec" >' ?>
<div class="card">  
    <div class="row" >
        <div class="col-md-4">
        <?= $form->field($model, 'cv_ref',[
                    'template' => "<b>CV Refrence</b>\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'your_custom_class_name' ]])
                    ->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'cr_date',[
                    'template' => "<b>CR Date</b>\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'your_custom_class_name' ]])
                    ->textInput(['maxlength' => true,"class" => "form-control datePickerTodayMax"]) ?>
        </div>
        <div class="col-md-4">
        <?= $form->field($model, 'comment_ac',[
                    'template' => "<b>Accountant Comment</b>\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'your_custom_class_name' ]])
                    ->textarea(['maxlength' => true]) ?>
        </div>
    </div>
   </div>
</div>
        <?php } ?>  
   
  <?php  echo '<script type="text/javascript">
    $(document).ready(function(){
        //$("#rosec").hide();
        //$("#hosec").hide();
        $("#approve").hide();
        $("#submit").hide();
    });
    </script>';
 ?>
    <div class="form-group">
    <button id="apbtn" class="btn btn-success">Approve</button>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success','id'=>'submit']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#apbtn").click(function(){
        $("#approve").show(1000);
        $("#apbtn").hide();
        $("#submit").show(1000);
    });
    $('#jsfabi').val('1');
   // $('#jsfai').val('2');
    var d="<?php (ArrayHelper::map(CostCentreSub::find()->all(),'id','name'));?>";
   /* $('#jsfai').select2({
        //dataType: 'json',
        data: [{"id": 4,"text": "Option 2.2"}]
    });*/
    $('#cost_center_id').on('select2:select', function (e) {
        let value ='<?= json_encode(CostCentreSub::find()->select(["id","name as text"])->asArray()->all()); ?>';
        $('#cost_centre_sub').select2({
        data: JSON.parse(value)
    });
});
    $('#jsfai').on('select2:select', function (e) {
        $.ajax({
             url: '<?php echo Url::to(["vendorpayment/ajax"]); ?>',
             type: 'post',
             data: {  
                jsfabi : document.getElementById("jsfai").value,
                // _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
             },
             success: function (value) {
                $("#jsfabi").select2({data: JSON.parse(value)});
                console.log(value)
             },
             error: function (jsonResponse) {
                 console.log(jsonResponse);  
             }
         });
        /*let value ='<?= json_encode(CostCentreSub::find()->select(["id","name as text"])->where(["id"=>'+document.getElementById("jsfai").value+'])->asArray()->all()); ?>';
        $('#jsfabi').select2({
        data: JSON.parse(value)*/
    });
       // var data = $('#jsfai').val() ;
  //alert(data);
});

function js_FundingAgencyBu(){
    return "<?php ArrayHelper::map(FundingAgencyBu::find()->all(),'id','name') ?>";
}

</script>