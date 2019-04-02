<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CostCentre */

$this->title = 'Update Cost Centre: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cost Centres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cost-centre-update">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
