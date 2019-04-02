<?php

use yii\helpers\Url;
use backend\models\FundingAgency;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
$USERAUTH2=new CheckAuth2($_SESSION['login_info']['username']);
?>
<div class="row">

<?php 

 if(($model->isNewRecord == false) && $USERAUTH2->Checkuser()!='RO'){?>
    <?= field_gen(fundagency_name($model->fund_agency),'Fund Agency') ?>
    
 <?php /*<div class="col-md-3"> 
 
 <?= $form->field($model, 'fund_agency')->textInput(['readonly' => true]) ?> </div> */ ?>
 <div class="col-md-3"> <?= $form->field($model, 'nature_service')->textInput(['readonly' => true]) ?> </div>
<div class="col-md-6"> <?= $form->field($model, 'ro_comment')->textarea(['readonly' => true]) ?> </div> 
<?php }else{ ?>
<?php $FundingAgency = ArrayHelper::map(FundingAgency::find()->all(),'id','name'); ?>
   <div class="col-md-3">
   <label class="control-label" for="claimrequest-fund_agency">Funding Agency</label>
   <?php  echo Select2::widget([
    'name' => 'ClaimRequest[fund_agency]',
    'data' => $FundingAgency,
    'value'=>$model->isNewRecord?false:$model->fund_agency,
    //'size' => Select2::SMALL,
    'options' => ['placeholder' => 'Select Funding Agency ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
   <?php //$form->field($model, 'fund_agency')->DropdownList($FundingAgency,['prompt'=>'Select Funding Agency']) ?> </div>
   <div class="col-md-3"> <?= $form->field($model, 'nature_service')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-6"> <?= $form->field($model, 'ro_comment', ['options' => ['id' => 'ro_comment']])->textarea(['maxlength' => true]) ?> </div>

   <?php }?>
   </div>