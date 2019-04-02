<?php

header('X-Frame-Options: DENY');
header('X-Frame-Options: SAMEORIGIN');

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function keepLogActionWiseWeb($string = '', $request = false, $response = false) {
    $logDir = __DIR__ . '/logs/';
    $controller = \Yii::$app->controller->id;
    $action = \Yii::$app->controller->action->id;
    $controllerActionDir = $controller . '/' . $action;
    $uploads_dir = $logDir . $controllerActionDir . '/';
    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }
    if ($request && !empty($string)) {
        $dir = $uploads_dir . 'request/' . date('d_m_Y') . '/';
        $file = $dir . getUserId() . '.txt';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($file, ' REQUESTBODY [' . date('Y:m:d H:m:s') . '] | ' . $string . "\n" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
    if ($response && !empty($string)) {
        $dir = $uploads_dir . 'response/' . date('d_m_Y') . '/';
        $file = $dir . getUserId() . '.txt';
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        file_put_contents($file, ' RESPONSEBODY [' . date('Y:m:d H:m:s') . '] | ' . $string . "\n" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
    if (!empty($string)) {
        file_put_contents($logDir . 'log.txt', '[' . date('Y:m:d H:m:s') . '] | ' . $string . "\n" . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}

function display_array($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function dropdownVendorType() {
    $array = [1 => 'Staff',
        2 => 'Service Contract',
        3 => 'Meeting Participant',
        4 => 'NGO',
        5 => 'Supplier',
        6 => 'Others',];

    return $array;
}

function getCountryId($id) {
    $query = new yii\db\Query();
    $query->select(['country.id as country_id', 'state.id as state_id'])
            ->from('district')
            ->innerJoin('state', 'state.id =district.state_id')
            ->innerJoin('country', 'country.id =state.country_id')
            ->where(['district.id' => $id]);
    $command = $query->createCommand();

    return $data = $command->queryOne();
}

function getGeoLocationName($id) {
    if ($id) {
        $query = new yii\db\Query();
        $query->select(['country.country_name', 'state.state_name'])
                ->from('district')
                ->innerJoin('state', 'state.id =district.state_id')
                ->innerJoin('country', 'country.id =state.country_id')
                ->where(['district.id' => $id]);
        $command = $query->createCommand();

        return $data = $command->queryOne();
    } else {
        return '';
    }
}

function getLevelId() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['login_info'])) {
        $login_detail = Yii::$app->user->identity;
        if ($login_detail && !empty($login_detail)) {
            return $login_detail->level_id;
        }
    }
}

function checkAuthentication() {
    $action = Yii::$app->urlManager->parseRequest(Yii::$app->request);
    $session = Yii::$app->session;
    if (!$session->isActive) {
        $session->open();
    }
    if ($session->get("login_info")) {
        $pageAuthentications = backend\models\PageAuthentications::find()->where(['level_id' => Yii::$app->user->identity->level_id, 'authentication' => $action[0]])->one();
        if ($pageAuthentications == null) {
//            throw new \yii\web\HttpException(401, 'Un Authorized');
            Yii::$app->response->redirect(["site/unauthorized"]);
        }
    } else {
        Yii::$app->response->redirect(Yii::$app->user->loginUrl);
    }
}

function createUrls($actions, $module) {
    //used in page authentication 
    $actionssm = array();

    for ($i = 0; $i < count($actions); $i++) {
        $actionssm[$module . "/" . $actions[$i]] = ucfirst($actions[$i]);
        $actionssm[$module] = "defaultIndex";
        $actionssm[$module . "/"] = "defaultIndex/";
    }

    return $actionssm;
}
