<?php

namespace common\models;

use common\components\ActiveRecord;
use yarcode\base\behaviors\TimestampBehavior;
use yarcode\base\traits\StatusTrait;
use yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user_account}}".
 *
 * @property integer $id
 * @property string $createdAt
 * @property string $updatedAt
 * @property integer $status
 * @property string $name
 * @property string $passwordHash
 * @property string $authKey
 * @property string $email
 * @property integer $isEmailConfirmed
 * @property string $lastLoginIp
 * @property string $lastLoginAt
 * @property string $timeZone
 * @property string $passwordResetToken
 *
 * @property UserProfile $profile
 *
 * @mixin TimestampBehavior
 */
class UserAccount extends ActiveRecord implements IdentityInterface
{
    use StatusTrait;

    const STATUS_NEW = 0;
    const STATUS_ACTIVE = 1;

    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_account}}';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'passwordResetToken' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public static function getStatusLabels()
    {
        return [
            static::STATUS_ACTIVE => 'Active',
            static::STATUS_NEW => 'New',
        ];
    }

    /**
     * @inheritdoc
     * @return UserAccountQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserAccountQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'isEmailConfirmed'], 'required'],
            ['isEmailConfirmed', 'boolean'],
            ['email', 'email'],
            [['name', 'email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'passwordHash' => Yii::t('app', 'Password Hash'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'email' => Yii::t('app', 'Email'),
            'isEmailConfirmed' => Yii::t('app', 'Is Email Confirmed'),
            'lastLoginIp' => Yii::t('app', 'Last Login Ip'),
            'lastLoginAt' => Yii::t('app', 'Last Login At'),
            'timeZone' => Yii::t('app', 'Time Zone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(UserProfile::className(), ['ownerId' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->getAttribute('authKey');
    }

    /**
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->authKey = \Yii::$app->security->generateRandomString();
        }

        if (isset($this->password)) {
            $this->passwordHash = \Yii::$app->security->generatePasswordHash($this->password);
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $profile = new UserProfile();
            $profile->ownerId = $this->id;
            $profile->tryInsert(false);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ts'] = TimestampBehavior::className();
        return $behaviors;
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }
}
