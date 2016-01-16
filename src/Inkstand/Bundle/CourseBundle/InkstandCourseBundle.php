<?php

namespace Inkstand\Bundle\CourseBundle;

use Inkstand\Bundle\CoreBundle\DependencyInjection\Compiler\ServiceCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class InkstandCourseBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ServiceCompilerPass('inkstand.activity_type', 'inkstand_course.activity_type', 'addActivityType'));
    }
}
