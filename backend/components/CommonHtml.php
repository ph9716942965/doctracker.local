<?php

namespace backend\components;

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Description of CommonHtml
 *
 * @author Bhagyesh Solanki
 */
class CommonHtml {

    private $message = "Are you sure you want to go back? Data will be lost";
    private $url;

    public function goBackWithConfirm($msg = "") {
        if (!empty($msg)) {
            $this->message = $msg;
        }
        return Html::a('Back', $this->url, ["class" => "btn btn-warning", "data" => [
                        'confirm' => $this->message,
        ]]);
    }

    public function goIndexWithConfirm($msg=''){
        if (!empty($msg)) {
            $this->message = $msg;
        }
        return Html::a('Back', Url::toRoute('claim-request/index'), ["class" => "btn btn-warning", "data" => [
                        'confirm' => $this->message,
        ]]);
       // <a class="custom-control-label" onclick="return confirm('Are you sure you want to go back? Data will be lost');" for="radio"  href="<?=Url::toRoute('claim-request/create')">
    }
    public function goBack($url = "") {
        if (!empty($url)) {
            $this->url = $url;
        }
        return Html::a('Back', $this->url, ["class" => "btn btn-warning"]);
    }

    public function __construct() {
//        \Yii::$app->request->baseUrl
        return $this->url = (\Yii::$app->request->referrer) ? \Yii::$app->request->referrer : \Yii::$app->homeUrl;
    }

}
