<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserLevelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Levels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-levels-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create User Levels', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header'=> 'S No','contentOptions'=>['style'=>'width: 60px;text-align: center;']],

//            'id',
            'level_name',
//            'level_authentications',

            [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action', 
            'template' => '{update}',
        ],
        ],
    ]); ?>

</div>
