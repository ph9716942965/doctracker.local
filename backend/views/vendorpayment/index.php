<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorpaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendorpayments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendorpayment-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
    <?php
    if(\CheckAuth2::obj($_SESSION['login_info']['username'])->Checkuser()!='AC'){
        echo Html::a('Create Vendorpayment', ['create'], ['class' => 'btn btn-success']);
    }
    ?>
       
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'status_id',
            'vendor_id',
            'service_by',
            //'amount',
            //'purpose',
            //'project_id',
            //'upload_approval',
            //'upload_bill',
            //'natural_head',
            //'program_id',
            //'funding_agency_id',
            //'funding_agency_bu_id',
            //'cost_center_id',
            //'cost_centre_sub',
            //'lo',
            //'comment_ho',
            //'cv_ref',
            //'cr_date',
            //'comment_ac',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
