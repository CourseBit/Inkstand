<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller for plugin management
 *
 */
class PluginController extends Controller
{
    /**
     * @Route("/admin/plugin/list", name="inkstand_plugin_list")
     * @Template
     * @return array
     */
    public function listAction()
    {
        $plugins = $this->get('plugin_service')->findAll();

        return array(
            'plugins' => $plugins
        );
    }
}