<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Course;

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
	 * @Route("/course/view/{slug}", name="inkstand_course_view")
     * @param mixed $slug Either the course_id or course_slug
     * @return array
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
			throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
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
	 * @Route("/course/list", name="inkstand_course_list")
	 * @Template
	 */
	public function listAction()
	{
		$courses = $this->getDoctrine()
	        ->getRepository('InkstandCourseBundle:Course')
	        ->findAll();

	    return array(
	    	'courses' => $courses
	    );
	}

	/**
	 * Add a course
	 * 
	 * @Route("/course/add", name="inkstand_course_add")
	 * @Template
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
	        $session->getFlashBag()->add('success', $this->get('translator')->trans('course.added', array('%name%' => $course->getName())));
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

		return array(
			'courseForm' => $courseForm->createView(),
			'pageHeader' => 'Add Course'
		);
	}

	/**
	 * Edit existing course
	 *
	 * @Route("/course/edit/{courseId}", name="inkstand_course_edit")
	 * @Template
     * @param int $courseId ID of course to edit
     * @return array
	 */
	public function editAction($courseId)
	{
		$request = $this->getRequest();

		$course = $this->getDoctrine()
	        ->getRepository('InkstandCourseBundle:Course')
	        ->findOneByCourseId($courseId);

	    if($course === null) {
	    	throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
	    }

		$courseForm = $this->createForm('course', $course, array(
			'action' => $this->generateUrl('inkstand_course_edit', array('courseId' => $courseId)),
			'method' => 'POST'
		));

		//$courseForm->get('actions')->get('save')->setOption('label', 'Update Course');

		$courseForm->handleRequest($request);

		if($courseForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($course);
			$em->flush();

			$session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', $this->get('translator')->trans('course.edited', array('%name%' => $course->getName())));
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

		return array(
			'courseForm' => $courseForm->createView(),
			'pageHeader' => 'Edit Course'
		);
	}

    /**
     * Delete a course
     *
     * @Route("/course/delete/{courseId}", name="inkstand_course_delete")
     * @param int $courseId ID of course to delete
     * @return array
     */
	public function deleteAction($courseId)
	{
		$request = $this->getRequest();

		$course = $this->getDoctrine()
		    ->getRepository('InkstandCourseBundle:Course')
		    ->findOneByCourseId($courseId);

		if(empty($course)) {
			throw new NotFoundHttpException($this->get('translator')->trans('course.notfound'));
		}

		$deleteForm = $this->createFormBuilder()
			->add('delete', 'submit', array(
				'label' => $this->get('translator')->trans('course.form.delete'),
			))
			->add('cancel', 'submit', array(
				'label' => $this->get('translator')->trans('button.cancel'),
			))
			->getForm();

		if($this->getRequest()->isMethod('POST')) {

			$deleteForm->handleRequest($request);

			if($deleteForm->get('delete')->isClicked()) {
				$em = $this->getDoctrine()->getManager();
		        $em->remove($course);
		        $em->flush();

		        $session = $this->getRequest()->getSession();
	        	$session->getFlashBag()->add('success', $this->get('translator')->trans('course.deleted', array('%name%' => $course->getName())));

                // TODO: Where should this redirect since course is deleted?
	        	return $this->redirect($this->generateUrl('inkstand_home'));
			}
		}

		return array(
			'course' => $course,
			'deleteForm' => $deleteForm->createView()
		);
	}
}