<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
namespace common\components;

class Request extends \yii\web\Request
{
    /**
     * @param $name
     * @param null|mixed $defaultValue
     * @return mixed
     */
    public function getRequestParam($name, $defaultValue = null)
    {
        return static::getBodyParam($name, static::getQueryParam($name, $defaultValue));
    }
}