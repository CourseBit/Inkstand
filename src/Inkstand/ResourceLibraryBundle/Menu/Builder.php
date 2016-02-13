<?php

namespace Inkstand\ResourceLibraryBundle\Menu;

use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function resourceRateBreadcrumb(FactoryInterface $factory, array $options)
    {
        if(!array_key_exists('resource', $options)) {
            throw new \LogicException('Must pass in resource to breadcrumb');
        }

        /** @var ResourceInterface $resource */
        $resource = $options['resource'];

        $menu = $factory->createItem('root');

        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('resource_library.library', array('route' => 'inkstand_resource_library_index'));
        $menu->addChild($resource->getName(), array('route' => 'inkstand_resource_library_resource_view', 'routeParameters' => array('resourceId' => $options['resource']->getResourceId())));
        $menu->addChild('rating.rate');

        return $menu;
    }

    public function resourceAddBreadcrumb(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('resource_library.library', array('route' => 'inkstand_resource_library_index'));
        $menu->addChild('resource_library.resource.add');

        return $menu;
    }
}