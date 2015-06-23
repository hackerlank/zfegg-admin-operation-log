<?php
namespace Zfegg\Admin\OperationLog;

class Module
{
    const CONFIG_KEY = 'zfegg_admin';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}