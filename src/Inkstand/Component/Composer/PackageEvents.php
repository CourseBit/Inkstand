<?php

namespace Inkstand\Component\Composer;

use Composer\Installer\PackageEvent;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

class PackageEvents
{
    public static function prePackageInstall(PackageEvent $packageEvent)
    {

    }

    public static function postPackageInstall(PackageEvent $packageEvent)
    {
        $installedPackage = $packageEvent->getOperation()->getPackage();
        $extra = $installedPackage->getExtra();

        // Check if composer package is an Inkstand bundle
        if(!array_key_exists('bundle_class', $extra)) {
            return;
        }

        $kernel = self::bootKernel();
        $container = $kernel->getContainer();
        $container->get('plugin_service')->install($installedPackage, $packageEvent);
    }

    public static function prePackageUpdate(PackageEvent $packageEvent)
    {

    }

    public static function postPackageUpdate(PackageEvent $packageEvent)
    {

    }

    public static function PrePackageUninstall(PackageEvent $packageEvent)
    {

    }

    public static function postPackageUninstall(PackageEvent $packageEvent)
    {

    }

    public static function bootKernel()
    {
        $loader = require_once __DIR__ . '/../../../../app/bootstrap.php.cache';
        Debug::enable();

        require_once __DIR__ . '/../../../../app/AppKernel.php';

        $kernel = new \AppKernel('dev', true);
        $kernel->loadClassCache();
        $kernel->boot();
        return $kernel;
    }
}