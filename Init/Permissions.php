<?php

namespace CMW\Permissions\SimpleCookies;

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Permission\IPermissionInit;
use CMW\Manager\Permission\PermissionInitType;

class Permissions implements IPermissionInit
{
    public function permissions(): array
    {
        return [
            new PermissionInitType(
                code: 'simplecookies.manage',
                description: LangManager::translate('SimpleCookies.permissions.manage'),
            ),
        ];
    }
}
