<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($model->username) ?></h1>

    <p>
        <?= Yii::$app->CommonHtml->goBack(\yii\helpers\Url::to(["index"])); ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'parent_id',
            [
                'attribute' => 'level_id',
                'value' => backend\models\Level::getLevelOptions($model->level_id)
            ],
                        'username',

//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
//            'status',
            'created_at',
            'updated_at',
        ],
    ])
    ?>

</div>
