<?php
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
        'components' => [
            'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => getenv('TEST_DB_DSN'),
                'username' => getenv('TEST_DB_USERNAME'),
                'password' => getenv('TEST_DB_PASSWORD'),
                'charset' => 'utf8',
            ],
        ],
    ]
);
