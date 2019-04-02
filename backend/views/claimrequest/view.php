<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Claim Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->CommonHtml->goBack(\yii\helpers\Url::to(["index"])); ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'state_id',
            'request_type',
            'visit_from',
            'visit_to',
            'mode',
            'date',
            'amount',
            'amount2',
            'amount3',
            'amount4',
            'amount5',
            'amountinword',
            'purpose',
            'dc',
            'fund_agency',
            'nature_service',
            'ro_comment',
            'naturehead',
            'project_id',
            'project_budget_line_id',
            'costcenter_id',
            'program_id',
            'locationdescription_id',
            'ho_comment',
            'tds',
            'advance',
            'net',
            'refnumber',
            'refdate',
            'create_at',
            'update_at',
            'active',
        ],
    ]) ?>

</div>
