<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserAccount]].
 *
 * @see UserAccount
 */
class UserAccountQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return UserAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function byName($name)
    {
        $this->andWhere(['name' => $name]);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function byNameOrEmail($name)
    {
        if (stristr($name, '@') === false) {
            $this->andWhere(['name' => $name]);
        } else {
            $this->andWhere(['email' => $name]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => UserAccount::STATUS_ACTIVE]);
        return $this;
    }
}