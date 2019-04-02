<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AssetPurchase */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Asset Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asset-purchase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['label' => 'RO Code',
                'attribute' => 'ro_id',
                'value' => $model->ro->code
            ],
            [
                'attribute' => 'asset_category_id',
                'value' => $model->assetCategory->name
            ],
            'name',
            'purpose',
            'members_of_purchase_committee',
            'date',
            'vendor.company_name',
            'amount',
            ['label' => 'Project Code',
                'attribute' => 'project_id',
                'value' => $model->project->code
            ],
            [
                'attribute' => 'file_purchase_request_apporval',
                'value' => $model->file_purchase_request_apporval,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            [
                'attribute' => 'file_quotation',
                'value' => $model->file_quotation,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            [
                'attribute' => 'file_purchase_commite',
                'value' => $model->file_purchase_commite,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            [
                'attribute' => 'file_purchase_order',
                'value' => $model->file_purchase_order,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            [
                'attribute' => 'file_pro_forma_final_invoice',
                'value' => $model->file_pro_forma_final_invoice,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'natural_head',
            [
                'attribute' => 'program_id',
                'value' => !empty($model->program->code) ? $model->program->code : ""
            ],
            [
                'attribute' => 'funding_agency_id',
                'value' => !empty($model->fundingAgency->code) ? $model->fundingAgency->code : ""
            ],
            [
                'attribute' => 'funding_agency_bu_id',
                'value' => !empty($model->fundingAgencyBu->code) ? $model->fundingAgencyBu->code : ""
            ],
            [
                'attribute' => 'cost_centre_id',
                'value' => !empty($model->costCentre->code) ? $model->costCentre->code : ""
            ],
            [
                'attribute' => 'cost_centre_sub_id',
                'value' => !empty($model->costCentreSub->code) ? $model->costCentreSub->code : ""
            ],
            'lo',
            'ho_comment',
            'ref_number',
            'ref_date',
            'ac_comment:ntext',
            'created_at',
            'updated_at',
        ],
    ])
    ?>

</div>
