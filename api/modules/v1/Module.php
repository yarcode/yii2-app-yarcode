<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

namespace api\modules\v1;

/**
 * Class Module
 * @package api\modules\v1
 */
class Module extends \yii\base\Module
{
    public $controllerNamespace = '\api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
