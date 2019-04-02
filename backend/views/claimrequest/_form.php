<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'state_id')->textInput() ?>

    <?= $form->field($model, 'visit_from')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visit_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amountinword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purpose')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fund_agency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nature_service')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ro_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'naturehead')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_id')->textInput() ?>

    <?= $form->field($model, 'project_budget_line_id')->textInput() ?>

    <?= $form->field($model, 'costcenter_id')->textInput() ?>

    <?= $form->field($model, 'program_id')->textInput() ?>

    <?= $form->field($model, 'locationdescription_id')->textInput() ?>

    <?= $form->field($model, 'ho_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tds')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'advance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refnumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'refdate')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
