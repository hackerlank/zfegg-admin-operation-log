<?php

namespace Zfegg\Admin\OperationLog\Listener;

use Gzfextra\Stdlib\OptionsTrait;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use Zend\Mvc\MvcEvent;

/**
 * Class Operation
 *
 * @package Admin\Listener
 * @author  Xiemaomao
 * @version $Id$
 */
class OperationListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;
    use OptionsTrait;


    public function __construct(array $options)
    {
        $this->setOptions($options);
    }

    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'onRoute'));
    }


    public function onRoute(MvcEvent $e)
    {
        /** @var \Zend\Authentication\AuthenticationService $auth */
        $auth = $e->getApplication()->getServiceManager()->get('Zfegg\Admin\AuthenticationService');

        if (!$auth->hasIdentity()) {
            return ;
        }


        $rm = $e->getRouteMatch();
        $name = $rm->getMatchedRouteName();

        /** @var \Zend\Http\PhpEnvironment\Request $request */
        $request = $e->getRequest();

        $params = array(
            'get'   => $_GET,
            'post'  => $_POST,
            'route' => $name,
        );
    }
}