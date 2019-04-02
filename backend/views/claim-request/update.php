<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ClaimRequest */

$this->title = 'Take Action: ';
$this->params['breadcrumbs'][] = ['label' => 'Claim Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="claim-request-update">
<?= Yii::$app->CommonHtml->goIndexWithConfirm(); ?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php /*
if($model->request_type=='Other Expenses'){
    echo $this->render('_formotherupdate', [ 'model' => $model, ]);
}elseif($model->request_type=='Local Conveyance'){
    echo $this->render('_formupdate', [ 'model' => $model, ]);
}elseif($model->request_type=='Travel Expenses'){
    echo $this->render('_formtravelupdate', [ 'model' => $model, ]);
}else{
    echo $this->render('_formtravelupdate', [ 'model' => $model, ]);
}*/

?>

    <?php  echo $this->render('_formupdate', [
        'model' => $model,
    ]) ?>

</div>
