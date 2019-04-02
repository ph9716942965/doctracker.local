<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendorpayment */

$this->title = 'Update Vendorpayment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vendorpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendorpayment-update">

    <h1><?= Html::encode($this->title) ?></h1>
<?php //$model->imgvalid='update'; ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
