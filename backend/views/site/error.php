<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$name = $exception->getName();

$this->title = $name;
$statusCode = $exception->statusCode;
$message = $exception->getMessage();
?>
<style type="text/css">
    .calert{
        /*padding: 15px;*/
        padding-left:   15px;
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


<!-- Main content -->
<section class="content">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="error-page">
        <h2 class="headline text-danger">  <?= nl2br(Html::encode($statusCode)) ?></h2>

        <div class="error-content">
            <div class="calert calert-danger">
                <h3><i class="fa fa-warning text-danger"></i> <?= nl2br(Html::encode($message)) ?></h3>
            </div>
            <p>
                The above error occurred while the Web server was processing your request.
                <br>
                Meanwhile, you may <a  href='<?= Yii::$app->homeUrl ?>'>return to dashboard</a>
            </p>

            <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i>For more details</i></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="display: none;">
                    <?= nl2br(Html::encode($exception)) ?>
                </div>
            </div>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
