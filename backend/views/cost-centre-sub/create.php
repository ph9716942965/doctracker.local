<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CostCentreSub */

$this->title = 'Create Cost Centre Sub';
$this->params['breadcrumbs'][] = ['label' => 'Cost Centre Subs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-centre-sub-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
