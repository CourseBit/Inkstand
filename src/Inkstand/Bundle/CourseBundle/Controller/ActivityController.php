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
	 * @Route("/course/activity/add/{activityTypeId}/{moduleId}", name="inkstand_course_activity_add")
     * @Template
     * @param Request $request
	 * @param mixed $activityTypeId ID of activity type to be added to course
     * @return array
	 */
	public function addAction(Request $request, $activityTypeId, $moduleId)
	{
		$activityType = $this->getDoctrine()
			->getRepository('InkstandCourseBundle:ActivityType')
			->findOneByActivityTypeId($activityTypeId);

		if($activityType === null) {
			throw new NotFoundHttpException($this->get('translator')->trans('Activity Type could not be found'));
		}

        $activityService = $this->get(sprintf('%s_service', strtolower($activityType->getName())));

        $activity = $activityService->getNewEntity();

        $activityType = $this->getDoctrine()
            ->getRepository('InkstandCourseBundle:ActivityType')
            ->findOneByActivityTypeId($activityTypeId);
        $activity->setActivityTypeId($activityTypeId);
        $activity->setActivityType($activityType);
        $activity->setSortOrder(1);


        $module = $this->getDoctrine()
            ->getRepository('InkstandCourseBundle:Module')
            ->findOneByModuleId($moduleId);
        $activity->setModuleId($moduleId);
        $activity->setModule($module);

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
            $session->getFlashBag()->add('success', 'Course activity "' . $activity->getName() . '" edited');

            return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $activity->getModule()->getCourse()->getSlug())));
        }

        return array(
            'activity' => $activity,
            'activityForm' => $activityForm->createView(),
            'pageHeader' => 'Edit Course Activity'
        );
	}

	/**
	 * @Route("/course/activity/edit/{activityId}", name="inkstand_course_activity_edit")
	 * @param int $activityId ID of activity to edit
	 */
	public function editAction($activityId)
	{
		$request = $this->getRequest();

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
	 
	        $session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', 'Course activity "' . $activity->getName() . '" edited');
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $activity->getModule()->getCourse()->getSlug())));
	    }

	    return $this->render('InkstandCourseBundle:Activity:edit.html.twig', array(
	    	'activity' => $activity,
			'activityForm' => $activityForm->createView(),
			'pageHeader' => 'Edit Course Activity'
		));
	}
}