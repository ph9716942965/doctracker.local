<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php', require __DIR__ . '/../../common/config/params-local.php', require __DIR__ . '/params.php', require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => 'Doc Tracker',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'timeout' => 60 * 60 * 24 * 14, // 2 weeks, 3600 - 1 hour, Default 1440
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'CommonHtml' => [
            'class' => 'backend\components\CommonHtml',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'reachus@dhwaniris.com',
                'password' => 'Uabfocff.1',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        's3Production' => [
            'class' => \indielab\yii2s3\S3::class,
            'bucket' => 'staging-dhwani',
            'key' => 'AKIAJGNIQMDDQLEKQTJQ',
            'secret' => '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',
            'region' => 'ap-south-1'
        ],
        's3Staging' => [
            'class' => \indielab\yii2s3\S3::class,
            'bucket' => 'staging-dhwani',
            'key' => 'AKIAJGNIQMDDQLEKQTJQ',
            'secret' => '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',
            'region' => 'ap-south-1'
        ],
        's3Local' => [
            'class' => \indielab\yii2s3\S3::class,
            'bucket' => 'staging-dhwani',
            'key' => 'AKIAJGNIQMDDQLEKQTJQ',
            'secret' => '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',
            'region' => 'ap-south-1'
        ],
//        'AccessBehavior' => [
//            'class' => 'backend\components\AccessBehavior',
//            'allowedRoutes' => [
//                '/',
//                ['/site/login'],
//            ],
//            'redirectUri' => '/'
//        ],
        'assetManager' => [
            'bundles' => [
//                'dmstr\web\AdminLteAsset' => [
//                    'skin' => 'skin-blue',
//                ],
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD],
                ],
            ],
        ],
    ],
    'params' => $params,
];
