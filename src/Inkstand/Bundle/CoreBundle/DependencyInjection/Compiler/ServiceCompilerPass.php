<?php

namespace Inkstand\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class ServiceCompilerPass implements CompilerPassInterface
{
    private $tag;
    private $serviceId;
    private $methodName;

    public function __construct($tag, $serviceId, $methodName)
    {
        $this->tag = $tag;
        $this->serviceId = $serviceId;
        $this->methodName = $methodName;
    }

    public function process(ContainerBuilder $container)
    {
        // TODO: This doesn't work
        if (!$container->has($this->tag)) {
            //return;
        }

        $serviceDefinition = $container->findDefinition($this->serviceId);

        $taggedServices = $container->findTaggedServiceIds(
            $this->tag
        );

        foreach ($taggedServices as $id => $tags) {
            $serviceDefinition->addMethodCall(
                $this->methodName,
                array($id)
            );
        }
    }
}