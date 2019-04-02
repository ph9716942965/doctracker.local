<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'parent_id',
            [
                'attribute' => 'level_id',
                'filter' => backend\models\Level::getLevelOptions(),
                'value' => function ($data) {
                    return backend\models\Level::getLevelOptions($data->level_id);
                },
            ],
            'username',
//            'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
//            'status',
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]);
    ?>
</div>
