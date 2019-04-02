<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FundingAgencyBu */

$this->title = 'Create Funding Agency Bu';
$this->params['breadcrumbs'][] = ['label' => 'Funding Agency Bus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funding-agency-bu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
