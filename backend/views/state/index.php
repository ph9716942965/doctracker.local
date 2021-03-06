<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'States';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create State', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'country_id',
                'value' => 'country.country_name',
                'filter' => Html::activeDropDownList($searchModel, 'country_id', yii\helpers\ArrayHelper::map(\backend\models\Country::find()->where(['status' => 1])->all(), 'id', 'country_name'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
            'code',
            'state_name',
//            'created_at',
            //'updated_at',
            //'status',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]);
    ?>
</div>
