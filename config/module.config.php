<?php

return array(
    'view_manager'    => array(
        'template_map'        => array(
            'operation-log/list' => __DIR__ . '/../view/admin/operation-log/list.phtml',
        ),
    ),
    'tables' => array(
        'Zfegg\Admin\OperationLogTable'             => array(
            'table'     => 'admin_operation_log',
            'primary'   => 'id',
            'adapter'   => 'Zfegg\Admin\DbAdapter',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'Zfegg\Admin\OperationLogListener'        => 'Zfegg\Admin\OperationLog\Listener\OperationListenerFactory',
        ),
    ),

    'listeners' => array(
        'Zfegg\Admin\OperationLogListener',
    ),

    'zfegg_admin' => array(
        'operation_log' => array(
            'ignores' => array(

            ),
        ),
    ),
);