<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Programs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="program-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Program', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'district_id',
                'value' => 'district.district_name',
                'filter' => Html::activeDropDownList($searchModel, 'district_id', yii\helpers\ArrayHelper::map(\backend\models\District::find()->where(['status' => 1])->all(), 'id', 'district_name'), ['class' => 'form-control', 'prompt' => 'Select']),
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
