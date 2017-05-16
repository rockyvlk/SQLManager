<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'assetManager' => [
            'linkAssets' => true
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '8EKbGDWZsG8J56nyQE8xPsGijj5i_z13',
            'baseUrl' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => true,
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'formatter' => [
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'nullDisplay' => ' ',
            'numberFormatterOptions' => [
                NumberFormatter::ROUNDING_MODE => true,
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
//                '<controller:\w+>/<action:\w+>/<param:\w+>' => '<controller>/<action>',


                'schema' => 'schema/list',
                'schema/tables/<schemaName:\w+>' => 'schema/tables',
                'schema/views/<schemaName:\w+>' => 'schema/views',
                'schema/sql/<schemaName:\w+>' => 'schema/sql',
                'schema/delete/<schemaName:\w+>' => 'schema/delete',

                'table/browse/<schemaName:\w+>/<tableName:\w+>' => 'table/browse',
                'table/structure/<schemaName:\w+>/<tableName:\w+>' => 'table/structure',
                'table/truncate/<schemaName:\w+>/<tableName:\w+>' => 'table/truncate',
                'table/sql/<schemaName:\w+>/<tableName:\w+>' => 'table/sql',
                'table/delete/<schemaName:\w+>' => 'table/delete',
                'table/delete/<schemaName:\w+>/<tableName:\w+>' => 'table/delete',


                'view/browse/<schemaName:\w+>/<tableName:\w+>' => 'view/browse',
                'view/structure/<schemaName:\w+>/<tableName:\w+>' => 'view/structure',
            ],
        ],

    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow' => true,
                'actions' => ['login'],
                'roles' => ['?'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],

    ],



    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
