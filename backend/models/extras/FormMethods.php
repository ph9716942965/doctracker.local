<?php

namespace backend\models\extras;

class FormMethods {

    public function submitWithDefaults($model) {
        $model->user_id = \backend\models\User::getSessionUserId();
        return $model->save();
    }

    public function getCurrentTimeStamp() {
        $milliseconds = round(microtime(true) * 1000);
        return $milliseconds;
    }

}
