<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
//use yii\web\Session;
use backend\models\State;
use backend\models\District;
use yii\web\Response;

/**
 * Site controller.
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'num2word', 'get-all-location', 'unauthorized'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $session = Yii::$app->session;
            //$session->set("login_id", $LoginHistoryModel->id);
            if (!$session->isActive) {
                $session->open();
            }
            $session->set('login_info', $model);
            ob_start();

            return $this->goBack();
            //$session->set("sessionCount", 'ABC');
        } else {
            $model->password = '';

            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionNum2word() {
        if (isset($_REQUEST['rupe'])) {
            echo strtoupper($this->num2wordconv($_REQUEST['rupe']));
        } else {
            echo '';
        }
    }

    public function num2wordconv($num) {
        //$num=120.90;
        if($num==0){
            return '';
        }
        $ones = array(
            1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four',
            5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight',
            9 => 'nine', 10 => 'ten',
            11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen',
            15 => 'fifteen', 16 => 'sixteen',
            17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen',
        );
        $tens = array(
            1 => 'ten', 2 => 'twenty',
            3 => 'thirty', 4 => 'forty',
            5 => 'fifty', 6 => 'sixty',
            7 => 'seventy', 8 => 'eighty',
            9 => 'ninety',);
        $hundreds = array(
            'hundred', 'thousand',
            'million', 'billion',
            'trillion', 'quadrillion',
        ); //limit t quadrillion
        $num = number_format($num, 2, '.', ',');
        $num_arr = explode('.', $num);
        $wholenum = $num_arr[0];
        $decnum = $num_arr[1];
        $whole_arr = array_reverse(explode(',', $wholenum));
        krsort($whole_arr);
        $rettxt = '';
        foreach ($whole_arr as $key => $i) {
            if ($i < 20) {
                @$rettxt .= $ones[$i];
            } elseif ($i < 100) {
                $rettxt .= $tens[substr($i, 0, 1)];
                @$rettxt .= ' ' . $ones[substr($i, 1, 1)];
            } else {
                $rettxt .= $ones[substr($i, 0, 1)] . ' ' . $hundreds[0];
                @$rettxt .= ' ' . $tens[substr($i, 1, 1)];
                @$rettxt .= ' ' . $ones[substr($i, 2, 1)];
            }
            if ($key > 0) {
                $rettxt .= ' ' . $hundreds[$key] . ' ';
            }
        }
        $rettxt .= ' Rupees ';
        if ($decnum > 0) {
            $rettxt .= ' and ';
            if ($decnum < 20) {
                $rettxt .= $ones[$decnum];
            } elseif ($decnum < 100) {
                $rettxt .= $tens[substr($decnum, 0, 1)];
                @$rettxt .= ' ' . $ones[substr($decnum, 1, 1)];
            }
            $rettxt .= ' Paisa';
        }

        return $rettxt . ' Only';
    }

    public function actionGetAllLocation() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $return = [];
        if ($post['type'] == 1) {
            $return = State::find()->select(['state_name as `name`', 'id'])->where(['country_id' => $post['id']])->asArray()->all();
            if (!$return) {
                return $return;
            }
        } elseif ($post['type'] == 2) {
            $return = District::find()->select(['district_name as `name`', 'id'])->where(['state_id' => $post['id']])->asArray()->all();
            if (!$return) {
                return $return;
            }
        }

        return $return;
    }

    public function actionUnauthorized() {
        Yii::$app->response->statusCode = 401;
        return $this->render('unauthorized', ['message' => 'Un Authorized',
                    'code' => 401,]);
    }

}
