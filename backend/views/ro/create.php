<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ro */

$this->title = 'Create Ro';
$this->params['breadcrumbs'][] = ['label' => 'Ros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ro-create">
    <?= Yii::$app->CommonHtml->goBackWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
