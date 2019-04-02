<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
$USERAUTH = new CheckAuth2($_SESSION['login_info']['username']);
/* @var $this yii\web\View */
/* @var $model backend\models\Vendorpayment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendorpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendorpayment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            [ 'format' => 'html', 
               'label' => 'Status',
               //'attribute'=>'rep_link', 
              // 'filter'=>['1'=>'text','2'=>'jpg'], //with custome sarch
               'value'=>function ($data){ return '<SMALL>'.$data->status_id.'</SMALL>';} 
             ],
           // 'status_id',
            'vendor_id',
            'service_by',
            'amount',
            'purpose',
            'project_id',
            'upload_approval',
            'upload_bill',
            'natural_head',
            'program_id',
            'funding_agency_id',
            'funding_agency_bu_id',
            'cost_center_id',
            'cost_centre_sub',
            'lo',
            'comment_ho',
            'cv_ref',
            'cr_date',
            'comment_ac',
        ],
    ]) ?>

</div>
