<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Expencelocal */

$this->title = 'Create Expencelocal';
$this->params['breadcrumbs'][] = ['label' => 'Expencelocals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expencelocal-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
