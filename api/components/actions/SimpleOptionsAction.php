<?php
namespace api\components\actions;

use yii;

class SimpleOptionsAction extends \yii\base\Action
{
    /**
     * @var array the HTTP verbs that are supported by the URL
     */
    public $options = [];

    public function init()
    {
        parent::init();
        if (!in_array('OPTIONS', $this->options)) {
            $this->options[] = 'OPTIONS';
        }
    }

    /**
     * Responds to the OPTIONS request.
     */
    public function run()
    {
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            Yii::$app->getResponse()->setStatusCode(405);
        }
        Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', $this->options));
        Yii::$app->getResponse()->getHeaders()->set('Access-Control-Allow-Methods', implode(', ', $this->options));
    }
}
