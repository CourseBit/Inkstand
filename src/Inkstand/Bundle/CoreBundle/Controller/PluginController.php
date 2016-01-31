<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
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

    /**
     * #Route("/admin/plugin/update/{pluginId}", name="inkstand_plugin_update")
     * @Template
     * @throws \Exception
     * @return array
     */
    public function updateAction($pluginId)
    {
        $plugin = $this->get('plugin_service')->findOneByPluginId($pluginId);

        if($plugin == null) {
            throw new \Exception('Plugin not found.');
        }


    }
}