<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Form\Type\ActivityType;

/**
 * inkstand_course_activity_view /course/activity/view/{slug}
 * inkstand_course_activity_add  /course/activity/add/{activityTypeId}/{moduleId}
 */
class ActivityController extends Controller
{
	/**
     * View an activity. This controller will forward to the activity's specific controller
     *
	 * @Route("/course/activity/view/{slug}", name="inkstand_course_activity_view")
	 * @param mixed $slug Slug of activity
     * @return null
	 */
	public function viewAction($slug) 
	{
		$activity = $this->get('activity_service')->findOneBySlug($slug);

		if($activity === null) {
			throw new NotFoundHttpException($this->get('translator')->trans('activity.notfound'));
		}

		$activityReflection = new \ReflectionClass($activity);

		$controller = sprintf('%s:%s:view', $activity->getActivityType()->getBundleName(), $activityReflection->getShortName());

		// TODO Check if controller exists. The error that shows currently doesn't explain what happened
		return $this->forward($controller, array(
			'activity' => $activity
		));
	}

	/**
	 * @Route("/course/activity/add/{activityTypeId}/{moduleId}", name="inkstand_course_activity_add")
     * @Template
     * @param Request $request
	 * @param mixed $activityTypeId ID of activity type to be added to course
     * @return array
	 */
	public function addAction(Request $request, $activityTypeId, $moduleId)
	{
		$activityType = $this->get('activity_type_service')->findOneByActivityTypeId($activityTypeId);
        $module = $this->get('module_service')->findOneByModuleId($moduleId);

		if($activityType === null) {
			throw new NotFoundHttpException($this->get('translator')->trans('activity.notfound'));
		}

        if($module === null) {
            throw new NotFoundHttpException($this->get('translator')->trans('module.notfound'));
        }

        // Each activity bundle must have a service for its activity. That is how a new activity entity is retrieved
        $activityService = $this->get(sprintf('%s_service', strtolower($activityType->getName())));

        $activity = $activityService->getNewEntity();

        $activity->setActivityTypeId($activityTypeId);
        $activity->setActivityType($activityType);
        $activity->setModuleId($moduleId);
        $activity->setModule($module);

        // TODO: What about sort order?
        $activity->setSortOrder(1);

        // Also get a new preferences entity. e.g. ForumPreferences
        $preferences = $activityService->getNewPreferences();
        $activity->setPreferences($preferences);

        $activityForm = $this->createForm(new ActivityType($preferences), $activity, array(
            'action' => $this->generateUrl('inkstand_course_activity_add', array('activityTypeId' => $activityTypeId, 'moduleId' => $moduleId)),
            'method' => 'POST'
        ));

        $activityForm->handleRequest($request);

        if ($activityForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            $preferences->setActivityId($activity->getActivityId());

            $em->persist($preferences);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('success', $this->get('translator')->trans('activity.added', array('%name%' => $activity->getName())));

            return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $activity->getModule()->getCourse()->getSlug())));
        }

        return array(
            'activity' => $activity,
            'activityForm' => $activityForm->createView(),
            'pageHeading' => 'activity.edit'
        );
	}

	/**
	 * @Route("/course/activity/edit/{activityId}", name="inkstand_course_activity_edit")
     * @Template
     * @param Request $request
	 * @param int $activityId ID of activity to edit
     * @return array
	 */
	public function editAction(Request $request, $activityId)
	{
		$activity = $this->getDoctrine()
		    ->getRepository('InkstandCourseBundle:Activity')
		    ->findOneByActivityId($activityId);

		if(empty($activity)) {
			throw new NotFoundHttpException($this->get('translator')->trans('Activity could not be found'));
		}

		$activityReflection = new \ReflectionClass($activity);

		// Get activity preferences. If none exist, create new preferences entity
		$preferences = $this->getDoctrine()
			->getRepository(sprintf('%s:%sPreferences', $activity->getActivityType()->getBundleName(), $activityReflection->getShortName()))
			->findOneByActivityId($activity->getActivityId());

		if($preferences == null) {
			$preferences = new \Inkstand\Activity\ForumBundle\Entity\ForumPreferences();
		}

		$activity->setPreferences($preferences);

		$activityForm = $this->createForm(new ActivityType($preferences), $activity, array(
			'action' => $this->generateUrl('inkstand_course_activity_edit', array('activityId' => $activity->getActivityId())),
			'method' => 'POST'
		));

		$activityForm->handleRequest($request);

		if ($activityForm->isValid()) {
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($activity);
	        $em->persist($preferences);
	        $em->flush();
	 
	        $session = $request->getSession();
	        $session->getFlashBag()->add('success', 'Course activity "' . $activity->getName() . '" edited');
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $activity->getModule()->getCourse()->getSlug())));
	    }

	    return array(
	    	'activity' => $activity,
			'activityForm' => $activityForm->createView(),
			'pageHeader' => 'Edit Course Activity'
		);
	}
}