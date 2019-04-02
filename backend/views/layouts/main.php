<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

//$session = Yii::$app->session;
//if (!$session->isActive) {
//    $session->open();
//}
//
//$pageM = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
//if (empty($session->get("login_info"))) {
//    if ($pageM != "site/login" && $pageM != "forgot/request-password-reset" && $pageM != "forgot/reset-password") {
//        Yii::$app->getResponse()->redirect(["site/login"])->send();
//        exit(0);
//    }
//}

if (Yii::$app->controller->action->id === 'login') {
    /**
     * Do not use this code in your template. Remove it. 
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render(
            'main-login', ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?= Html::csrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
            <link rel="stylesheet" href="<?php echo yii\helpers\Url::to("@web/plugins/jquery-ui/jquery-ui.min.css"); ?>">
        </head>
        <body class="hold-transition skin-blue sidebar-mini">

            <?php $this->beginBody() ?>
            <div class="wrapper">

                <?=
                $this->render(
                        'header.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?=
                $this->render(
                        'left.php', ['directoryAsset' => $directoryAsset]
                )
                ?>

                <?=
                $this->render(
                        'content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]
                )
                ?>

            </div>

            <?php $this->endBody() ?>
            <script type="text/javascript" src="<?php echo yii\helpers\Url::to("@web/plugins/jquery-ui/jquery-ui.min.js"); ?>"></script>
            <script type="text/javascript" src="<?php echo yii\helpers\Url::to("@web/js/common.js"); ?>"></script>
        </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
