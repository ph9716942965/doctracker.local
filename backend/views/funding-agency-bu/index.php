<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FundingAgencyBuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Funding Agency Bus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funding-agency-bu-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Funding Agency Bu', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'funding_agency_id',
            'code',
            'name',
            'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>
</div>
