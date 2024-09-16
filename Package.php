<?php

namespace CMW\Package\Simplecookies;

use CMW\Manager\Package\IPackageConfig;
use CMW\Manager\Package\PackageMenuType;

class Package implements IPackageConfig
{
    public function name(): string
    {
        return 'Simplecookies';
    }

    public function version(): string
    {
        return '1.0.0';
    }

    public function authors(): array
    {
        return ['OverheatStudio'];
    }

    public function isGame(): bool
    {
        return false;
    }

    public function isCore(): bool
    {
        return false;
    }

    public function menus(): ?array
    {
        return [
            new PackageMenuType(
                lang: 'fr',
                icon: 'fas fa-cookie',
                title: 'Simple Cookies',
                url: 'cookies',
                permission: 'cookies.manage',
                subMenus: []
            ),
        ];
    }

    public function requiredPackages(): array
    {
        return ['Core'];
    }

    public function uninstall(): bool
    {
        // Return true, we don't need other operations for uninstall.
        return true;
    }
}
