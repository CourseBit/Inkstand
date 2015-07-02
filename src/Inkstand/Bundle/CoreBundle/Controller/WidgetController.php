<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class WidgetController
 * @package Inkstand\Bundle\CoreBundle\Controller
 *
 * Controller for widget operations and pages,
 * mainly for administration of widgets
 *
 * inkstand_widget_list /widget/list
 */
class WidgetController extends Controller
{
    /**
     * @Route("/widget/list", name="inkstand_widget_list")
     * @Template
     * @return array
     */
    public function listAction()
    {
        $widgets = $this->get('widget_service')->getWidgets();

        dump($widgets);

        return array(
            'widgets' => $widgets
        );
    }
}