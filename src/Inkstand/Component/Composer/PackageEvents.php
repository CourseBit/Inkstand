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

    /**
     * This method is called by a composer script
     *
     * @param PackageEvent $packageEvent
     */
    public static function postPackageInstall(PackageEvent $packageEvent)
    {
        $installedPackage = $packageEvent->getOperation()->getPackage();
        $extra = $installedPackage->getExtra();

        // Check if composer package is an Inkstand bundle
        if(!array_key_exists('bundle_class', $extra)) {
            return;
        }

        $installPath = $packageEvent->getComposer()->getInstallationManager()->getInstallPath($installedPackage);

        $kernel = self::bootKernel();
        $container = $kernel->getContainer();
        $container->get('plugin_service')->install($installedPackage, $installPath);
    }

    public static function prePackageUpdate(PackageEvent $packageEvent)
    {

    }

    public static function postPackageUpdate(PackageEvent $packageEvent)
    {
        $updatePackage = $packageEvent->getOperation()->getPackage();
        $extra = $updatePackage->getExtra();

        // Check if composer package is an Inkstand bundle
        if(!array_key_exists('bundle_class', $extra)) {
            return;
        }

        $installPath = $packageEvent->getComposer()->getInstallationManager()->getInstallPath($updatePackage);

        $kernel = self::bootKernel();
        $container = $kernel->getContainer();
        $container->get('plugin_service')->update($updatePackage, $installPath);
    }

    public static function prePackageUninstall(PackageEvent $packageEvent)
    {
        $uninstalledPackage = $packageEvent->getOperation()->getPackage();
        $extra = $uninstalledPackage->getExtra();

        // Check if composer package is an Inkstand bundle
        if(!array_key_exists('bundle_class', $extra)) {
            return;
        }

        $installPath = $packageEvent->getComposer()->getInstallationManager()->getInstallPath($uninstalledPackage);

        $kernel = self::bootKernel();
        $container = $kernel->getContainer();
        $container->get('plugin_service')->uninstall($uninstalledPackage, $installPath);
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