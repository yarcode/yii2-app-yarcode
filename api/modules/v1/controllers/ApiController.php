<?php
/**
 * @author Antonov Oleg <theorder83dev@gmail.com>
 */

namespace api\modules\v1\controllers;

use api\components\actions\SimpleOptionsAction;
use api\components\Controller;

/**
 * Class ApiController
 * @package api\modules\v1\controllers
 */
class ApiController extends Controller
{
    public $defaultAction = 'version';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => SimpleOptionsAction::class,
                'options' => ['GET'],
            ]
        ];
    }

    /**
     * @return array
     */
    public function actionVersion()
    {
        return [
            'version' => $this->module->getVersion(),
        ];
    }
}
