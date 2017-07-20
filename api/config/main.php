<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'v1',
    ],
    'controllerNamespace' => 'api\controllers',
    'modules' => [
        'v1' => [
            'class' => \api\modules\v1\Module::class,
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => \common\models\UserAccount::class,
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
            ],
        ],
        'request' => [
            'class' => \common\components\Request::class,
            'baseUrl' => '/',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
                'application/json; charset=UTF-8' => \yii\web\JsonParser::class,
                'application/x-www-form-urlencoded' => \yii\web\JsonParser::class,
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],
        'response' => [
            'class' => yii\web\Response::class,
            'format' => yii\web\Response::FORMAT_JSON,
            'on beforeSend' => function ($event) {
                /** @var yii\web\Response $response */
                $response = $event->sender;
                if ($response->statusCode < 400) {
                    $response->data = [
                        'success' => true,
                        'status' => $response->statusCode,
                        'data' => $response->data,
                    ];
                } else {
                    \yii\helpers\ArrayHelper::remove($response->data, 'status');
                    \yii\helpers\ArrayHelper::remove($response->data, 'type');
                    $response->data = [
                        'success' => false,
                        'status' => $response->statusCode,
                        'data' => $response->data,
                    ];
                }
            }
        ],
    ],

    'params' => $params,
];
