<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VendorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendor-index">
 <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Vendor', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'ro_id',
                'value' => 'ro.code',
                'filter' => Html::activeDropDownList($searchModel, 'ro_id', yii\helpers\ArrayHelper::map(\backend\models\Ro::find()->where(['status' => 1])->all(), 'id', 'code'), ['prompt' => 'Select', 'class' => 'form-control']),
            ],
            'vendor_no',
            'name_unit',
            [
                'attribute' => 'vendor_type',
                 'value' => function ($data) {
                     return  $data->getVendorType($data->vendor_type);
                 },
                 'filter' => Html::activeDropDownList($searchModel, 'vendor_type', dropdownVendorType(), ['prompt' => 'Select', 'class' => 'form-control']),
            ],
            [
                'attribute' => 'applicability',
                 'value' => function ($data) {
                     return  $data->applicability && $data->applicability == 1 ? 'Company' : 'Individuals';
                 },
                 'filter' => Html::activeDropDownList($searchModel, 'applicability', ['0' => 'Individuals', '1' => 'Company'], ['prompt' => 'Select', 'class' => 'form-control']),
            ],
            //'applicability',
            //'salutation',
            //'first_name',
            //'middle_name',
            //'last_name',
            //'nationality',
            //'address:ntext',
            //'district_id',
            //'pincode',
            //'email_id:email',
            //'contact_no',
            //'pan_no',
            //'company_name',
            //'parent_company_name',
            //'website',
            //'company_address:ntext',
            //'company_pincode',
            //'company_district_id',
            //'bank_name',
            //'branch_id',
            //'branch_name',
            //'branch_address:ntext',
            //'bank_pincode',
            //'bank_district_id',
            //'bank_account_name',
            //'bank_currency',
            //'bank_account_no',
            //'bank_account_type',
            //'ifsc_code',
            //'swift_code',
            //'iban',
            //'cb_bank_name',
            //'cb_address:ntext',
            //'cb_account_no',
            //'cb_swift_code',
            //'status',
            //'updated_at',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>
</div>
