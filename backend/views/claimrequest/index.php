<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClaimRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Claim Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="claim-request-index">
     <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Claim Request', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'state_id',
            'request_type',
            'visit_from',
            //'visit_to',
            //'mode',
            //'date',
            //'amount',
            //'amount2',
            //'amount3',
            //'amount4',
            //'amount5',
            //'amountinword',
            //'purpose',
            //'dc',
            //'fund_agency',
            //'nature_service',
            //'ro_comment',
            //'naturehead',
            //'project_id',
            //'project_budget_line_id',
            //'costcenter_id',
            //'program_id',
            //'locationdescription_id',
            //'ho_comment',
            //'tds',
            //'advance',
            //'net',
            //'refnumber',
            //'refdate',
            //'create_at',
            //'update_at',
            //'active',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
