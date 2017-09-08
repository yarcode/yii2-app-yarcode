<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');

Yii::$container->setSingleton(\Dotenv\Dotenv::class, function () {
    $env = new Dotenv\Dotenv(dirname(dirname(__DIR__)));
    $env->load();
    $env->required('DB_DSN');
    $env->required('DB_USERNAME');
    $env->required('DB_PASSWORD');
    return $env;
});

Yii::$container->get(\Dotenv\Dotenv::class);
