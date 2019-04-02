<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="claim-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'state_id') ?>

    <?= $form->field($model, 'request_type') ?>

    <?= $form->field($model, 'visit_from') ?>

    <?php // echo $form->field($model, 'visit_to') ?>

    <?php // echo $form->field($model, 'mode') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'amount2') ?>

    <?php // echo $form->field($model, 'amount3') ?>

    <?php // echo $form->field($model, 'amount4') ?>

    <?php // echo $form->field($model, 'amount5') ?>

    <?php // echo $form->field($model, 'amountinword') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'dc') ?>

    <?php // echo $form->field($model, 'fund_agency') ?>

    <?php // echo $form->field($model, 'nature_service') ?>

    <?php // echo $form->field($model, 'ro_comment') ?>

    <?php // echo $form->field($model, 'naturehead') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'project_budget_line_id') ?>

    <?php // echo $form->field($model, 'costcenter_id') ?>

    <?php // echo $form->field($model, 'program_id') ?>

    <?php // echo $form->field($model, 'locationdescription_id') ?>

    <?php // echo $form->field($model, 'ho_comment') ?>

    <?php // echo $form->field($model, 'tds') ?>

    <?php // echo $form->field($model, 'advance') ?>

    <?php // echo $form->field($model, 'net') ?>

    <?php // echo $form->field($model, 'refnumber') ?>

    <?php // echo $form->field($model, 'refdate') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'active') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
