<?php

namespace frontend\tests\functional;

use common\fixtures\UserAccountFixture;
use frontend\tests\FunctionalTester;

class LoginCest
{
    function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'userAccount' => [
                'class' => UserAccountFixture::class,
                'dataFile' => codecept_data_dir() . 'user_account.php'
            ]
        ]);

        $I->amOnRoute('site/login');
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Account Name cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[accountName]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('okirlin', 'password_0'));
        $I->see('okirlin');
        $I->seeLink('Logout', '/site/logout');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
