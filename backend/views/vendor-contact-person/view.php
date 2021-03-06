<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\VendorContactPerson */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Contact People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vendor-contact-person-view">

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
            'vendor_id',
            'name',
            'title',
            'address:ntext',
            'contact_no',
            'pan_no',
            'service_tax_no',
            'email_id:email',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
