<?php

namespace Inkstand\ResourceLibraryBundle\Menu;

use Inkstand\ResourceLibraryBundle\Model\ResourceInterface;
use Inkstand\ResourceLibraryBundle\Model\TopicInterface;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function libraryIndexBreadcrumb(FactoryInterface $factory, array $optiona)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('resource_library.library');

        return $menu;
    }

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

    public function topicIndexBreadcrumb(FactoryInterface $factory, array $optiona)
    {
        $menu = $factory->createItem('root');
        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('resource_library.library', array('route' => 'inkstand_resource_library_index'));
        $menu->addChild('Topics');

        return $menu;
    }

    public function topicViewBreadcrumb(FactoryInterface $factory, array $options)
    {
        if(!array_key_exists('topic', $options)) {
            throw new \LogicException('Must pass in topic to breadcrumb');
        }

        /** @var TopicInterface $topic */
        $topic = $options['topic'];

        $menu = $factory->createItem('root');
        $menu->addChild('dashboard', array('route' => 'inkstand_dashboard'));
        $menu->addChild('resource_library.library', array('route' => 'inkstand_resource_library_index'));
        $menu->addChild('Topics', array('route' => 'inkstand_resource_library_topic_index'));
        $menu->addChild($topic->getName());

        return $menu;
    }
}