<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Inkstand\Bundle\CourseBundle\InkstandCourseBundle(),
            new Inkstand\Bundle\ThemeBundle\InkstandThemeBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Inkstand\Bundle\UserBundle\InkstandUserBundle(),
            new Inkstand\Activity\ExternalLinkBundle\InkstandExternalLinkBundle(),
            new Inkstand\Activity\ForumBundle\InkstandForumBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Inkstand\Bundle\CoreBundle\InkstandCoreBundle(),
            new Inkstand\Activity\ScormBundle\InkstandScormBundle(),
            new Inkstand\LrsBundle\InkstandLrsBundle(),
            new Inkstand\EnrollmentBundle\InkstandEnrollmentBundle(),
            new Oneup\FlysystemBundle\OneupFlysystemBundle(),
            new Inkstand\ResourceLibraryBundle\InkstandResourceLibraryBundle(),
            new Inkstand\Library\RatingBundle\InkstandRatingBundle(),
            new Inkstand\Library\TagBundle\InkstandTagBundle(),
            new Inkstand\Library\CalendarBundle\InkstandCalendarBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
