<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Expencelocal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Expencelocals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expencelocal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::$app->CommonHtml->goBack(\yii\helpers\Url::to(["index"])); ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'status',
            'vfrom',
            'vto',
            'mode',
            'amount',
            'amount_w',
            'purpose',
            'upload',
            'date',
            'dc',
            'update_at',
        ],
    ]) ?>

</div>
