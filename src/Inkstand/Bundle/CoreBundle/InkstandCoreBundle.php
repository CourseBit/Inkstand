<?php

namespace Inkstand\Bundle\CoreBundle;

use Inkstand\Bundle\CoreBundle\DependencyInjection\Compiler\ServiceCompilerPass;
use Inkstand\Bundle\CoreBundle\DependencyInjection\Compiler\VoterCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class InkstandCoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ServiceCompilerPass('security.voter', 'inkstand_core.voter', 'addVoter'));
    }
}
