<?php

namespace Inkstand\ResourceLibraryBundle\Menu;

use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createResourceRateBreadcrumbs(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('Library', array('route' => 'inkstand_resource_library_index'));

        return $menu;
    }
}