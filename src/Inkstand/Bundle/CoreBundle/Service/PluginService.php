<?php

namespace Inkstand\Bundle\CoreBundle\Service;

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

    public function install(CompletePackage $package)
    {
        $plugin = new Plugin();
        $plugin->setName($package->getName());
        $plugin->setEnabled(1);
        $plugin->setVersion($package->getVersion());
        $plugin->setDescription($package->getDescription());
        $plugin->setHomepage($package->getHomepage());
        $plugin->setAuthors($package->getAuthors());
        $plugin->setSupport($package->getSupport());
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
}