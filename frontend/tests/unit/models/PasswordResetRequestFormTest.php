<?php

namespace frontend\tests\unit\models;

use common\fixtures\UserAccountFixture;
use common\models\UserAccount;
use frontend\models\PasswordResetRequestForm;
use Yii;

class PasswordResetRequestFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {
        $this->tester->haveFixtures([
            'userAccount' => [
                'class' => UserAccountFixture::class,
                'dataFile' => codecept_data_dir() . 'user_account.php'
            ]
        ]);
    }

    public function testSendMessageWithWrongEmailAddress()
    {
        $model = new PasswordResetRequestForm();
        $model->email = 'not-existing-email@example.com';
        expect_not($model->sendEmail());
    }

    public function testNotSendEmailsToInactiveUser()
    {
        $user = $this->tester->grabFixture('userAccount', 1);
        $model = new PasswordResetRequestForm();
        $model->email = $user['email'];
        expect_not($model->sendEmail());
    }

    public function testSendEmailSuccessfully()
    {
        $userFixture = $this->tester->grabFixture('userAccount', 0);

        $model = new PasswordResetRequestForm();
        $model->email = $userFixture['email'];
        $user = UserAccount::findOne(['password_reset_token' => $userFixture['password_reset_token']]);

        expect_that($model->sendEmail());
        expect_that($user->password_reset_token);

        $emailMessage = $this->tester->grabLastSentEmail();
        expect('valid email is sent', $emailMessage)->isInstanceOf('yii\mail\MessageInterface');
        expect($emailMessage->getTo())->hasKey($model->email);
        expect($emailMessage->getFrom())->hasKey(Yii::$app->params['supportEmail']);
    }
}
