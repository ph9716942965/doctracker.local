<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DistrictSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Districts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create District', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'state_id',
                'value' => 'state.state_name',
                'filter' => Html::activeDropDownList($searchModel, 'state_id', yii\helpers\ArrayHelper::map(\backend\models\State::find()->where(['status' => 1])->all(), 'id', 'state_name'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
            'code',
            'district_name',
//            'created_at',
            //'updated_at',
            //'status',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]);
    ?>
</div>
