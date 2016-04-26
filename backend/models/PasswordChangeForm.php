<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace backend\models;

use common\models\UserAccount;
use yii\base\Model;

class PasswordChangeForm extends Model
{
    public $password;
    public $passwordRepeat;

    /** @var UserAccount */
    protected $user;

    public function rules()
    {
        return [
            [['password', 'passwordRepeat'], 'required'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function init()
    {
        parent::init();
        $this->user = \Yii::$app->user->identity;
    }

    public function process()
    {
        $this->user->setPassword($this->password);
        $this->user->tryUpdate(false);
    }
}