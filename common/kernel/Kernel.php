<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace common\kernel;

use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class Kernel extends Component implements BootstrapInterface
{
    /** @var KernelPlugin[] */
    protected $plugins = [];

    public function bootstrap($app)
    {
        static::getInstance();
    }

    /**
     * @return static
     * @throws \yii\base\InvalidConfigException
     */
    public static function getInstance()
    {
        return \Yii::$app->get('kernel');
    }

    /**
     * @param array $config
     */
    public function setPlugins($config)
    {
        if (!is_array($config)) {
            throw new \LogicException("Plugins configuration must be an array");
        }

        foreach ($config as $pluginClassName) {
            $this->registerPlugin($pluginClassName);
        }
    }

    /**
     * @param string $className
     * @throws InvalidConfigException
     */
    public function registerPlugin($className)
    {
        if (!class_exists($className)) {
            throw new \LogicException("Unknown plugin className {$className}");
        }

        if (isset($this->plugins[$className])) {
            return;
        }

        /** @var KernelPlugin $plugin */
        $plugin = \Yii::createObject($className);
        $plugin->kernel = $this;
        $this->plugins[$className] = $plugin;
        $this->plugins[$className]->bootstrap();
    }

    /**
     * @param $class
     * @return KernelPlugin
     */
    public function getPlugin($class)
    {
        $plugin = ArrayHelper::getValue($this->plugins, $class);

        if (null === $plugin) {
            throw new \LogicException("Unknown plugin: {$class}");
        }

        return $plugin;
    }

}