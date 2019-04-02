<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ro-index">
    <div class="pull-right">
        <?php echo common\widgets\Alert::widget(); ?>
    </div>
    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
        <?= Html::a('Create Ro', ['create'], ['class' => 'btn btn-success']); ?>
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
            'first_name',
            'last_name',
            'email_id:email',
            'contact_no',
            //'status',
            //'user_id',
            //'created_at',
            //'updated_at',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'color:#337ab7']],
        ],
    ]);
    ?>
</div>
