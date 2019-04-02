<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">DocT</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php
                $pageM = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
                $session = Yii::$app->session;
                if (!$session->isActive) {
                    $session->open();
                }
                if (isset($session['login_info'])) {
                    ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- <img src="" class="user-image" alt="User Image"/> -->
                            <i class="fa fa-sign-out" aria-hidden="true">
                                <span class="hidden-xs">Logout</span></i>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <?=
                                Html::a(
                                        'Sign out', ['/site/logout'], ['data-method' => 'post', 'class' => 'btn btn-primary', 'style' => 'color:white;']
                                )
                                ?>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>

    </nav>
</header>
