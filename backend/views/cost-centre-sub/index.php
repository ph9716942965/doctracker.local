<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CostCentreSubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cost Centre Subs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-centre-sub-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Cost Centre Sub', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'cost_centre_id',
                'value' => 'costCentre.name',
                'filter' => Html::activeDropDownList($searchModel, 'cost_centre_id', yii\helpers\ArrayHelper::map(\backend\models\CostCentre::find()->where(['status' => 1])->all(), 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Select']),
            ],
            'code',
            'name',
//            'created_at',
            //'updated_at',
            //'status',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]);
    ?>
</div>
