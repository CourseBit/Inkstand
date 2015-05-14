<?php

namespace Inkstand\Activity\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ForumController extends Controller
{
	/**
	 * View a forum activity. 
     *
	 * This method is called from InkstandCourseBundle:Activity:view
	 */
	public function viewAction($activity) 
	{
		return $this->render('InkstandForumBundle:Forum:view.html.twig', array());
	}
}