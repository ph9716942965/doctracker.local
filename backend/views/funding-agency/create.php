<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FundingAgency */

$this->title = 'Create Funding Agency';
$this->params['breadcrumbs'][] = ['label' => 'Funding Agencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funding-agency-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
