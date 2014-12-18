<?php

namespace NetglueCreateSend\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use NetglueCreateSendApi\Client\CreateSendClient;

class CreateSendClientFactory implements FactoryInterface
{

    /**
     * Return Campaign Monitor Api Client
     * @param  ServiceLocatorInterface $serviceLocator
     * @return CreateSendClient
     * @throws \RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        if (!isset($config['campaign_monitor']['apiKey'])) {
            throw new \RuntimeException('API Key is a required configuration parameter');
        }
        $key = $config['campaign_monitor']['apiKey'];

        return new CreateSendClient($key);
    }

}
