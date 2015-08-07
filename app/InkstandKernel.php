<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class InkstandKernel extends Kernel
{
    /**
     * @var \Inkstand\System\BundleFinderInterface
     */
    private $bundleFinder;

    public function registerBundles()
    {
        // First load bundle dependencies (non-Inkstand bundles)
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new Inkstand\Bundle\CourseBundle\InkstandCourseBundle(),
            new Inkstand\Bundle\ThemeBundle\InkstandThemeBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Inkstand\Bundle\UserBundle\InkstandUserBundle(),
            new Inkstand\Activity\ExternalLinkBundle\InkstandExternalLinkBundle(),
            new Inkstand\Activity\ForumBundle\InkstandForumBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Inkstand\Bundle\CoreBundle\InkstandCoreBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
        }

        // Now load bundles that belong to Inkstand
        if($this->bundleFinder == null) {
            throw new \Exception('No bundle finder was set. Call InkstandKernel::setBundleFinder()');
        }

        $locatedBundles = $this->bundleFinder->locateBundles(array(__DIR__ . '/../vendor', __DIR__ . '/../src'));
        $bundles = array_merge($bundles, $locatedBundles);

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }

    public function setBundleFinder(\Inkstand\System\BundleFinderInterface $bundleFinder)
    {
        $this->bundleFinder = $bundleFinder;
    }
}
