<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CostCentreSub */

$this->title = 'Update Cost Centre Sub: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cost Centre Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cost-centre-sub-update">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
