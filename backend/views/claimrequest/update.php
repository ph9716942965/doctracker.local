<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */

$this->title = 'Update Claim Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Claim Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="claim-request-update">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
