<?php
/**
 * Created by PhpStorm.
 * User: olegy
 */

namespace api\modules\v1;

class Module extends \yii\base\Module
{
    public $controllerNamespace = '\api\modules\v1\controllers';
    public $version = 'v1';

    public function init()
    {
        parent::init();

    }
}

