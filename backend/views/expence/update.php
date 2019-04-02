<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Expencelocal */

$this->title = 'Update Expencelocal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expencelocals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expencelocal-update">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
