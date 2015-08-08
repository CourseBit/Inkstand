<?php

namespace Inkstand\Bundle\CoreBundle\Service;

use Inkstand\Bundle\CoreBundle\Entity\Plugin;

class PluginService
{
    protected $entityManager;
    protected $repository;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRespository('InkstandCoreBundle:Plugin');
    }

    public function install($bundleClass, $enabled = 1)
    {
        if(!class_exists($bundleClass)) {
            throw new \Exception('Bundle class does not exist: ' . $bundleClass);
        }

        $plugin = new Plugin();
        $plugin->setBundleClass($bundleClass);
        $plugin->setEnabled($enabled);
        $this->entityManager->persist($plugin);
        $this->entityManager->flush();
    }
}