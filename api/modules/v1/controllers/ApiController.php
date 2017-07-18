<?php
/**
 * Created by PhpStorm.
 * User: olegy
 */

namespace api\modules\v1\controllers;

use api\components\actions\SimpleOptionsAction;
use api\components\Controller;

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

    public function actionVersion()
    {
        return [
            'version' => $this->module->getVersion(),
        ];
    }

}
