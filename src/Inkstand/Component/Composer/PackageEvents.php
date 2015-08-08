<?php

namespace Inkstand\Component\Composer;

use Composer\Installer\PackageEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

class PackageEvents
{
    public static function prePackageInstall(PackageEvent $packageEvent)
    {

    }

    public static function postPackageInstall(PackageEvent $packageEvent)
    {
        $packageEvent->getIO()->write('HELLO WORLD!!!!!!!!!!!!!!!!!');
        self::bootSymfony();
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

    public static function bootSymfony()
    {
        $loader = require_once __DIR__ . '/../../../../app/bootstrap.php.cache';
        Debug::enable();

        require_once __DIR__ . '/../../../../app/AppKernel.php';

        $kernel = new \AppKernel('dev', true);
        $kernel->loadClassCache();
        $request = Request::createFromGlobals();
        $response = $kernel->handle($request);
        $response->send();
        $kernel->terminate($request, $response);
    }
}