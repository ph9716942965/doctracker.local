<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserLevels */
/* @var $form yii\widgets\ActiveForm */
?>

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
    
    
    
    
    
    
    <?php $index = 0; ?>
    <div class="row">
        <div class="col-lg-2" >
            <h3>Users</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Users";
            $fieldValue = 'users/create';
            $index = 0;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Users";
            $fieldValue = 'users/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Users";
            $fieldValue = 'users/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Users";
            $fieldValue = 'users/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        <div class="col-lg-2" >
            <h3>User Levels</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create User Levels";
            $fieldValue = 'user-levels/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit User Levels";
            $fieldValue = 'user-levels/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View User Levels";
            $fieldValue = 'user-levels/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List User Levels";
            $fieldValue = 'user-levels/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Candidate</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Candidate";
            $fieldValue = 'candidate/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Candidate";
            $fieldValue = 'candidate/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Candidate";
            $fieldValue = 'candidate/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Candidate";
            $fieldValue = 'candidate/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        
        <div class="col-lg-2" >
            <h3>Manage Centre</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Centre";
            $fieldValue = 'centers/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Centre";
            $fieldValue = 'centers/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Centre";
            $fieldValue = 'centers/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Centre";
            $fieldValue = 'centers/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Courses</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Courses";
            $fieldValue = 'courses/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Courses";
            $fieldValue = 'courses/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Courses";
            $fieldValue = 'courses/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Courses";
            $fieldValue = 'courses/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Dependants</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Dependants";
            $fieldValue = 'dependants/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Dependants";
            $fieldValue = 'dependants/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Dependants";
            $fieldValue = 'dependants/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Dependants";
            $fieldValue = 'dependants/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        
        <div class="col-lg-2" >
            <h3>Manage Employee</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Employee";
            $fieldValue = 'employee/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Employee";
            $fieldValue = 'employee/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Employee";
            $fieldValue = 'employee/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Employee";
            $fieldValue = 'employee/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        
        
         <div class="col-lg-2" >
            <h3>Manage Partners</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Partners";
            $fieldValue = 'partners/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Partners";
            $fieldValue = 'partners/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Partners";
            $fieldValue = 'partners/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Partners";
            $fieldValue = 'partners/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage States</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create States";
            $fieldValue = 'states/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit States";
            $fieldValue = 'states/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View States";
            $fieldValue = 'states/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List States";
            $fieldValue = 'states/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Training</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Training Calendar";
            $fieldValue = 'training_calendar/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Training Calendar";
            $fieldValue = 'training_calendar/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Training Calendar";
            $fieldValue = 'training_calendar/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Training Calendar";
            $fieldValue = 'training_calendar/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        
        
        <div class="col-lg-2" >
            <h3>Manage District</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create District";
            $fieldValue = 'district/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit District";
            $fieldValue = 'district/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View District";
            $fieldValue = 'district/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List District";
            $fieldValue = 'district/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Quota</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Quota";
            $fieldValue = 'quota/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Quota";
            $fieldValue = 'quota/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Quota";
            $fieldValue = 'quota/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Quota";
            $fieldValue = 'quota/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Allotment Quota";
            $fieldValue = 'quota/allotment';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";

            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Employer</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Employer";
            $fieldValue = 'employer/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Employer";
            $fieldValue = 'employer/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Employer";
            $fieldValue = 'employer/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Employer";
            $fieldValue = 'employer/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        
        <div class="col-lg-2" >
            <h3>Manage Financial Year</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Financial Year";
            $fieldValue = 'financial-year/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Financial Year";
            $fieldValue = 'financial-year/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Financial Year";
            $fieldValue = 'financial-year/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Financial Year";
            $fieldValue = 'financial-year/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        
        <div class="col-lg-2" >
            <h3>Manage Modules</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Modules";
            $fieldValue = 'modules/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Modules";
            $fieldValue = 'modules/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Modules";
            $fieldValue = 'modules/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Modules";
            $fieldValue = 'modules/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        <div class="col-lg-2" >
            <h3>Sector</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Sector";
            $fieldValue = 'sector/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Sector";
            $fieldValue = 'sector/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Sector";
            $fieldValue = 'sector/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Sector";
            $fieldValue = 'sector/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        
        <div class="col-lg-2" >
            <h3>User Type</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create User Type";
            $fieldValue = 'user-type/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit User Type";
            $fieldValue = 'user-type/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View User Type";
            $fieldValue = 'user-type/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List User Type";
            $fieldValue = 'user-type/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        <div class="col-lg-2" >
            <h3>Reports</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Center wise Report";
            $fieldValue = 'centers/center-wise-report';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            
            echo "<h4>";
            $fieldName = "District wise Report";
            $fieldValue = 'district/district-wise-report';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "All India Report";
            $fieldValue = 'district/export-all';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        
        <div class="col-lg-2" >
            <h3>Smart Center Type</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Smart Center Type";
            $fieldValue = 'smart-center-type/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Smart Center Type";
            $fieldValue = 'smart-center-type/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Smart Center Type";
            $fieldValue = 'smart-center-type/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Smart Center Type";
            $fieldValue = 'smart-center-type/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        <div class="col-lg-2" >
            <h3>Manage Qualification</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Qualification";
            $fieldValue = 'qualification/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Qualification";
            $fieldValue = 'qualification/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Qualification";
            $fieldValue = 'qualification/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Qualification";
            $fieldValue = 'qualification/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Annual Target</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Annual Target";
            $fieldValue = 'annual-targets/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Annual Target";
            $fieldValue = 'annual-targets/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Annual Target";
            $fieldValue = 'annual-targets/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Annual Target";
            $fieldValue = 'annual-targets/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Position</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Position";
            $fieldValue = 'position/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Position";
            $fieldValue = 'position/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Position";
            $fieldValue = 'position/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Position";
            $fieldValue = 'position/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Brand Names</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Brand Names";
            $fieldValue = 'brand-names/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Brand Names";
            $fieldValue = 'brand-names/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Brand Names";
            $fieldValue = 'brand-names/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Brand Names";
            $fieldValue = 'brand-names/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        <div class="col-lg-2" >
            <h3>Manage Designation</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Designation";
            $fieldValue = 'designation/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Designation";
            $fieldValue = 'designation/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Designation";
            $fieldValue = 'designation/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Designation";
            $fieldValue = 'designation/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        
        
        <div class="col-lg-2" >
            <h3>Manage NSDC Broad Economic Sectors</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create NSDC Broad Economic Sectors";
            $fieldValue = 'nsdc-broad-economic-sector/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit NSDC Broad Economic Sectors";
            $fieldValue = 'nsdc-broad-economic-sector/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View NSDC Broad Economic Sectors";
            $fieldValue = 'nsdc-broad-economic-sector/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List NSDC Broad Economic Sectors";
            $fieldValue = 'nsdc-broad-economic-sector/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Manage Sector Skill Council</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Sector Skill Council";
            $fieldValue = 'sector-skill-council/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Sector Skill Council";
            $fieldValue = 'sector-skill-council/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Sector Skill Council";
            $fieldValue = 'sector-skill-council/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Sector Skill Council";
            $fieldValue = 'sector-skill-council/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        <div class="col-lg-2" >
            <h3>Manage Job Role</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Create Job Role";
            $fieldValue = 'job-role/create';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Edit Job Role";
            $fieldValue = 'job-role/update';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "View Job Role";
            $fieldValue = 'job-role/view';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            echo "<h4>";
            $fieldName = "List Job Role";
            $fieldValue = 'job-role/index';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            ?>
        </div>
        
        <div class="col-lg-2" >
            <h3>Graphs</h3>
            <?php
            
            echo "<h4>";
            $fieldName = "Candidate Gender Distribution";
            $fieldValue = 'candidate/graph-gender-distribution';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Sector Wise Placement Companies";
            $fieldValue = 'employer/sector-wise-placement-companies';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            echo "<h4>";
            $fieldName = "Graph Smart Centre Distribution";
            $fieldValue = 'centers/graph-smart-center-distribution';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            
            echo "<h4>";
            $fieldName = "Graph Center Wise Candidate Comparison";
            $fieldValue = 'centers/graph-center-wise-candidate-comparison';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            
            echo "<h4>";
            $fieldName = "Joined Student Distribution";
            $fieldValue = 'candidate/graph-joined-student-distribution';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            
            
            
            echo "<h4>";
            $fieldName = "Placed Student Distribution";
            $fieldValue = 'candidate/graph-placed-student-distribution';
            $index++;
            echo Html::hiddenInput('LevelAuthenticationsCustom['.$index.'][name]',$fieldValue);
            echo Html::checkbox('LevelAuthenticationsCustom['.$index.'][value]', (strpos($levelArrayFromDb, $fieldValue) !== false ? true : false), ['label' => $fieldName])."";
            echo "</h4>";
            
            
            
            ?>
        </div>
        
    </div>
    
    <?php // $form->field($model, 'level_authentications')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
