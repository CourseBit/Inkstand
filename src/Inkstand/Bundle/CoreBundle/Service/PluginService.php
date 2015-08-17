<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Composer\Installer\PackageEvent;
use Inkstand\Bundle\CoreBundle\Entity\Plugin;
use Composer\Package\CompletePackage;

class PluginService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository('InkstandCoreBundle:Plugin');
    }

    public function install(CompletePackage $package, PackageEvent $event)
    {
        $plugin = new Plugin();
        $plugin->setName($package->getName());
        $plugin->setEnabled(1);
        $plugin->setVersion($package->getVersion());
        $plugin->setDescription($package->getDescription());
        $plugin->setHomepage($package->getHomepage());
        $plugin->setAuthors($package->getAuthors());
        $plugin->setSupport($package->getSupport());
        $plugin->setDateInstalled(new \DateTime());

        // Get full package json file. The package json from composer update/install does not include support properties
        // https://github.com/CourseBit/Inkstand/issues/4
        $installPath = $event->getComposer()->getInstallationManager()->getInstallPath($package);
        $packageJson = json_decode(file_get_contents(sprintf('%s/composer.json', $installPath)));

        if(!empty($packageJson) && isset($packageJson->support)) {
            $plugin->setSupport($packageJson->support);
        } else {
            $plugin->setSupport(array());
        }

        $plugin->setBundleClass($package->getExtra()['bundle_class']);
        $plugin->setBundleTitle($package->getExtra()['bundle_title']);
        $this->entityManager->persist($plugin);
        $this->entityManager->flush();
    }

    /**
     * Return all plugins
     *
     * return array
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }

    /**
     * Returns plugin by pluginId
     */
    public function findOneByPluginId($pluginId)
    {
        return $this->repository->findOneByPluginId($pluginId);
    }
}