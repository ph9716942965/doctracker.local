<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProjectBudgetLine */

$this->title = 'Create Project Budget Line';
$this->params['breadcrumbs'][] = ['label' => 'Project Budget Lines', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-budget-line-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
