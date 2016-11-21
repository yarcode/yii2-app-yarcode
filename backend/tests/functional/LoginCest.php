<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use backend\fixtures\UserAccount as UserAccountFixture;
use backend\fixtures\UserProfile as UserProfileFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    function _before(FunctionalTester $I)
    {
        $I->haveFixtures([

            'userAccount' => [
                'class' => UserAccountFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_account.php'
            ],

            'userProfile' => [
                'class' => UserProfileFixture::className(),
                'dataFile' => codecept_data_dir() . 'user_profile.php'
            ]

        ]);

        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[accountName]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Account Name cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong'));
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkLoginUserInGroupAdmin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('okirlin', 'password_0'));
        $I->see('Brandy Renner');
        $I->seeLink('Sign out', '/site/logout');
    }

    public function checkLoginUserInGroupUser(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('troy.becker', 'password_0'));
        $I->seeValidationError('Incorrect username or password.');
    }
}
