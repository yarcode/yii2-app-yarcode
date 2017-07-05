<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::$container->setSingleton(\Dotenv\Dotenv::class, function() {
    $env = new Dotenv\Dotenv(dirname(dirname(__DIR__)));
    $env->load();
    return $env;
});

Yii::$container->get(\Dotenv\Dotenv::class);