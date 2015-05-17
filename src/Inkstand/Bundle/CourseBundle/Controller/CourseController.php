<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Course;
use Inkstand\Bundle\CourseBundle\Form\Type\CourseType;

class CourseController extends Controller
{
	/**
	 * Course index page
	 * 
	 * @Route("/course", name="inkstand_course_index")
	 */
	public function indexAction()
	{

		return $this->render('InkstandCourseBundle:Course:index.html.twig', array());    
	}

	/**
	 * View a course
	 * 
	 * @param mixed $slug Either the course_id or course_slug 
	 * @Route("/course/view/{slug}", name="inkstand_course_view")
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

		return $this->render('InkstandCourseBundle:Course:view.html.twig', array(
			'course' => $course,
			'activityTypes' => $activityTypes,
			'breadcrumbs' => array(
				array('title' => $course->getName(), 'route' => 'inkstand_course_view', 'parameters' => array('slug' => $course->getSlug()))
			),
			'pageHeader' => 'Course view'
		)); 
	}

	/**
	 * Add a course
	 * 
	 * @Route("/course/add", name="inkstand_course_add")
	 */
	public function addAction()
	{
		$request = $this->getRequest();

		$course = new Course();

		$courseForm = $this->createForm('course', $course, array(
			'action' => $this->generateUrl('inkstand_course_add'),
			'method' => 'POST'
		));

		$courseForm->handleRequest($request);

		// Add category entity to course
		$courseCategory = $this->getDoctrine()
	        ->getRepository('InkstandCourseBundle:CourseCategory')
	        ->findOneByCategoryId($course->getCategoryId());
	    $course->setCategory($courseCategory);

		if($courseForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($course);
			$em->flush();

			$session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', 'Course "' . $course->getName() . '" added');
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

		return $this->render('InkstandCourseBundle:Course:add.html.twig', array(
			'courseForm' => $courseForm->createView(),
			'pageHeader' => 'Add Course'
		));
	}
}