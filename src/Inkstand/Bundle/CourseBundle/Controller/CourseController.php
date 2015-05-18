<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\Bundle\CourseBundle\Form\Type\CourseType;

/**
 * inkstand_course_index  /course
 * inkstand_course_view   /course/view/{slug}
 * inkstand_course_add    /course/add/{categoryId} 
 * inkstand_course_manage /course/manage
 */
class CourseController extends Controller
{
	/**
	 * Course index page
	 * 
	 * @Route("/course", name="inkstand_course_index")
	 * @Template
	 */
	public function indexAction()
	{

		return array();    
	}

	/**
	 * View a course
	 * 
	 * @param mixed $slug Either the course_id or course_slug 
	 * @Route("/course/view/{slug}", name="inkstand_course_view")
	 * @Template
	 */
	public function viewAction($slug)
	{
		$course = null;

		if(is_numeric($slug)) {
			// Lookup course by course_id
			$course = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:Course')
		        ->findOneByCourseId($slug);
		} else {
			// Lookup course by slug
			$course = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:Course')
		        ->findOneBySlug($slug);
		}

		if(is_null($course)) {
			throw new NotFoundHttpException($this->get('translator')->trans('Course could not be found'));
		}

		$activityTypes = $this->getDoctrine()
			->getRepository('InkstandCourseBundle:ActivityType')
		    ->findAll();

		return array(
			'course' => $course,
			'activityTypes' => $activityTypes,
			'breadcrumbs' => array(
				array('title' => $course->getName(), 'route' => 'inkstand_course_view', 'parameters' => array('slug' => $course->getSlug()))
			),
			'pageHeader' => 'Course view'
		); 
	}

	/**
	 * Add a course
	 * 
	 * @Route("/course/add/{categoryId}", name="inkstand_course_add", defaults={"categoryId" = null})
	 * @Template
	 */
	public function addAction($categoryId)
	{
		$request = $this->getRequest();

		$course = new Course();

		// If route has categoryId, set that category on the course so it defaults in the form
		if(!empty($categoryId)) {
			$courseCategory = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:CourseCategory')
		        ->findOneByCategoryId($categoryId);

		    $course->setCategoryId($courseCategory->getCategoryId());
		}

		$courseForm = $this->createForm('course', $course, array(
			'action' => $this->generateUrl('inkstand_course_add'),
			'method' => 'POST'
		));

		$courseForm->handleRequest($request);

		if($courseForm->isValid()) {

			// Add category entity to course
			$courseCategory = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:CourseCategory')
		        ->findOneByCategoryId($course->getCategoryId());

		    $course->setCategory($courseCategory);

			$em = $this->getDoctrine()->getManager();
			$em->persist($course);
			$em->flush();

			$session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', $this->get('translator')->trans('course.added', array('%name%' => $course->getName())));
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

		return array(
			'courseForm' => $courseForm->createView(),
			'pageHeader' => 'Add Course'
		);
	}

	/**
	 * @Route("/course/manage", name="inkstand_course_manage")
	 * @Template
	 */
	public function manageAction()
	{
		return array();
	}
}