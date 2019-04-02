<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ExpenceTravel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expence-travel-form">

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
        </div>
    </div>

    <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'vfrom')->textInput(['maxlength' => true]) ?></div>
   <div class="col-md-3"><?= $form->field($model, 'vto')->textInput(['maxlength' => true]) ?></div>
   <div class="col-md-3"><?= $form->field($model, 'date')->textInput() ?></div>
   </div>

   <div class="row">
   <div class="col-md-3"><?= $form->field($model, 'mode')->textInput(['maxlength' => true]) ?>
</div>
   <div class="col-md-3"> <?= $form->field($model, 'fare')->textInput(['maxlength' => true]) ?>
</div>
   </div>
   <div class="row">
   <div class="col-md-4">
   <?= $form->field($model, 'convence')->textInput(['maxlength' => true]) ?></div>
   <div class="col-md-4"><?= $form->field($model, 'hexpence')->textInput(['maxlength' => true]) ?>
</div>
   </div>
   <div class="row">
   <div class="col-md-4"> <?= $form->field($model, 'miscellaneous')->textInput(['maxlength' => true]) ?>
</div>
   <div class="col-md-4"><?= $form->field($model, 'food')->textInput(['maxlength' => true]) ?>
</div>
   </div>
   <div class="row">
   <div class="col-md-8"><?= $form->field($model, 'purpose')->textarea(['maxlength' => true]) ?>
</div>
   </div>

   <div class="row">
   <div class="col-md-3"> <?= $form->field($model, 'travelapproval')->fileInput(['maxlength' => true]) ?>
</div>
   <div class="col-md-3"><?= $form->field($model, 'tickets')->fileInput(['maxlength' => true]) ?>
</div>
<div class="col-md-3"><?= $form->field($model, 'hotelbill')->fileInput(['maxlength' => true]) ?>

</div>
   </div>
   
   <div class="row">
   <div class="col-md-3"> <?= $form->field($model, 'taxibill')->fileInput(['maxlength' => true]) ?></div>
   <div class="col-md-3"> <?= $form->field($model, 'foodbill')->fileInput(['maxlength' => true]) ?>
</div>
   </div>

    <?php // $form->field($model, 'dc')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
