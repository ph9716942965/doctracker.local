<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CostCentre */

$this->title = 'Create Cost Centre';
$this->params['breadcrumbs'][] = ['label' => 'Cost Centres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-centre-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
