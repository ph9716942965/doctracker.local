<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExpenceTravelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expence Travels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expence-travel-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Expence Travel', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'status',
            'vfrom',
            'vto',
            //'mode',
            //'purpose',
            //'fare',
            //'convence',
            //'hexpence',
            //'miscellaneous',
            //'food',
            //'travelapproval',
            //'tickets',
            //'hotelbill',
            //'taxibill',
            //'foodbill',
            //'date',
            //'dc',
            //'update_at',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
