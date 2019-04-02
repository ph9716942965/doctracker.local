<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExpenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Expence';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expence-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Expence', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'expencetype',
            'id',
            'amount',
            'purpose',
            'date',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]); ?>

    
    <?php Pjax::end(); ?>
</div>
