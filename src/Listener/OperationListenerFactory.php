<?php
/**
 * Zend Framework Egg (https://github.com/zfegg)
 *
 * @link      https://github.com/zfegg for the canonical source repository
 */
 

namespace Zfegg\Admin\OperationLog\Listener;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zfegg\Admin\Module;

class OperationListenerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $configs = $serviceLocator->get('config');
        $config = $configs[Module::CONFIG_KEY]['operation_log'];

        return new OperationListener($config);
    }
}