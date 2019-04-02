<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserLevels */
/* @var $form yii\widgets\ActiveForm */
?>

<style type="text/css">

    .bsWarningColor{
        font-weight: 600;
        padding: 5px;
        border-radius: 3px;
        /*display: list-item !important;*/
        min-height: 70px;
        line-height: 30px;
        text-align: center;
        vertical-align: central;
    }

    .bsAgriBgColor{
        background-color: #c1c215;
    }
    .bsDairyBgColor{  
        background-color: #7fffd4;
    }
    .bsHouseholdBgColor{
        background-color: #ddcbcf;
    }
    .bsDefaultBgColor{
        background-color: #f0ad4e;
    }
    .bsSimpleDesign{
        padding: 5px 10px;
        /*width: 20px;*/
        margin-right: 5px;
        display: inline-block;
        font-size: 14px;
        border-radius: 3px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="bsAgriBgColor bsSimpleDesign">One</div>
        <!--    </div>
            <div class="col-md-1">-->
        <div class="bsDairyBgColor bsSimpleDesign">Two</div>
        <!--    </div>
            <div class="col-md-1">-->
        <div class="bsHouseholdBgColor bsSimpleDesign">Three</div>
        <!--    </div>
            <div class="col-md-1">-->
        <div class="bsDefaultBgColor bsSimpleDesign">Other</div>
    </div>
</div>
<br>
<div class="user-levels-form">


    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'level_name')->textInput(['maxlength' => true]) ?>


    <?php
    $levelArrayFromDb = '';
    if (isset($model->level_authentications)) {
        if ($model->level_authentications != "") {
            $levelArrayFromDb = $model->level_authentications;
        }
    }
    ?>


    <h3>Access on this level</h3>


    <?php
    $allUserList = \backend\models\User::find()->all();
//    display_array($allUserList);exit;
    $MUSerLIst = array();
    for ($i = 0; $i < count($allUserList); $i++) {
        $singleUser = $allUserList[$i];


        $userLevel = \backend\models\UserLevels::find()->where(["id" => $singleUser->level_id])->one();
        if ($userLevel != null) {
            $MUSerLIst[$singleUser->id] = $singleUser->username . " {User Level : " . $userLevel->level_name . "}";
        }
    }
    ?>




    <?php
    $basicActions = array();
    $basicActions[] = "create";
    $basicActions[] = "update";
    $basicActions[] = "index";
    $basicActions[] = "delete";
    $basicActions[] = "view";

    $moduleList = array();
    $moduleList[] = "asset-category";
    $moduleList[] = "asset-purchase";
    $moduleList[] = "claim-request";
    $moduleList[] = "claim-request-log";
    $moduleList[] = "cost-centre";
    $moduleList[] = "cost-centre-sub";
    $moduleList[] = "country";
    $moduleList[] = "district";
    $moduleList[] = "employee";
    $moduleList[] = "funding-agency";
    $moduleList[] = "funding-agency-bu";
    $moduleList[] = "level";
    $moduleList[] = "locationdescription";
    $moduleList[] = "migration";
    $moduleList[] = "page-authentications";
    $moduleList[] = "program";
    $moduleList[] = "project";
    $moduleList[] = "project-budget-line";
    $moduleList[] = "ro";
    $moduleList[] = "state";
    $moduleList[] = "status-details";
    $moduleList[] = "status-master";
    $moduleList[] = "travel-expenses";
    $moduleList[] = "upload";
    $moduleList[] = "user";
    $moduleList[] = "user-levels";
    $moduleList[] = "vendor";
    $moduleList[] = "vendor-contact-person";
//display_array($moduleList);
//exit() ;






    $labeling = [];
    $labeling["asset-category"] = "asset-category";
    $labeling["asset-purchase"] = "asset-purchase";
    $labeling["claim-request"] = "claim-request";
    $labeling["claim-request-log"] = "claim-request-log";
    $labeling["cost-centre"] = "cost-centre";
    $labeling["cost-centre-sub"] = "cost-centre-sub";
    $labeling["country"] = "country";
    $labeling["district"] = "district";
    $labeling["employee"] = "employee";
    $labeling["funding-agency"] = "funding-agency";
    $labeling["funding-agency-bu"] = "funding-agency-bu";
    $labeling["level"] = "level";
    $labeling["locationdescription"] = "locationdescription";
    $labeling["migration"] = "migration";
    $labeling["page-authentications"] = "page-authentications";
    $labeling["program"] = "program";
    $labeling["project"] = "project";
    $labeling["project-budget-line"] = "project-budget-line";
    $labeling["ro"] = "ro";
    $labeling["state"] = "state";
    $labeling["status-details"] = "status-details";
    $labeling["status-master"] = "status-master";
    $labeling["travel-expenses"] = "travel-expenses";
    $labeling["upload"] = "upload";
    $labeling["user"] = "user";
    $labeling["user-levels"] = "user-levels";
    $labeling["vendor"] = "vendor";
    $labeling["vendor-contact-person"] = "vendor-contact-person";


    $bgGroup = [];
    $bgGroup["asset-category"] = "Agriculture";
    $bgGroup["asset-purchase"] = "Dairy";
    $bgGroup["claim-request"] = "Dairy";
    $bgGroup["claim-request-log"] = "Dairy";
    $bgGroup["cost-centre"] = "Agriculture";
    $bgGroup["cost-centre-sub"] = "Agriculture";
    $bgGroup["country"] = "Agriculture";
    $bgGroup["district"] = "Agriculture";
    $bgGroup["employee"] = "Dairy";
    $bgGroup["funding-agency"] = "Agriculture";
    $bgGroup["funding-agency-bu"] = "Agriculture";
    $bgGroup["level"] = "Other";
    $bgGroup["locationdescription"] = "Agriculture";
    $bgGroup["migration"] = "Other";
    $bgGroup["page-authentications"] = "Other";
    $bgGroup["program"] = "Agriculture";
    $bgGroup["project"] = "Agriculture";
    $bgGroup["project-budget-line"] = "Agriculture";
    $bgGroup["ro"] = "Dairy";
    $bgGroup["state"] = "Agriculture";
    $bgGroup["status-details"] = "Agriculture";
    $bgGroup["status-master"] = "Agriculture";
    $bgGroup["travel-expenses"] = "Agriculture";
    $bgGroup["upload"] = "Agriculture";
    $bgGroup["user"] = "Other";
    $bgGroup["user-levels"] = "Other";
    $bgGroup["vendor"] = "Dairy";
    $bgGroup["vendor-contact-person"] = "Dairy";
    ?>


    <div class="row">
        <?php
        $pagerAuthenticationModels = null;

        $authenticationColumnValues = [];
        $approveToColumnValues = [];
        if (!$model->isNewRecord) {
            $pagerAuthenticationModels = backend\models\PageAuthentications::find()->where(['level_id' => $model->id])->all();

            for ($k = 0; $k < count($pagerAuthenticationModels); $k++) {
                $singelePageM = $pagerAuthenticationModels[$k];
                $authenticationColumnValues[] = $singelePageM->authentication;
                if ($singelePageM->approve_to != "" || ($singelePageM->notify_to != "[]" && $singelePageM->notify_to != "")) {
                    $approveToColumnValues[] = $singelePageM->authentication;
                }
            }
        }


        $divide = 0;
        for ($i = 0; $i < count($moduleList); $i++) {
            echo '<div class="col-lg-3">';

            $actions = $basicActions;

            if ($moduleList[$i] == 'site') {
                unset($actions);
                $actions = array();
                $actions[] = 'view-beneficiary-full-info';
                $actions[] = 'index';
            }

            if ($moduleList[$i] == 'claim-request') {
                $actions[] = 'createtravel';
                $actions[] = 'createother';
                $actions[] = 'updatetravel';
                $actions[] = 'return';
                $actions[] = 'updateother';
                $actions[] = 'returny';
                $actions[] = 'formdata';
                $actions[] = 'costcenterformdata';
                
            }

            if (isset($labeling[$moduleList[$i]])) {
                $nameM = $labeling[$moduleList[$i]];
            } else {
                $nameM = ucfirst($moduleList[$i]);
            }
            $cssClass = '';
            if (isset($bgGroup[$moduleList[$i]])) {
                $name = $bgGroup[$moduleList[$i]];

                if ($name == 'Agriculture') {
                    $cssClass = 'bsAgriBgColor';
                } else if ($name == 'Dairy') {
                    $cssClass = 'bsDairyBgColor';
                } else if ($name == 'Household') {
                    $cssClass = 'bsHouseholdBgColor';
                } else {
                    $cssClass = 'bsDefaultBgColor';
                }
            }

            
//            display_array(createUrls($actions, $moduleList[$i]));exit;
            echo "<h4 class = 'bsWarningColor {$cssClass}'>$nameM module</h4>";
            echo '<div class="x_panel">';

            echo "<h5>Pages Authenticated</h5>";
            echo Html::listBox("PageAuthentication[{$i}][authentication]", $authenticationColumnValues, createUrls($actions, $moduleList[$i])
                    , ['class' => 'form-control', 'multiple' => true]);

            echo "<div style='display:none;'>";
            echo "<h4>Approval of</h4>";
            echo Html::listBox("PageAuthentication[{$i}][approve_of]", $approveToColumnValues, createUrls($actions, $moduleList[$i])
                    , ['class' => 'form-control', 'multiple' => true]);


            $releativeActions = [];
            for ($mi = 0; $mi < count($actions); $mi++) {
                $releativeActions[] = $moduleList[$i] . "/" . $actions[$mi];
            }
            $finalApproveTo = '';
            $finalNotifyTo = array();
            if ($pagerAuthenticationModels != null) {
                $notifytoGot = false;
                for ($k = 0; $k < count($pagerAuthenticationModels); $k++) {
                    $singelePageM = $pagerAuthenticationModels[$k];



                    if ($singelePageM->approve_to != "") {
                        if (in_array($singelePageM->authentication, $releativeActions)) {
                            $finalApproveTo = $singelePageM->approve_to;
                        }
                    }


                    if ($singelePageM->notify_to != "[]" || $singelePageM->notify_to != "") {
                        if (in_array($singelePageM->authentication, $releativeActions)) {
                            if ($notifytoGot == false) {
                                $finalNotifyTo = json_decode($singelePageM->notify_to, false);
                                $notifytoGot = true;
                            }
                        }
                    }
                }
            }

//        echo "<h4>Approval To</h4>";yii\helpers\ArrayHelper::map(\app\models\Users::find()->all(), 'id', 'user_name')
            echo Html::dropDownList("PageAuthentication[{$i}][approve_to]", $finalApproveTo, $MUSerLIst, ['prompt' => 'Select.', 'class' => 'form-control']);



            echo "<h4>Notify To</h4>";
            echo Html::listBox("PageAuthentication[{$i}][notify_to]", $finalNotifyTo, $MUSerLIst, ['multiple' => true, 'class' => 'form-control']);

            echo "</div>";
            echo '</div>';
            echo '</div>';

            $divide++;
            if ($divide % 4 == 0) {
                echo '<div class="clearfix"></div>';
            }
        }
        ?>


    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>