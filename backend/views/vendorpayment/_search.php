<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorpaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendorpayment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'status_id') ?>

    <?= $form->field($model, 'vendor_id') ?>

    <?= $form->field($model, 'service_by') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'upload_approval') ?>

    <?php // echo $form->field($model, 'upload_bill') ?>

    <?php // echo $form->field($model, 'natural_head') ?>

    <?php // echo $form->field($model, 'program_id') ?>

    <?php // echo $form->field($model, 'funding_agency_id') ?>

    <?php // echo $form->field($model, 'funding_agency_bu_id') ?>

    <?php // echo $form->field($model, 'cost_center_id') ?>

    <?php // echo $form->field($model, 'cost_centre_sub') ?>

    <?php // echo $form->field($model, 'lo') ?>

    <?php // echo $form->field($model, 'comment_ho') ?>

    <?php // echo $form->field($model, 'cv_ref') ?>

    <?php // echo $form->field($model, 'cr_date') ?>

    <?php // echo $form->field($model, 'comment_ac') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
