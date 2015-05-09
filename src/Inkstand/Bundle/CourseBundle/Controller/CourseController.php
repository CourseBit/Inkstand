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
	public function indexAction()
	{

		return $this->render('InkstandCourseBundle:Course:index.html.twig', array());    
	}

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

		return $this->render('InkstandCourseBundle:Course:view.html.twig', array(
			'course' => $course,
			'breadcrumbs' => array(
				array('title' => 'Home', 'route' => '_demo_login', 'parameters' => array()),
				array('title' => 'Courses', 'route' => '_demo_login', 'parameters' => array()),
				array('title' => $course->getName(), 'route' => 'inkstand_course_view', 'parameters' => array('slug' => $course->getSlug()))
			),
			'pageHeader' => 'Course view'
		)); 
	}

	public function addAction()
	{
		$request = $this->getRequest();



		$courseForm = $this->createForm('course', new Course(), array(
			'action' => $this->generateUrl('inkstand_course_add'),
			'method' => 'POST'
		));

		

		return $this->render('InkstandCourseBundle:Course:add.html.twig', array(
			'courseForm' => $courseForm->createView(),
			'pageHeader' => 'Add Course'
		));
	}
}