<?php

namespace Inkstand\Bundle\CoreBundle\Controller;

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
		$this->denyAccessUnlessGranted('ROLE_ADMIN');
		return array();
	}
}