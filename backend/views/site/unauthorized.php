<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;

$this->title = $message;
?>
<style type="text/css">
    .calert{
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;    
    }
    .calert-danger{
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
</style>
<section class="content">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-danger"></i></h2>
        <div class="error-content">
            <div class="calert calert-danger">
                You do not have access to this page. Please login with valid user
            </div>

            <a class="btn btn-warning" href='<?= Yii::$app->homeUrl ?>'>Return to home page</a>

        </div>
    </div>

    

</section>
