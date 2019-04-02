<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectBudgetLine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-budget-line-form">

    <?php $form = ActiveForm::begin(); ?>

	    <div class="row">
	        <div class="col-md-12">
	            <div class="box box-primary">
	                <div class="box-body">
		             	<div class="row">
			        		<div class="col-md-4">
						  	 	<?= $form->field($model, 'project_id')->dropDownList(yii\helpers\ArrayHelper::map(\backend\models\Project::find()->where(['status' => 1])->all(), 'id', 'name'), ["prompt" => "Select"]); ?>
							</div>
							<div class="col-md-4">
							 	<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
							</div>
							<div class="col-md-4">
							 	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
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
