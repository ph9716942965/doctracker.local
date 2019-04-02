<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ExpenceTravelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expence-travel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'vfrom') ?>

    <?= $form->field($model, 'vto') ?>

    <?php // echo $form->field($model, 'mode') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'fare') ?>

    <?php // echo $form->field($model, 'convence') ?>

    <?php // echo $form->field($model, 'hexpence') ?>

    <?php // echo $form->field($model, 'miscellaneous') ?>

    <?php // echo $form->field($model, 'food') ?>

    <?php // echo $form->field($model, 'travelapproval') ?>

    <?php // echo $form->field($model, 'tickets') ?>

    <?php // echo $form->field($model, 'hotelbill') ?>

    <?php // echo $form->field($model, 'taxibill') ?>

    <?php // echo $form->field($model, 'foodbill') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'dc') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
