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
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'status' => $this->integer()->notNull()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'is_email_confirmed' => $this->boolean()->notNull()->defaultValue(0),
            'last_login_ip' => $this->string(),
            'last_login_at' => $this->dateTime(),
            'time_zone' => $this->string()->defaultValue('UTC'),
        ], $options);

        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'owner_id' => $this->integer(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
        ], $options);

        $this->addForeignKey('FK_user_profile_owner_id', '{{%user_profile}}', 'owner_id'
            , '{{%user_account}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_profile_owner_id', '{{%user_profile}}');
        $this->dropTable('{{%user_account}}');
        $this->dropTable('{{%user_profile}}');
    }
}
