<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CostCentreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cost Centres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cost-centre-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Cost Centre', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'code',
            'name',
//            'created_at',
//            'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>
</div>
