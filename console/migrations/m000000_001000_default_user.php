<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_001000_default_user extends Migration
{
    public function safeUp()
    {
        $now = new \yii\db\Expression('NOW()');
        $this->insert('{{%user_account}}', [
            'name' => 'root',
            'createdAt' => $now,
            'updatedAt' => $now,
            'status' => 1,
            'passwordHash' => Yii::$app->security->generatePasswordHash('root'),
            'authKey' => \Yii::$app->security->generateRandomString(),
            'email' => 'root@example.org',
            'isEmailConfirmed' => 1,
        ]);
        
        $userId = Yii::$app->db->lastInsertID;

        $this->insert('{{%user_profile}}', [
            'ownerId' => $userId,
            'firstName' => 'Admin',
            'lastName' => 'Super',
        ]);
        
        /** @var \yii\console\Controller $controller */
        $controller = Yii::$app->controller;
        
        $controller->confirm("Default user id: $userId. Please write it down and enter 'yes'");
    }

    public function safeDown()
    {
        $this->delete('{{%user_account}}');
    }
}
