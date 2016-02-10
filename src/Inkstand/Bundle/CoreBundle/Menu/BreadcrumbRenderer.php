<?php

namespace Inkstand\Bundle\CoreBundle\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\RendererInterface;

class BreadcrumbRenderer implements RendererInterface
{
    /**
     * @var \Twig_Environment
     */
    private $environment;
    private $template;

    /**
     * @param \Twig_Environment $environment
     * @param string            $template
     */
    public function __construct(\Twig_Environment $environment, $template)
    {
        $this->environment = $environment;
        $this->template = $template;
    }

    /**
     * {@inheritdoc}
     */
    public function render(ItemInterface $item, array $options = array())
    {
        dump($item);
        $html = $this->environment->render($this->template, array('item' => $item));

        return $html;
    }
}