<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'ro_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Ro::find()->where(['status' => 1])->all(), 'id', 'code'), ["prompt" => "Select"]); ?>

                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'email_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'contact_no')->textInput(['maxlength' => true]) ?>
                    <?php
                    if ($model->isNewRecord) {
                        $model->user_id = backend\models\User::getSessionUserId();
                        echo $form->field($model, 'user_id')->hiddenInput()->label(false);
                    }
                    ?>
                </div>
            </div>
        </div>
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
