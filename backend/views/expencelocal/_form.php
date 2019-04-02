<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Expencelocal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expencelocal-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-2">
        <?= $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?> 
        </div>
        <div class="col-md-2">
        <label class="control-label" for="expencetype"> Type of Requests:  </label>
        </div>
        <div class="col-md-8">
        <div class="custom-control custom-radio mb-4">
        <input type="radio" class="custom-control-input" id="radio" name="defaultName">
        <label class="custom-control-label" for="radio">Local Conveyance</label>
        <input type="radio" class="custom-control-input" id="radio" name="defaultName">
        <label class="custom-control-label" for="radio">Travel Expenses Claim</label>
        <input type="radio" class="custom-control-input" id="radio" name="defaultName">
        <label class="custom-control-label" for="radio">Others</label>
        
        </div>
        
        
        
        <?php //echo $form->field($model, 'user_id')->textInput(['readonly'=>true]) ?> 
        </div>
        <div class="col-md-2">
        <?php /*echo $form->field($model, 'category_id')->dropDownList(
                ArrayHelper::map(\backend\models\Category::find()->where(['status'=>1])->all(), "id","category_name"),
                [
            'prompt' => 'Select Category',
            'id' => 'category_id',
            ]
        )->label("Category Name"); 
        */?>
        </div>
    </div>
   
    
    <?php //echo $form->field($model, 'status')->textInput() ?>
    <div class="row">
        <div class="col-md-3">
        <?= $form->field($model, 'vfrom')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'vto')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3"><?= $form->field($model, 'mode')->textInput(['maxlength' => true]) ?>
    </div>
        <div class="col-md-3"> <?= $form->field($model, 'date')->textInput() ?>
</div>
    </div>
   <div class="row">
   <div class="col-md-3">
   <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
</div>
   <div class="col-md-9">
   <?= $form->field($model, 'amount_w')->textInput(['maxlength' => true]) ?>
</div>
   </div>

  
   
   
    
    <?= $form->field($model, 'purpose')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'upload')->fileinput(['maxlength' => true]) ?>

    

    <?php // $form->field($model, 'dc')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
