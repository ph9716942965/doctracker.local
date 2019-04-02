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



/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
   <div class="col-md-2"><?= $form->field($model, 'naturehead')->textInput(['maxlength' => true]) ?> </div>
   <div class="col-md-2">
   
    <?php // $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'project_id')->DropdownList(ArrayHelper::map(Project::find()->all(),'id','name'),['prompt'=>'Select Project']) ?>
     </div>
   <div class="col-md-2"><?= $form->field($model, 'project_budget_line_id')->DropdownList(ArrayHelper::map(ProjectBudgetLine::find()->all(),'id','name'),['prompt'=>'Select Budget Line']) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'costcenter_id')->textInput(['maxlength' => true]) ?> </div>
   </div>

   <div class="row">
   <div class="col-md-2"><?= $form->field($model, 'program_id')->DropdownList(ArrayHelper::map(Program::find()->all(),'id','name'),['prompt'=>'Select Program']) ?> </div>
   <div class="col-md-2"> <?= $form->field($model, 'locationdescription_id')->DropdownList(ArrayHelper::map(Locationdescription::find()->all(),'id','dis'),['prompt'=>'Select Location']) ?> </div>
  </div>

  <div class="row">
   <div class="col-md-8"><?= $form->field($model, 'ho_comment')->textarea(['maxlength' => true]) ?> </div>
   </div>
