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
            'created_at' => $now,
            'updated_at' => $now,
            'status' => 1,
            'password_hash' => Yii::$app->security->generatePasswordHash('root'),
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'email' => 'root@example.org',
            'is_email_confirmed' => 1,
        ]);
        
        $userId = Yii::$app->db->lastInsertID;

        $this->insert('{{%user_profile}}', [
            'owner_id' => $userId,
            'first_name' => 'Admin',
            'last_name' => 'Super',
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
