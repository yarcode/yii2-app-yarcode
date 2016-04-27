<?php

namespace common\models;

use common\components\ActiveRecord;
use yarcode\base\behaviors\TimestampBehavior;
use yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $ownerId
 * @property string $firstName
 * @property string $lastName
 *
 * @property UserAccount $owner
 *
 * @property string $fullName
 */
class UserProfile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     * @return UserProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserProfileQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $p = new HtmlPurifier();
        return [
            [
                [
                    'firstName',
                    'lastName',
                ],
                'filter',
                'filter' => 'trim'
            ],

            [
                [
                    'firstName',
                    'lastName',
                ],
                'filter',
                'filter' => [$p, 'process']
            ],
            [
                [
                    'firstName',
                    'lastName',
                ],
                'required'
            ],
        ];
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return parent::attributeLabels();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(UserAccount::className(), ['id' => 'ownerId']);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return implode(' ', [$this->lastName, $this->firstName]);
    }
}
