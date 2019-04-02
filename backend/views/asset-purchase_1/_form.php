<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AssetPurchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asset-purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-body">

                    <?= $form->field($model, 'ro_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Ro::find()->where(['status' => 1])->all(), 'id', 'code'), ["prompt" => "Select"]); ?>

                    <?= $form->field($model, 'asset_category_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\AssetCategory::find()->where(['status' => 1])->all(), 'id', 'name'), ["prompt" => "Select"]); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'purpose')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'members_of_purchase_committee')->textInput(['maxlength' => true]) ?>

                </div>
            </div>
            <!-- /.box -->

        </div>

        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-body">



                    <?= $form->field($model, 'date')->textInput(["class" => "form-control datePicker"]) ?>

                    <?= $form->field($model, 'vendor_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Vendor::find()->where(['status' => 1])->all(), 'id', 'company_name'), ["prompt" => "Select"]); ?>

                    <?= $form->field($model, 'amount')->textInput() ?>

                    <?= $form->field($model, 'project_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Project::find()->where(['status' => 1])->all(), 'id', 'name'), ["prompt" => "Select"]); ?>
                    <?php
                    if ($model->isNewRecord) {
                        $model->user_id = backend\models\User::getSessionUserId();
                        echo $form->field($model, 'user_id')->hiddenInput()->label(false);
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
