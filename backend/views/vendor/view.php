<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendor */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-view">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Yii::$app->CommonHtml->goBack(\yii\helpers\Url::to(['index'])); ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'ro_id',
                 'value' => $model->ro->code,
            ],
            'vendor_no',
            'name_unit',
            [
                'attribute' => 'vendor_type',
                 'value' => $model->getVendorType($model->vendor_type),
            ],
            [
                'attribute' => 'applicability',
                 'value' => $model->applicability && $model->applicability == 1 ? 'Company' : 'Individuals',
            ],
            'salutation',
            'first_name',
            'middle_name',
            'last_name',
            'nationality',
            'address:ntext',
            [
                'attribute' => 'country_id',
                 'value' => getGeoLocationName($model->district_id)['country_name'],
            ],
            [
                'attribute' => 'state_id',
                 'value' => getGeoLocationName($model->district_id)['state_name'],
            ],
            [
              'attribute' => 'district_id',
               'value' => $model->district->district_name,
            ],
            'pincode',
            'email_id:email',
            'contact_no',
            'pan_no',
            'company_name',
            'parent_company_name',
            'website',
            'company_address:ntext',
            'company_pincode',
            [
                'attribute' => 'company_country_id',
                 'value' => getGeoLocationName($model->company_district_id)['country_name'],
            ],
            [
                'attribute' => 'company_state_id',
                 'value' => getGeoLocationName($model->company_district_id)['state_name'],
            ],
            [
                'attribute' => 'company_district_id',
                 'value' => $model->companyDistrict->district_name,
            ],
            'bank_name',
            'branch_id',
            'branch_name',
            'branch_address:ntext',
            'bank_pincode',
            [
                'attribute' => 'bank_country_id',
                 'value' => getGeoLocationName($model->bank_district_id)['country_name'],
            ],
            [
                'attribute' => 'bank_state_id',
                 'value' => getGeoLocationName($model->bank_district_id)['state_name'],
            ],
            [
                'attribute' => 'bank_district_id',
                 'value' => $model->bankDistrict->district_name,
            ],
            'bank_account_name',
            'bank_currency',
            'bank_account_no',
            'bank_account_type',
            'ifsc_code',
            'swift_code',
            'iban',
            'cb_bank_name',
            'cb_address:ntext',
            'cb_account_no',
            'cb_swift_code',
            [
                'attribute' => 'status',
                'value' => $model->status ? 'Active' : 'Inactive',
            ],
            'updated_at',
            'created_at',
        ],
    ]); ?>

</div>
