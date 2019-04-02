<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Locationdescription */

$this->title = 'Create Location Description';
$this->params['breadcrumbs'][] = ['label' => 'Locationdescriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="locationdescription-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
