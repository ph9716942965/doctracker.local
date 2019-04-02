<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ExpenceTravel */

$this->title = 'Create Expence Travel';
$this->params['breadcrumbs'][] = ['label' => 'Expence Travels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expence-travel-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
