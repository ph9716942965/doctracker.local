<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendor-form">

    <?php $form = ActiveForm::begin(['options' => ['onsubmit' => 'validationFamilyDetails()']]); ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Vendor Details:</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <?=$form->field($model, 'ro_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Ro::find()->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select']); ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'vendor_no')->textInput(['maxlength' => true]); ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'name_unit')->textInput(['maxlength' => true]); ?>
                </div>
                <div class="col-md-3">
                    <?php echo $form->field($model, 'vendor_type')->dropDownList(dropdownVendorType(), ['prompt' => 'Select']);
?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">

                    <?php // $form->field($model, 'applicability')->radio(['label' => 'Individuals', 'value' => 0,])?>
                    <?php // $form->field($model, 'applicability')->radio(['label' => 'Company', 'value' => 1,])?>
                    <?php
$model->isNewRecord == 1 ? $model->applicability = 0 : $model->applicability;
echo $form->field($model, 'applicability')->radioList(
    [
        0 => 'Individuals',
        1 => 'Company',
    ], ['id' => 'applicability']);
?>
                    <!--                    Individuals
                                        Company-->
                </div>
            </div>
            <!--Individuals-->
            <div class="row">
                <div class="col-md-3">
                    <?=$form->field($model, 'salutation')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'nationality')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'email_id')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'district_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\District::find()->where(['status' => 1])->all(), 'id', 'district_name'), ['prompt' => 'Select']); ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'first_name')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'address')->textarea(['rows' => 1]); ?>
                    <?=$form->field($model, 'contact_no')->textInput(['maxlength' => true]); ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'middle_name')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'pan_no')->textInput(['maxlength' => true]); ?>
                    <?php if ($model->isNewRecord == false) {
    $model->country_id = getCountryId($model->district_id)['country_id'];
} ?>    
                    <?= $form->field($model, 'country_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Country::find()->where(['status' => 1])->all(), 'id', 'country_name'), ['prompt' => 'Select', 'onchange' => 'getSateData()']); ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'last_name')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'pincode')->textInput(); ?>
                    <?php if ($model->isNewRecord == false) {
    $model->state_id = getCountryId($model->district_id)['state_id'];
} ?>
                    <?= $form->field($model, 'state_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\State::find()->where(['status' => 1])->all(), 'id', 'state_name'), ['prompt' => 'Select', 'onchange' => 'getDistrictData()']); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary" id="company_details" style="display:none">
        <div class="box-header with-border">
            <h3 class="box-title">Company</h3>
        </div>
        <div class="box-body">
        <div class="form-group">
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($model, 'company_name')->textInput(['maxlength' => true]); ?>
                        <?=$form->field($model, 'company_pincode')->textInput(); ?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($model, 'parent_company_name')->textInput(['maxlength' => true]); ?>
                        <?php if ($model->isNewRecord == false) {
    $model->company_country_id = getCountryId($model->district_id)['country_id'];
} ?> 
                        <?= $form->field($model, 'company_country_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Country::find()->where(['status' => 1])->all(), 'id', 'country_name'), ['prompt' => 'Select', 'onchange' => 'getCompanySateData()']); ?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($model, 'website')->textInput(['maxlength' => true]); ?>
                        <?php if ($model->isNewRecord == false) {
    $model->company_state_id = getCountryId($model->district_id)['state_id'];
} ?> 
                        <?= $form->field($model, 'company_state_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\State::find()->where(['status' => 1])->all(), 'id', 'state_name'), ['prompt' => 'Select', 'onchange' => 'getCompanyDistrictData()']); ?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($model, 'company_address')->textarea(['rows' => 1]); ?>
                        <?=$form->field($model, 'company_district_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\District::find()->where(['status' => 1])->all(), 'id', 'district_name'), ['prompt' => 'Select']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <!-- Suresh -->

      <div class="box box-primary" id="contact_details" style="display:none">
        <div class="box-header with-border">
            <h3 class="box-title">Contact Details</h3>
            <button id="add-more" name="add-more" class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> <b>ADD FORM</b></button>
        </div>
        <div class="box-body">
                <div id="field">
                    <div id="field0" >
                    </div>
                <?php if (!empty($vendorContactPersonM)) {
    $i = 1;
    $next = 0;
    foreach ($vendorContactPersonM as $value) {
        ?>
                          <div id="field<?=$i; ?>" >
                                <!-- Remove -->
                                    <button  id="remove_ad<?=$i; ?>" class="btn btn-danger btn-sm remove-me-add" onclick="removeDatabaseValue(event,'<?=$value['id']; ?>','field<?=$i; ?>')">Remove</button>
                                <!-- End -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name*</label>
                                            <input value="<?=$value['id']; ?>" id="name'<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][vendor_person_contact_id]" type="hidden" placeholder="" class="form-control input-md">
                                            <input value="<?=$value['name']; ?>" id="name'<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][name]" type="text" placeholder="" class="form-control input-md">
                                            <span id="name_msg<?=$i; ?>" style="color:red"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Title*</label>
                                            <input value="<?=$value['title']; ?>" id="title<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][title]" type="text" placeholder="" class="form-control input-md">
                                            <span id="title_msg<?=$i; ?>" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address*</label>
                                            <input value="<?=$value['address']; ?>" id="address<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][address]" type="text" placeholder="" class="form-control input-md">
                                            <span id="address_msg<?=$i; ?>" style="color:red"></span>
                                        </div>
                                    </div><div class="clearfix"></div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact No*.</label>
                                            <input value="<?=$value['contact_no']; ?>" id="contact_no<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][contact_no]" type="text" placeholder="" class="form-control input-md">
                                            <span id="contact_no_msg<?=$i; ?>" style="color:red"></span>
                                       </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Pan No*.</label>
                                            <input value="<?=$value['pan_no']; ?>" id="pan_no<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][pan_no]" type="text" placeholder="" class="form-control input-md">
                                            <span id="pan_no_msg<?=$i; ?>" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Service Tax No*.</label>
                                            <input value="<?=$value['service_tax_no']; ?>" id="service_tax_no<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][service_tax_no]" type="text" placeholder="" class="form-control input-md">
                                            <span id="service_tax_no_msg<?=$i; ?>" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input value="<?=$value['email_id']; ?>" id="email_id<?=$i; ?>" name="VendorContactPerson[<?=$next; ?>][email_id]" type="text" placeholder="" class="form-control input-md">
                                            <span id="email_id_msg<?=$i; ?>" style="color:red"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                     <?php ++$i;
    }
}?>
                </div>
          </div>
    </div>
   <script>
          
        $("#applicability :radio").change(function(){
                if($(this).val() == 1){
                    $("#contact_details").css('display','block');
                    $("#company_details").css('display','block');
                }else{
                    $('#field').find('div').first().remove();
                    $("#vendor-company_name").val("");
                    $("#vendor-parent_company_name").val("");
                    $("#vendor-website").val("");
                    $("#vendor-company_address").val("");
                    $("#vendor-company_pincode").val("");
                    $("#vendor-company_country_id").val("");
                    $("#vendor-company_state_id").val("");
                    $("#vendor-company_district_id").val("");
                    $("#company_details").css('display','none');    
                    $("#contact_details").css('display','none');
                }
        });
        <?php  if ($model->applicability == 1) {
    ?>   
                    $("#contact_details").css('display','block');
                    $("#company_details").css('display','block');  
        <?php
} ?> 

       let dataCount = parseInt('<?=!empty($vendorContactPersonM) ? count($vendorContactPersonM) : 0; ?>');
       let countInputBox =  dataCount ? dataCount : 0;
       $(document).ready(function () {
                confimMassage();
                //@suresh action dynamic childs
                var countData = parseInt('<?=!empty($vendorContactPersonM) ? count($vendorContactPersonM) : 0; ?>');
                var next = countData ? countData : 0;

                $("#add-more").click(function(e){
                e.preventDefault();
                countInputBox++;
                <?php if ($model->isNewRecord == true) {
        ?>
                next = next + 1;
                var newIn ='<div id="field'+ next +'" name="field'+ next +'">';

                var newRecord = 1;
                <?php
    } else {
        ?>
                next = next + 1;
                var newIn ='<div id="field'+ next +'" name="field'+ next +'">';
                var newRecord = 0;
                <?php
    }?>

                newIn +='<button id="remove' + (next - 1) + '" data-id="field'+ (next) +'" class="btn btn-danger btn-sm remove-me">Remove</button>';

                newIn += '<div class="row">';
                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Name*</label>';
                newIn += '<input id="name'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][name]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="name_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div>';

                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Title*</label>';
                newIn += '<input id="title'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][title]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="title_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div>';


                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Address*</label>';
                newIn += '<input id="address'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][address]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="address_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div><div class="clearfix"></div>';

                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Contact No*.</label>';
                newIn += '<input id="contact_no'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][contact_no]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="contact_no_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div>';

                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Pan No*.</label>';
                newIn += '<input id="pan_no'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][pan_no]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="pan_no_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div>';


                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Service Tax No*.</label>';
                newIn += '<input id="service_tax_no'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][service_tax_no]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="service_tax_no_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div>';

                newIn += '<div class="col-md-4">';
                newIn += '<div class="form-group">';
                newIn += '<label>Email*</label>';
                newIn += '<input id="email_id'+(countInputBox)+'" name="VendorContactPerson['+ (next - 1) +'][email_id]" type="text" placeholder="" class="form-control input-md">';
                newIn += '<span id="email_id_msg'+(countInputBox)+'" style="color:red"></span>';
                newIn +='</div>';
                newIn +='</div>';

                newIn +='</div>';
                newIn +='</div>';

                $("#field").after(newIn);
                $("#count").val(next);
                $('.remove-me').click(function(e){
                    e.preventDefault();
                    let parentDivId = $(this).data("id");
                    $("#"+parentDivId).remove();
                });
            });
        });
        function validationFamilyDetails(){
        let flag = 0;
        let status = $("#vendor-status").val();
        var conf ="";
        if(status && status == 1){
            let value = status && status == 1 ? "Approved" : "Rejected";
             conf = confirm('Are you sure want to change status ?');
            if(conf == false){
                $("#vendor-status").val(2);
                $("#comment_id").css('display','block')
                flag++;
            }else{
                 conf = "";     
            }
        }
        if(countInputBox){
            let name = [];
            let title = [];
            let address = [];
            let contact_no = [];
            let pan_no = [];
            let service_tax_no = [];
            let email_id = [];
           
            for (var i = 1; i <= countInputBox; i++) {
                name[i] = $("#name"+i).val();
                title[i] = $("#title"+i).val();
                address[i] = $("#address"+i).val();
                contact_no[i] = $("#contact_no"+i).val();
                pan_no[i] = $("#pan_no"+i).val();
                service_tax_no[i] = $("#service_tax_no"+i).val();
                email_id[i] = $("#email_id"+i).val();
                if(name[i] ==""){
                    $("#name_msg"+i).html("Name cannot be blank.");
                    flag++;
                }else{
                    $("#name_msg"+i).html("");
                }
                if(title[i] ==""){
                    $("#title_msg"+i).html("Title cannot be blank.");
                    flag++;
                }else{
                    $("#title_msg"+i).html("");
                }
                if(address[i] ==""){
                    $("#address_msg"+i).html("Address cannot be blank.");
                    flag++;
                }else{
                    $("#address_msg"+i).html("");
                }
                if(contact_no[i] ==""){
                    $("#contact_no_msg"+i).html("Contact no cannot be blank.");
                    flag++;
                }else{
                    $("#contact_no_msg"+i).html("");
                }
                if(pan_no[i] ==""){
                    $("#pan_no_msg"+i).html("Pan no cannot be blank.");
                    flag++;
                }else{
                    $("#pan_no_msg"+i).html("");
                }
                if(service_tax_no[i] ==""){
                    $("#service_tax_no_msg"+i).html("Service tax no cannot be blank.");
                    flag++;
                }else{
                    $("#service_tax_no_msg"+i).html("");
                }
                if(email_id[i] ==""){
                    $("#email_id_msg"+i).html("Email cannot be blank.");
                    flag++;
                }else{
                    $("#email_id_msg"+i).html("");
                }
            }
         }else{
             $("#field").html("Please add new contact details");
             return false;
         }
            
            if(flag != 0){
               return false;
            }
       }
       
    function removeDatabaseValue(e,id,fieldID){
        e.preventDefault();
        $.ajax({
                url: '<?php echo Url::to(['vendor/delete-vendor-contact']); ?>',
                type: 'get',
                data: {
                    id : id
                },
                success: function (res) {
                     let obj = JSON.parse(res);
                     if(obj.status == "200"){
                        let element=document.getElementById(fieldID);
                        document.getElementById(fieldID).parentNode.removeChild(element);
                     }
                },
                error: function (res) {
                    console.log("Error :",res);
                }
            });
       }
   </script>

   <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Banking Information:</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <?=$form->field($model, 'bank_name')->textInput(['maxlength' => true]); ?>
                    <?php if ($model->isNewRecord == false) {
        $model->bank_country_id = getCountryId($model->district_id)['country_id'];
    } ?>
                    <?= $form->field($model, 'bank_country_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Country::find()->where(['status' => 1])->all(), 'id', 'country_name'), ['prompt' => 'Select', 'onchange' => 'getBankSateData()']); ?>
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'branch_id')->textInput(['maxlength' => true]); ?>
                    <?php if ($model->isNewRecord == false) {
        $model->bank_state_id = getCountryId($model->district_id)['state_id'];
    } ?>
                    <?= $form->field($model, 'bank_state_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\State::find()->where(['status' => 1])->all(), 'id', 'state_name'), ['prompt' => 'Select', 'onchange' => 'getBankDistrictData()']); ?>
                </div>
                <div class="col-md-3">
                   <?=$form->field($model, 'branch_name')->textInput(['maxlength' => true]); ?>
                   <?=$form->field($model, 'bank_district_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\District::find()->where(['status' => 1])->all(), 'id', 'district_name'), ['prompt' => 'Select']); ?>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'branch_address')->textarea(['rows' => 1]); ?>
                    <?=$form->field($model, 'bank_pincode')->textInput(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Bank Account Details:</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <?=$form->field($model, 'bank_account_name')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'ifsc_code')->textInput(['maxlength' => true]); ?>

                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'bank_currency')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'swift_code')->textInput(['maxlength' => true]); ?>

                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'bank_account_no')->textInput(['maxlength' => true]); ?>
                    <?=$form->field($model, 'iban')->textInput(['maxlength' => true]); ?>

                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'bank_account_type')->textInput(['maxlength' => true]); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Bank Information for Intermediary/Correspondent Bank</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <?=$form->field($model, 'cb_bank_name')->textInput(['maxlength' => true]); ?>

                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'cb_address')->textarea(['rows' => 1]); ?>

                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'cb_account_no')->textInput(['maxlength' => true]); ?>

                </div>
                <div class="col-md-3">
                    <?=$form->field($model, 'cb_swift_code')->textInput(['maxlength' => true]); ?>
                </div>
            </div>
        </div>
    </div>
   <?php if (getLevelId() == \backend\models\Level::HO) {
        ?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Approve Reject Status</h3>
        </div>
        <div class="box-body">
             <div class="row">
                <div class="col-md-3">
                        <?=$form->field($model, 'status')->dropDownList(['1' => 'Approved', '2' => 'Reject'], ['prompt' => 'Select', 'onchange' => 'confimMassage()']); ?>
                </div>
                <div class="col-md-6" style="display:none" id="comment_id">
                        <?=$form->field($model, 'comment')->textarea(array('rows' => 2, 'cols' => 5)); ?>
                </div>
             </div>
        </div>
    </div>
   <?php
    } ?>
    <?php
    if ($model->isNewRecord) {
        $model->user_id = backend\models\User::getSessionUserId();
        echo $form->field($model, 'user_id')->hiddenInput()->label(false);
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?=Html::submitButton('Submit', ['class' => 'btn btn-success']); ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script>
 function getSateData(){
    let country_id = $("#vendor-country_id").val();
    $.ajax({
        url: '<?php echo Url::to(['site/get-all-location']); ?>',
        type: 'post',
        data: {
            type : 1,
            id : country_id
        },
        success: function (res) {
         var optionList = "<option value=''>Select</option>";
         if(res.length > 0){
            for (var i = 0; i < res.length; i++) {
                optionList += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
            }
         }   
           $("#vendor-state_id").html(optionList);   
           getDistrictData();              
        },
        error: function (res) {
            console.log("Error :",res);
        }
    });
 }
 function getDistrictData(){
    let state_id = $("#vendor-state_id").val();
    $.ajax({
        url: '<?php echo Url::to(['site/get-all-location']); ?>',
        type: 'post',
        data: {
            type : 2,
            id : state_id
        },
        success: function (res) {
         var optionList = "<option value=''>Select</option>";
        if(res.length > 0){
            for (var i = 0; i < res.length; i++) {
                optionList += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
            }
         }   
           $("#vendor-district_id").html(optionList);                 
        },
        error: function (res) {
            console.log("Error :",res);
        }
    });  
 }

 function getBankSateData(){
    let country_id = $("#vendor-bank_country_id").val();
    $.ajax({
        url: '<?php echo Url::to(['site/get-all-location']); ?>',
        type: 'post',
        data: {
            type : 1,
            id : country_id
        },
        success: function (res) {
         var optionList = "<option value=''>Select</option>";
        if(res.length > 0){
            for (var i = 0; i < res.length; i++) {
                optionList += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
            }
        }   
        $("#vendor-bank_state_id").html(optionList);   
           getBankDistrictData();              
        },
        error: function (res) {
            console.log("Error :",res);
        }
    });
 }
 function getBankDistrictData(){
    let state_id = $("#vendor-bank_state_id").val();
    $.ajax({
        url: '<?php echo Url::to(['site/get-all-location']); ?>',
        type: 'post',
        data: {
            type : 2,
            id : state_id
        },
        success: function (res) {
         var optionList = "<option value=''>Select</option>";
        if(res.length > 0){
            for (var i = 0; i < res.length; i++) {
                optionList += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
            }
         }   
        $("#vendor-bank_district_id").html(optionList);                 
        },
        error: function (res) {
            console.log("Error :",res);
        }
    });  
 }

 function getCompanySateData(){
    let country_id = $("#vendor-company_country_id").val();
    $.ajax({
        url: '<?php echo Url::to(['site/get-all-location']); ?>',
        type: 'post',
        data: {
            type : 1,
            id : country_id
        },
        success: function (res) {
         var optionList = "<option value=''>Select</option>";
        if(res.length > 0){
            for (var i = 0; i < res.length; i++) {
                optionList += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
            }
        }   
        $("#vendor-company_state_id").html(optionList);   
            getCompanyDistrictData();              
        },
        error: function (res) {
            console.log("Error :",res);
        }
    });
 }
 function getCompanyDistrictData(){
    let state_id = $("#vendor-company_state_id").val();
    $.ajax({
        url: '<?php echo Url::to(['site/get-all-location']); ?>',
        type: 'post',
        data: {
            type : 2,
            id : state_id
        },
        success: function (res) {
         var optionList = "<option value=''>Select</option>";
        if(res.length > 0){
            for (var i = 0; i < res.length; i++) {
                optionList += '<option value="' + res[i]['id'] + '">' + res[i]['name'] + '</option>';
            }
         }   
        $("#vendor-company_district_id").html(optionList);                 
        },
        error: function (res) {
            console.log("Error :",res);
        }
    });  
 }
 function confimMassage(){
      let status = $("#vendor-status").val();
      if(status && status == 2){
        $("#comment_id").css("display",'block')    
      }else{
        $("#vendor-comment").val(""); 
        $("#comment_id").css("display",'none') 
      }
 }
</script>

