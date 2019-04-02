<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AssetPurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asset Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-purchase-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Asset Purchase', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'ro_id',
                'value' => 'ro.code',
                'filter' => Html::activeDropDownList($searchModel, 'ro_id', yii\helpers\ArrayHelper::map(\backend\models\Ro::find()->where(['status' => 1])->all(), 'id', 'code'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
            [
                'attribute' => 'asset_category_id',
                'value' => 'assetCategory.name',
                'filter' => Html::activeDropDownList($searchModel, 'asset_category_id', yii\helpers\ArrayHelper::map(\backend\models\AssetCategory::find()->where(['status' => 1])->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
            'name',
            'purpose',
            'members_of_purchase_committee',
            'date',
            [
                'attribute' => 'vendor_id',
                'value' => 'vendor.company_name',
                'filter' => Html::activeDropDownList($searchModel, 'vendor_id', yii\helpers\ArrayHelper::map(\backend\models\Vendor::find()->where(['status' => 1])->all(), 'id', 'company_name'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
            'amount',
            [
                'attribute' => 'project_id',
                'value' => 'project.name',
                'filter' => Html::activeDropDownList($searchModel, 'project_id', yii\helpers\ArrayHelper::map(\backend\models\Project::find()->where(['status' => 1])->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
//'members_of_purchase_committee',
//'date',
//'vendor_id',
//'amount',
//'project_id',
//'file_purchase_request_apporval',
//'file_quotation',
//'file_purchase_commite',
//'file_purchase_order',
//'file_pro_forma_final_invoice',
//'natural_head',
//'program_id',
//'funding_agency_id',
//'funding_agency_bu_id',
//'cost_centre_id',
//'cost_centre_sub_id',
//'lo',
//'ho_comment',
//'ref_number',
//'ref_date',
//'ac_comment:ntext',
//'status',
//'user_id',
         ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]);
    ?>
</div>
