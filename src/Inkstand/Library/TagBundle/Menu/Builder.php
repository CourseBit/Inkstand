<?php

namespace Inkstand\Library\TagBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function tagAddBreadcrumb(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('tag.tag');
        $menu->addChild('tag.add');

        return $menu;
    }

    public function tagEditBreadcrumb(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('tag.tag');
        $menu->addChild('tag.edit');

        return $menu;
    }

    public function tagListBreadcrumb(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('tag.tag');
        $menu->addChild('tag.list');

        return $menu;
    }
}