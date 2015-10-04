<?php

namespace Inkstand\Bundle\CoreBundle\Scripts;

abstract class Script
{
    private $container;

    public function __construct($serviceContainer)
    {
        $this->container = $serviceContainer;
    }

    protected function getContainer()
    {
        return $this->container;
    }

    protected function getEntityManager()
    {
        return $this->container->get('doctrine.orm.entity_manager');
    }
}