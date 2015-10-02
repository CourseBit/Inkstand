<?php

namespace Inkstand\Bundle\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class VoterCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('security.voter')) {
            //return;
        }

        $voterServiceDefinition = $container->findDefinition('inkstand_core.voter');

        $taggedServices = $container->findTaggedServiceIds(
            'security.voter'
        );

        foreach ($taggedServices as $id => $tags) {
            $voterServiceDefinition->addMethodCall(
                'addVoter',
                array($id)
            );
        }
    }
}