<?php

function getBody($username, $levelId, $password) {

    if (\backend\models\Level::EMPLOYEE == $levelId) {
        $levelName = (new \backend\models\Level())->getLevelOptions($levelId);
    } else if (\backend\models\Level::RO == $levelId) {
        $levelName = (new \backend\models\Level())->getLevelOptions($levelId);
    } else {
        $levelName = "";
    }

    $string = '<p style="font-size:medium;font-family:Arial;margin-left:3%;"><b>Username : </b>' . $username . '<br>' .
                '<b>Password : </b>' . $password . '<br>' .
                '<b>User Level : </b>' . $levelName . '<br>' .
              '</p>';
    return $string;
}

echo getBody($model->username, $model->level_id, $password);
