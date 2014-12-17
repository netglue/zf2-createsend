<?php

namespace NetglueCreateSend;


/**
 * Autoloader
 */
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;

/**
 * Config Provider
 */
use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Service Provider
 */
use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * Controller Provider
 */
use Zend\ModuleManager\Feature\ControllerProviderInterface;

/**
 * Controller Plugin Provider
 */
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;

/**
 * View Helper Provider
 */
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

/**
 * Form Element Provider
 */
use Zend\ModuleManager\Feature\FormElementProviderInterface;

/**
 * Bootstrap Listener
 */
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\EventManager\EventInterface;

/**
 * @codeCoverageIgnore
 */
class Module implements
             AutoloaderProviderInterface,
             ConfigProviderInterface,
             ServiceProviderInterface
{

    /**
     * Return autoloader configuration
     * @link http://framework.zend.com/manual/2.0/en/user-guide/modules.html
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            AutoloaderFactory::STANDARD_AUTOLOADER => array(
                StandardAutoloader::LOAD_NS => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    /**
     * Return Module Configuration
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    /**
     * Return Service Config
     * @return array
     * @implements ServiceProviderInterface
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'NetglueCreateSend\Client\CreateSendClient' => 'NetglueCreateSend\Service\CreateSendClientFactory',
            ),
            'aliases' => array(
                'CreateSendClient' => 'NetglueCreateSend\Client\CreateSendClient',
            ),
        );
    }

}
