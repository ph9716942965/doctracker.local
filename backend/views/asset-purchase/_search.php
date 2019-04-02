<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AssetPurchaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-purchase-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ro_id') ?>

    <?= $form->field($model, 'asset_category_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'members_of_purchase_committee') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'vendor_id') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'file_purchase_request_apporval') ?>

    <?php // echo $form->field($model, 'file_quotation') ?>

    <?php // echo $form->field($model, 'file_purchase_commite') ?>

    <?php // echo $form->field($model, 'file_purchase_order') ?>

    <?php // echo $form->field($model, 'file_pro_forma_final_invoice') ?>

    <?php // echo $form->field($model, 'natural_head') ?>

    <?php // echo $form->field($model, 'program_id') ?>

    <?php // echo $form->field($model, 'funding_agency_id') ?>

    <?php // echo $form->field($model, 'funding_agency_bu_id') ?>

    <?php // echo $form->field($model, 'cost_centre_id') ?>

    <?php // echo $form->field($model, 'cost_centre_sub_id') ?>

    <?php // echo $form->field($model, 'lo') ?>

    <?php // echo $form->field($model, 'ho_comment') ?>

    <?php // echo $form->field($model, 'ref_number') ?>

    <?php // echo $form->field($model, 'ref_date') ?>

    <?php // echo $form->field($model, 'ac_comment') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
