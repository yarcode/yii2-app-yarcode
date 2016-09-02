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
 * @property integer $owner_id
 * @property string $first_name
 * @property string $last_name
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
                    'first_name',
                    'last_name',
                ],
                'filter',
                'filter' => 'trim'
            ],

            [
                [
                    'first_name',
                    'last_name',
                ],
                'filter',
                'filter' => [$p, 'process']
            ],
            [
                [
                    'first_name',
                    'last_name',
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
        return $this->hasOne(UserAccount::className(), ['id' => 'owner_id']);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return implode(' ', [$this->last_name, $this->first_name]);
    }
}
