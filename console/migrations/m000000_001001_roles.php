<?php

use yii\db\Schema;
use yii\db\Migration;

class m000000_001001_roles extends Migration
{
    /**
     * @throws yii\base\InvalidConfigException
     * @return \yii\rbac\DbManager
     */
    protected function getAuthManager()
    {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof \yii\rbac\DbManager) {
            throw new \yii\base\InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    public function safeUp()
    {
        $auth = $this->getAuthManager();

        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user);

        $userId = getenv('APP_DEFAULT_USER_ID') ?: 1;
        $auth->assign($admin, $userId);
    }

    public function safeDown()
    {
        $auth = $this->getAuthManager();
        $auth->removeAllRoles();
    }
}
