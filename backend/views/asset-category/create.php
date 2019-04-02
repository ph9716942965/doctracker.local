<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AssetCategory */

$this->title = 'Create Asset Category';
$this->params['breadcrumbs'][] = ['label' => 'Asset Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asset-category-create">
	<?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
