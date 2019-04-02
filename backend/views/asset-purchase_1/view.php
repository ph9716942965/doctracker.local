<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AssetPurchase */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Asset Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-purchase-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->CommonHtml->goBack(\yii\helpers\Url::to(["index"])); ?>
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
            'ro.code',
            ['label' => 'Category name',
                'attribute' => 'category_id',
                'value' => $model->assetCategory->name
            ],
            'name',
            'purpose',
            'members_of_purchase_committee',
            'date',
            'vendor.company_name',
            'amount',
            ['label' => 'Project name',
                'attribute' => 'project_id',
                'value' => $model->project->name
            ],
            'created_at',
            'updated_at',
//            'status',
        ],
    ])
    ?>

</div>
