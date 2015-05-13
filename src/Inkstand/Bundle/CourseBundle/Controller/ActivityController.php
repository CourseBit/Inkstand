<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * inkstand_course_activity_view /course/activity/view/{slug}
 * inkstand_course_activity_add  /course/activity/add/{activityTypeId}
 */
class ActivityController extends Controller
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

		if($activity === null) {
			throw new NotFoundHttpException($this->get('translator')->trans('Activity could not be found'));
		}

		$activityReflection = new \ReflectionClass($activity);


		$controller = sprintf('%s:%s:view', $activity->getActivityType()->getBundleName(), $activityReflection->getShortName());

		// TODO Check if controller exists. The error that shows currently doesn't explain what happened
		return $this->forward($controller, array(
			'activity' => $activity
		));
	}

	/**
	 * @Route("/course/activity/add/{activityTypeId}", name="inkstand_course_activity_add")
	 * @param mixed $activityTypeId ID of activity type to be added to course
	 */
	public function addAction($activityTypeId) 
	{
		$activityType = $this->getDoctrine()
			->getRepository('InkstandCourseBundle:ActivityType')
			->findOneByActivityId($activityTypeId);

		if($activityType === null) {
			throw new NotFoundHttpException($this->get('translator')->trans('Activity Type could not be found'));
		}

		
	}
}