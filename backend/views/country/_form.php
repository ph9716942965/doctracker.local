<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="country-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>
 -->
 
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
	             	<div class="row">
		        		<div class="col-md-6">
		                	<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
		                </div>
		                <div class="col-md-6">
		                	<?= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>
		                </div>
	              	</div>
                </div>
            </div>
        </div>
    </div>
   <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
    <?php ActiveForm::end(); ?>

</div>
