<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ExpenceOther */

$this->title = 'Create Expence Other';
$this->params['breadcrumbs'][] = ['label' => 'Expence Others', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expence-other-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
