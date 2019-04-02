<?php

namespace backend\controllers;

class BaseController extends \yii\web\Controller {

    public function beforeAction($action) {
        $session = \Yii::$app->session;
        if (!$session->has('login_info')) {
            $this->redirect(\Yii::$app->user->loginUrl);
        } else {
            checkAuthentication();
            return parent::beforeAction($action);
        }
    }

}
