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

        $container->addCompilerPass(new ServiceCompilerPass('inkstand.voter', 'inkstand_core.voter', 'addVoter'));
        $container->addCompilerPass(new ServiceCompilerPass('inkstand.enrollment_type', 'inkstand_course.enrollment_type', 'addEnrollmentType'));
        //$container->addCompilerPass(new ServiceCompilerPass('inkstand.panel', 'inkstand_core.'))
    }
}
