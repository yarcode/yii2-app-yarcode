<?php

namespace common\components;

use common\models\Core;
use yii\helpers\VarDumper;
use Yii;

/**
 * Class ActiveRecord
 * @package common\components
 */
class ActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function trySave($runValidation = true, $attributeNames = null)
    {
        if (false === $this->save($runValidation, $attributeNames)) {
            throw new \LogicException("Error while saving model: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function tryUpdate($runValidation = true, $attributeNames = null)
    {
        if (false === $this->update($runValidation, $attributeNames)) {
            throw new \LogicException("Error while updating model: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }

    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function tryInsert($runValidation = true, $attributeNames = null)
    {
        if (false === $this->insert($runValidation, $attributeNames)) {
            throw new \LogicException("Error while inserting model: " . VarDumper::dumpAsString($this->getErrors()));
        }
        return true;
    }


    public function getTranslatedAttribute($name, $lang)
    {
        $lang = substr(Yii::$app->language, 0, 2);

        switch (Yii::$app->language) {
            case Core::LANG_EN:
                return $this->getAttribute($name);
            case Core::LANG_AR:
                return $this->getAttribute("{$name}_{$lang}");
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getAttribute($name)
    {
        return self::__get($name);
    }

    public function __get($name)
    {
        $lang = substr(Yii::$app->language, 0, 2);
        if (yii::$app->id == 'app-frontend' &&
            Yii::$app->language == Core::LANG_AR &&
            $this->hasAttribute("{$name}_{$lang}")) {
            return parent::__get("{$name}_{$lang}");
        }

        return parent::__get($name);
    }
}