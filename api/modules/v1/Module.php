<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

namespace api\modules\v1;

use yii\base\BootstrapInterface;

/**
 * Class Module
 * @package api\modules\v1
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = '\api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules(
            require(__DIR__ . '/config/routes.php'),
            false
        );
    }
}
