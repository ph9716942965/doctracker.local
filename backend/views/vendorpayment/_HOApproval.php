<?php
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\Program;
use backend\models\CostCentre;
use backend\models\CostCentreSub;
use backend\models\Locationdescription;
use backend\models\Vendor;
use backend\models\FundingAgencyBu;
use backend\models\FundingAgency;
?>

 <button type="button" class="btn btn-primary"  id="hoapproval" data-toggle="modal" data-target="#myModal">
 HO Approval
</button>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="alert" >Enter Reason</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
      
<fieldset>

<!-- Form Name -->
<input type="hidden" id="claim_id" name="claim_id" value="<?= $model->id ?>" >
<!-- Textarea -->
 <?= $form->field($model, 'natural_head')->textInput(['maxlength' => true]) ?>
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

<div class="form-group">
  <label class="col-md-2 control-label" for="textarea">comment</label>
  <div class="col-md-10">                     
    <textarea class="form-control" id="comment" placeholder="Comment here" name="comment" required></textarea>
  </div>
</div>
<!-- Button (Double) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="button1id"></label>
  <div class="col-md-8">
    </div>
</div>
</fieldset>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
      <button onclick="ajaxcomment()" class="btn btn-success">Save </button> 
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
    $("#returnemp").click(function(){
        $("#comment").val('');
    });
});

function ajaxcomment(){
        
        var comment = document.getElementById("comment").value;
         var reqid = document.getElementById("claim_id").value;
         if(comment==''){
            $('#alert').html('<div class="alert alert-danger" role="alert">Please Enter Reason!</div>');
         }else{
         //console.log("Co2",year)
         $.ajax({
             url: '<?php echo Url::to(["vendorpayment/return"]); ?>',
             type: 'post',
             data: {
                ho_comment:comment,
                  id : reqid,
                 _csrf: '<?=Yii::$app->request->getCsrfToken()?>'
             },
             beforeSend: function () {
                 ajaxIndicatorStart("Please wait...", '<?php echo Url::to("@web/css/loading.gif") ?>');
             },
             complete: function () {
                ajaxIndicatorStop();
             },
             success: function (data) {
                // console.log("Return",data);
                 //$('#myModal').modal('toggle');
                 location.replace("<?php echo Url::to(['/vendorpayment/index']) ?>");
                // alert(data);
                // dataCo2EnessionReductionLineChart(data);
             },
             error: function (jsonResponse) {
                 console.log(jsonResponse);
                 //alert("Something went wrong in Solar Irrigation Area.");
             }
         });
         }
     }

</script>



<script type="text/javascript">
     function ajaxIndicatorStart(message, pathOfAjaxLoadingImage)
{
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="' + pathOfAjaxLoadingImage + '"><div>' + message + '</div></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#000000',
        'opacity': '0.6',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxIndicatorStop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}
     </script>