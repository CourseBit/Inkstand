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
        $plugin->setBundleClass($package->getExtra()['bundle_class']);
        $plugin->setEnabled(1);
        $plugin->setVersion($package->getVersion());
        $this->entityManager->persist($plugin);
        $this->entityManager->flush();
    }
}