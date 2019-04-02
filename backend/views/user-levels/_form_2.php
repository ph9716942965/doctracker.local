<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserLevels */
/* @var $form yii\widgets\ActiveForm */
?>


<!--<script type="text/javascript">
        $(document).ready(function(){
            
            $("select").select2();
//            ,disabled!='disabled'
            
//            $("select[multiple!='multiple']").select2();
        })
    </script>-->

<style type="text/css">
    
    .bsWarningColor{
            background-color: #f0ad4e;
            padding: 5px;
            border-radius: 3px;
    }
</style>
    
<div class="user-levels-form">

    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'level_name')->textInput(['maxlength' => true]) ?>

    
    
    <?php
    $levelArrayFromDb = '';
    if(isset($model->level_authentications))
    {
        if($model->level_authentications!="")
        {
            $levelArrayFromDb = $model->level_authentications;
        }
    }
    
    ?>
    
    <?php
//        echo $form->field($model, 'level_type')
//                    ->dropDownList(
//                        getLevelTypeArray() ,          // Flat array ('id'=>'label')
//                        ['prompt'=>'Select Level...']    // options
//                    );
    ?>
    
    
    <h3>Access on this level</h3>
    <br/>
    
    
    
    <?php 
    
    $allUserList =  \app\models\Users::find()->all();
    
    $MUSerLIst = array();
    for($i=0;$i<count($allUserList);$i++)
    {
        $singleUser  = $allUserList[$i];
        
        
        $userLevel = \app\models\UserLevels::find()->where(["id"=>$singleUser->user_level])->one();
        if($userLevel!=null)
        {
            $MUSerLIst[$singleUser->id] = $singleUser->first_name. " ". $singleUser->last_name." {User Level : ".$userLevel->level_name."} - {User Type: ".$singleUser->user_type."}";
        }
        
    }    
    
    
    ?>
    
    
    
    
    <?php 
    
    
    $blockEnableDisableList = array();
//    $blockEnableDisableList[] = "centers";
    
    
    $basicActions = array();
    $basicActions[] = "create";
    $basicActions[] = "update";
    $basicActions[] = "index";
    $basicActions[] = "delete";
    $basicActions[] = "view";
    
    $moduleList = array();
    
    $moduleList[] = "agri-input";
$moduleList[] = "agri-machinery";
$moduleList[] = "agri-output";
$moduleList[] = "agriculture-practice";
$moduleList[] = "agriculture-practice-crop-details";
$moduleList[] = "ai-profile";
$moduleList[] = "ai-profile-success-failure-ratio";
$moduleList[] = "artificial-insemination-details";
$moduleList[] = "breed-detail";
$moduleList[] = "cattle-profile";
$moduleList[] = "cattle-sale-death-purchase-details";
$moduleList[] = "crop";
$moduleList[] = "dairy-expense";
$moduleList[] = "dairy-expense-copy";
$moduleList[] = "dairy-expense-dropdown";
$moduleList[] = "dairy-expense-type";
$moduleList[] = "dairy-income";
$moduleList[] = "dependants";
$moduleList[] = "education-qualification";
$moduleList[] = "family-details";
$moduleList[] = "financial-year";
$moduleList[] = "gender";
$moduleList[] = "household-profile";
$moduleList[] = "kitchen-garden";
$moduleList[] = "land-detail";
$moduleList[] = "milk-production";
$moduleList[] = "page-authentications";
$moduleList[] = "primary-occupation";
$moduleList[] = "push-tokens";
$moduleList[] = "semen-details";
$moduleList[] = "site";
$moduleList[] = "type-of-bull";
$moduleList[] = "type-of-phone";
$moduleList[] = "units";
$moduleList[] = "user-levels";
$moduleList[] = "user-type";
$moduleList[] = "users";
$moduleList[] = "village";
    
    ?>
    
    
    <div class="row">
        
    
        
        
        
    
    <?php 
    
    $pagerAuthenticationModels = null;
    
    $authenticationColumnValues = [];
    $approveToColumnValues = [];
    if(!$model->isNewRecord)
    {
        $pagerAuthenticationModels = app\models\PageAuthentications::find()->where(['level_id'=>$model->id])->all();

        for($k=0;$k<count($pagerAuthenticationModels);$k++)
        {
            $singelePageM = $pagerAuthenticationModels[$k];
            $authenticationColumnValues[] = $singelePageM->authentication; 
            if($singelePageM->approve_to != "" || ($singelePageM->notify_to != "[]" && $singelePageM->notify_to != ""))
            {
                $approveToColumnValues[] = $singelePageM->authentication;
            }
        }

    }
    
    
        
    for($i=0;$i<count($moduleList);$i++)
    {
        echo '<div class="col-lg-2">';
        
        $actions = $basicActions;
        
        
        
        
        
        if($moduleList[$i] == 'approval')
        {
           $actions = array();  
           $actions[] = 'approvals';
        }
        if($moduleList[$i] == 'notifications')
        {
           $actions = array();  
           $actions[] = 'notifications';
        }
         if(in_array($moduleList[$i], $blockEnableDisableList))
        { 
           $actions[] = 'block-enable';
           $actions[] = 'block-disable';
        }
        if($moduleList[$i] == 'users')
        {
           $actions[] = 'profile';
           $actions[] = 'change-password';
        }
        if($moduleList[$i] == 'employer')
        {
           $actions[] = 'sector-wise-placement-companies';
        }
        if($moduleList[$i] == 'centers')
        {
           $actions[] = 'graph-smart-center-distribution';
           $actions[] = 'graph-center-wise-candidate-comparison';
           $actions[] = 'center-wise-report';
        }
         if($moduleList[$i] == 'district')
        {
           $actions[] = 'district-wise-report';
           $actions[] = 'export-all';
        }
        if($moduleList[$i] == 'candidate')
        {
           $actions[] = 'graph-placed-student-distribution';
           $actions[] = 'graph-joined-student-distribution';
           $actions[] = 'graph-gender-distribution';
        }
        
        if($moduleList[$i] == 'quota')
        {
           $actions[] = 'allotment';
        }
        
        if($moduleList[$i] == 'partners')
        {
           $actions[] = 'graph-partner';
        }
        
          
        if($moduleList[$i] == 'site')
        {
           $actions[] = 'dashboard';
           $actions[] = 'graph-agriculture';
           $actions[] = 'graph-dairy';
        }
        
        
        $nameM = ucfirst($moduleList[$i]);
        echo "<h4 class='bsWarningColor'>{$nameM} Module</h4>";
        echo '<div class="x_panel">';
        
        
        
        
        echo "<h5>Pages Authenticated</h5>";
        echo Html::listBox("PageAuthentication[{$i}][authentication]",  $authenticationColumnValues,  
                createUrls($actions, $moduleList[$i])
                ,['class'=>'form-control','multiple'=>true]);
        
        
        
        echo "<h4>Approval Of</h4>";
        echo Html::listBox("PageAuthentication[{$i}][approve_of]",$approveToColumnValues,
                createUrls($actions, $moduleList[$i])
                ,['class'=>'form-control','multiple'=>true]);
        
        
        $releativeActions = [];
        for($mi=0;$mi<count($actions);$mi++)
        {
            $releativeActions[] = $moduleList[$i]."/".$actions[$mi];
        }
        $finalApproveTo = '';
        $finalNotifyTo = array();
        if($pagerAuthenticationModels != null)
        {
            $notifytoGot = false;
            for($k=0;$k<count($pagerAuthenticationModels);$k++)
            {
                $singelePageM = $pagerAuthenticationModels[$k];
                
                
                
                if($singelePageM->approve_to != "")
                {
                    if(in_array($singelePageM->authentication, $releativeActions))
                    {
                        $finalApproveTo = $singelePageM->approve_to;
                    }
                }
                

                if($singelePageM->notify_to != "[]" || $singelePageM->notify_to != "")
                {
                    if(in_array($singelePageM->authentication, $releativeActions))
                    {     
                        if($notifytoGot == false)
                        {
                            $finalNotifyTo = json_decode($singelePageM->notify_to,false);
                            $notifytoGot = true;
                        }
                    }
                }
                
            }
        }
        
//        echo "<h4>Approval To</h4>";yii\helpers\ArrayHelper::map(\app\models\Users::find()->all(), 'id', 'user_name')
        echo Html::dropDownList("PageAuthentication[{$i}][approve_to]",$finalApproveTo,  $MUSerLIst,['prompt'=>'Select.','class'=>'form-control']);
        
        
        
        echo "<h4>Notify To</h4>";
        echo Html::listBox("PageAuthentication[{$i}][notify_to]",$finalNotifyTo,  $MUSerLIst,['multiple'=>true,'class'=>'form-control']);
        
        
        echo '</div>';
        
        echo '</div>';
    }
    
    ?>
    
    
    </div>
    
    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
