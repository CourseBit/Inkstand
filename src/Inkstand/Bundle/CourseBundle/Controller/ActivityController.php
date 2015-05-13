<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * inkstand_course_activity_view /course/activity/view/{slug}
 */
class ModuleController extends Controller
{
	/**
	 * @Route("/course/activity/view/{slug}", name="inkstand_course_activity_view")
	 * @param mixed $slug Slug of activity
	 */
	public function viewAction($slug) 
	{
		$activity = null;

		if(is_numeric($slug)) {
			$activity = $this->getDoctrine()
				->getRepository('InkstandCourseBundle:Activity')
			    ->findOneByActivityId($slug);
		} else {
			$activity = $this->getDoctrine()
				->getRepository('InkstandCourseBundle:Activity')
			    ->findOneBySlug($slug);
		}

		$controller = sprintf('%s:%s:view', $activity->getBundleName(), $activity->getActivityType());

		$response = $this->forward($controller, array(
			'activity' => $activity;
		));
	}
}