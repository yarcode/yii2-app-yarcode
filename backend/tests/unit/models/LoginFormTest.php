<?php

namespace backend\tests\unit\models;

use backend\models\LoginForm;
use common\fixtures\UserAccountFixture;
use Yii;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'userAccount' => [
                'class' => UserAccountFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ]);
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'accountName' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'accountName' => 'erau-admin',
            'password' => 'wrong_password',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'accountName' => 'erau-admin',
            'password' => 'password_0',
        ]);

        expect('model should login user', $model->login())->true();
        expect('error message should not be set', $model->errors)->hasntKey('password');
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }

    public function testLoginUserInGroupAdmin()
    {
        $model = new LoginForm([
            'accountName' => 'erau-admin',
            'password' => 'password_0',
        ]);

        expect('model should login user', $model->login())->true();
        expect('error message should not be set', $model->errors)->hasntKey('password');
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }

    public function testNotLoginUserInGroupUser()
    {
        $model = new LoginForm([
            'accountName' => 'john-user',
            'password' => 'password_0',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testNotLoginInactiveUser()
    {
        $model = new LoginForm([
            'accountName' => 'doe-inactive',
            'password' => 'password_0',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }
}
