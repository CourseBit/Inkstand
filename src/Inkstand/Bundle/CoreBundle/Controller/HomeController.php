<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

use Inkstand\Bundle\CoreBundle\Event\DashboardEvent;
use Inkstand\Bundle\CoreBundle\Event\DashboardEvents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller for "home" pages, like the dashboard
 *
 * inkstand_home      /
 * inkstand_dashboard /dashboard
 */
class HomeController extends Controller 
{
	/**
	 * Homepage of Inkstand. This action will forward to controllers based on criteria.
	 *
	 * @Route("/", name="inkstand_home")
	 */
	public function indexAction()
	{
		$forwardController = 'InkstandCoreBundle:Home:dashboard';

		return $this->forward($forwardController);
	}

	/**
	 * @Route("/dashboard", name="inkstand_dashboard")
	 * @Template
	 */
	public function dashboardAction()
	{
        $widgetService = $this->get('widget_service');
        $widgets = $widgetService->getWidgets();

		return array();
	}

	/**
	 * @Route("/help", name="inkstand_help")
	 * @Template
	 */
	public function helpAction()
	{
		return array();
	}
}