<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_000000_user_module extends Migration
{
    public function up()
    {
        $options = $this->db->driverName == 'mysql' ? 'ENGINE=InnoDB' : null;

        $this->createTable('{{%user_account}}', [
            'id' => $this->primaryKey(),
            'createdAt' => $this->dateTime(),
            'updatedAt' => $this->dateTime(),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'passwordHash' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'passwordResetToken' => $this->string(),
            'email' => $this->string()->notNull(),
            'isEmailConfirmed' => $this->boolean()->notNull()->defaultValue(0),
            'lastLoginIp' => $this->string(),
            'lastLoginAt' => $this->dateTime(),
            'timeZone' => $this->string()->defaultValue('UTC'),
        ], $options);

        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'ownerId' => $this->integer(),
            'firstName' => $this->string(),
            'lastName' => $this->string(),
        ], $options);

        $this->addForeignKey('FK_user_profile_ownerId', '{{%user_profile}}', 'ownerId'
            , '{{%user_account}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_profile_ownerId', '{{%user_profile}}');
        $this->dropTable('{{%user_account}}');
        $this->dropTable('{{%user_profile}}');
    }
}
