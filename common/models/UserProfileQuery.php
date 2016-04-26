<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserProfile]].
 *
 * @see UserProfile
 */
class UserProfileQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserProfile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserProfile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}