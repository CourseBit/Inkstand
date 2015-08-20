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
     * @param integer $pluginId
     * @return Plugin|null
     */
    public function findOneByPluginId($pluginId)
    {
        return $this->repository->findOneByPluginId($pluginId);
    }

    /**
     * Return a plugin by it's composer name (vender/package-name)
     *
     * @param $name
     * @return mixed
     */
    public function findOneByName($name)
    {
        return $this->repository->findOneByName($name);
    }

    /**
     * Install a plugin to the database
     *
     * @param CompletePackage $package
     * @param string $installPath
     */
    public function install(CompletePackage $package, $installPath = null)
    {
        $plugin = new Plugin();
        $plugin->setName($package->getName());
        $plugin->setEnabled(1);
        $plugin->setVersion($package->getVersion());
        $plugin->setDescription($package->getDescription());
        $plugin->setHomepage($package->getHomepage());
        $plugin->setAuthors($package->getAuthors());
        // getSupport() is always going to return empty an array. Maybe this will change in the future
        $plugin->setSupport($package->getSupport());
        $plugin->setDateInstalled(new \DateTime());
        $plugin->setDateUpdated(new \DateTime());

        // Get full package json file. The package json from composer update/install does not include support properties
        // https://github.com/CourseBit/Inkstand/issues/4
        if($installPath != null) {
            $packageJson = json_decode(file_get_contents(sprintf('%s/composer.json', $installPath)));

            if (!empty($packageJson) && isset($packageJson->support)) {
                $plugin->setSupport($packageJson->support);
            }
        }

        $plugin->setBundleClass($package->getExtra()['bundle_class']);
        $plugin->setBundleTitle($package->getExtra()['bundle_title']);
        $this->entityManager->persist($plugin);
        $this->entityManager->flush();
    }

    public function update(CompletePackage $package, $installPath = null)
    {
        $plugin = $this->findOneByName($package->getName());

        if($plugin == null) {
            error_log('Tried to update a plugin that wasn\'t in the database: ' . $package->getName());
        }

        $plugin->setVersion($package->getVersion());
        $plugin->setDescription($package->getDescription());
        $plugin->setHomepage($package->getHomepage());
        $plugin->setAuthors($package->getAuthors());
        // getSupport() is always going to return empty an array. Maybe this will change in the future
        $plugin->setSupport($package->getSupport());
        $plugin->setDateUpdated(new \DateTime());

        // Get full package json file. The package json from composer update/install does not include support properties
        // https://github.com/CourseBit/Inkstand/issues/4
        if($installPath != null) {
            $packageJson = json_decode(file_get_contents(sprintf('%s/composer.json', $installPath)));

            if (!empty($packageJson) && isset($packageJson->support)) {
                $plugin->setSupport($packageJson->support);
            }
        }

        $plugin->setBundleClass($package->getExtra()['bundle_class']);
        $plugin->setBundleTitle($package->getExtra()['bundle_title']);
        $this->entityManager->persist($plugin);
        $this->entityManager->flush();
    }

    /**
     * Uninstall a plugin from the database
     *
     * @param CompletePackage $package
     */
    public function uninstall(CompletePackage $package)
    {
        $plugin = $this->findOneByName($package->getName());

        if($plugin != null) {
            $this->entityManager->remove($plugin);
            $this->entityManager->flush();
        } else {
            error_log('Tried to uninstall a plugin that wasn\'t in the database: ' . $package->getName());
        }
    }
}