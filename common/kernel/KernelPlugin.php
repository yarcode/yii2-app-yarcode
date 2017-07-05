<?php
namespace common\kernel;

use yii\base\Component;

abstract class KernelPlugin extends Component
{
    /** @var Kernel */
    public $kernel;

    /**
     * Bootstrap method for this plugin
     */
    abstract public function bootstrap();

    /**
     * Plugin instance getter
     * @return static
     */
    public static function getInstance()
    {
        return Kernel::getInstance()->getPlugin(static::className());
    }

    /**
     * Performs active transaction check and fails if the transaction is missing
     */
    protected function ensureDbTransaction()
    {
        if (null === \Yii::$app->db->transaction) {
            throw new \LogicException('You must use DB transaction to call ' . __METHOD__);
        }
    }
}