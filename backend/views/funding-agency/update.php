<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundingAgency */

$this->title = 'Update Funding Agency: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Funding Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="funding-agency-update">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
