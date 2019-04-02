   
<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\FundingAgency;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\Project;
use kartik\depdrop\DepDrop;
use backend\models\CostCentre;
use backend\models\CostCentreSub;
use backend\models\Program;
use backend\models\Locationdescription;
$USERAUTH1=new CheckAuth2($_SESSION['login_info']['username']);
?>


<?php 
//$condition2=$model->isNewRecord?false:Rstatus($model->id)!='Return By Account Level';
if(($model->isNewRecord == false) && $USERAUTH1->Checkuser()!='HO'){?>
  
<div class="row">
<?= field_gen(project_name($model->project_id),'Project') ?>
<?= field_gen(project_budget_line_name($model->project_budget_line_id),'Project Budget Line ') ?>
<?= field_gen(costcentersub_name($model->costcenter_id),'Costcenter') ?>
<?= field_gen(program_name($model->program_id),'Program') ?>
<?= field_gen(locationdescription_name($model->locationdescription_id),'Location Description') ?>

   <?php /* <div class="col-md-3"><?= $form->field($model, 'project_id')->textInput(['readonly' => true]) ?></div>
    <div class="col-md-3"><?= $form->field($model, 'project_budget_line_id')->textInput(['readonly' => true]) ?></div>
    <div class="col-md-3"><?= $form->field($model, 'costcenter_id')->textInput(['readonly' => true]) ?></div>
    */ ?><div class="col-md-4"><?= $form->field($model, 'naturehead')->textInput(['readonly' => true]) ?></div>
   <?php /* <div class="col-md-3"><?= $form->field($model, 'program_id')->textInput(['readonly' => true]) ?></div>
    <div class="col-md-3"><?= $form->field($model, 'locationdescription_id')->textInput(['readonly' => true]) ?></div>
    */ ?><div class="col-md-4"><?= $form->field($model, 'ho_comment')->textInput(['readonly' => true]) ?></div>
</div>
<?php }else{ ?>
<div class="row">
   <div class="col-md-3">
    <?= $form->field($model, 'project_id')->DropdownList(ArrayHelper::map(Project::find()->all(),'id','name'),['id'=>'cat-id','prompt'=>'Select Project']) ?>
	</div>
   <div class="col-md-3">
   <?php 
   //echo $model->project_budget_line_id;exit;
   //echo Html::hiddenInput('model_id1', $model->project_budget_line_id, ['id'=>'model_id1' ]);
echo $form->field($model, 'project_budget_line_id')->widget(DepDrop::classname(), [
    'options'=>['id'=>'subcat-id'],
    'data'=>[2 => 'Tablets'],
    'pluginOptions'=>[
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'depends'=>['cat-id'],
        'placeholder'=>'Select...',
        'initialize' => $model->isNewRecord ? false : true,
        'url'=>Url::to(['/claim-request/formdata']),
        'params'=>['input-type-1', 'input-type-2']
    ]
]);
?>
   
   <?php // $form->field($model, 'project_budget_line_id')->textInput(['maxlength' => true]) ?> </div>
   <?php // $form->field($model, 'costcenter_id')->textInput(['maxlength' => true]) ?> 

<?php
$CostCentre = ArrayHelper::map(CostCentre::find()->all(),'id','name');
$modelCostCentre=new CostCentre();
//$model->name=1;
$selected=$model->isNewRecord?'':CostCentreSub::find()->select('cost_centre_id')->where(["id"=>$model->costcenter_id])->asArray()->one()['cost_centre_id'];
$modelCostCentre->name=$selected;
?>
   <div class="col-md-3"><?= $form->field($modelCostCentre, 'name')->DropdownList($CostCentre,['id'=>'ccat-id','prompt'=>'Select Cost Center',]) ?> </div>
   <div class="col-md-3"> 
   <?php
echo $form->field($model, 'costcenter_id')->widget(DepDrop::classname(), [
    'options'=>['id'=>'ccsubcat-id'],
    'data'=>[2 => 'Tablets'],
    'pluginOptions'=>[
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'depends'=>['ccat-id'],
        'initialize' => $model->isNewRecord ? false : true,
        'placeholder'=>'Select...',
       // 'value'=>$model->isNewRecord?false:$model->costcenter_id,
        'url'=>Url::to(['/claim-request/costcenterformdata'])
    ]
]);

?> 
   <?php // $form->field($model, 'costcenter_id')->textInput(['maxlength' => true]) ?> </div>
  </div>

   <div class="row">

   <div class="col-md-3"><?= $form->field($model, 'naturehead')->textInput(['maxlength' => true]) ?> </div>


   <?php $program_id = ArrayHelper::map(Program::find()->all(),'id','name');?>
   <div class="col-md-3">
   <label class="control-label" for="claimrequest-program_id">Program ID *</label>
   <?php  echo Select2::widget([
    'name' => 'ClaimRequest[program_id]',
    'data' => $program_id,
    'value'=>$model->isNewRecord?false:$model->program_id,
    'options' => ['placeholder' => 'Select program  ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
   
   
   
   <?php // $form->field($model, 'program_id')->textInput(['maxlength' => true]) ?> </div>
  
   <?php $locationdescription_id = ArrayHelper::map(Locationdescription::find()->all(),'id','dis');?>
   <div class="col-md-3">
   <label class="control-label" for="claimrequest-locationdescription_id">Location Description *</label>
   <?php  echo Select2::widget([
    'name' => 'ClaimRequest[locationdescription_id]',
    'data' => $locationdescription_id,
    'value'=>$model->isNewRecord?false:$model->locationdescription_id,
    //'size' => Select2::SMALL,
    'options' => ['placeholder' => 'Select Location Description ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
   
   
   
   <?php // $form->field($model, 'locationdescription_id')->textInput(['maxlength' => true]) ?> </div>
  </div>

  <div class="row">
   <div class="col-md-6"><?= $form->field($model, 'ho_comment', ['options' => ['id' => 'ho_comment']])->textarea(['maxlength' => true]) ?> </div>
   </div>

<?php }?>