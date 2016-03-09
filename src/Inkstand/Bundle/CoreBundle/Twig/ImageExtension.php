<?php

namespace Inkstand\Bundle\CoreBundle\Twig;

use Inkstand\Bundle\CoreBundle\Entity\FileReference;
use Symfony\Component\Routing\RouterInterface;

class ImageExtension extends \Twig_Extension
{
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return array(
            'image' => new \Twig_SimpleFunction('image', array($this, 'image'))
        );
    }

    public function image(FileReference $fileReference = null)
    {
        if(null === $fileReference) {
            return "";
        }
        return $this->router->generate('inkstand_core_file_image', array('fileReferenceId' => $fileReference->getFileReferenceId()));
    }

    public function getName()
    {
        return 'image_extension';
    }
}