<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Module;
use Inkstand\Bundle\CourseBundle\Form\Type\ModuleType;

/**
 * inkstand_course_metric_add /course/metric/add
 *
 */
class ModuleController extends Controller
{
	/**
	 * @Route("/course/module/add/{courseId}", name="inkstand_course_module_add")
	 * @param integer $courseId Module will be added to course
	 */
	public function addAction($courseId)
	{
		$request = $this->getRequest();

		if(empty($courseId)) {
			throw $this->createException('Course ID missing'); 
		}

		$course = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:Course')
		        ->findOneByCourseId($courseId);

		if(empty($course)) {
			throw new NotFoundHttpException($this->get('translator')->trans('Course could not be found'));
		}

		$module = new Module();
		$module->setCourseId($courseId);
		$module->setCourse($course);

		$moduleForm = $this->createForm(new ModuleType(), $module, array(
			'action' => $this->generateUrl('inkstand_course_module_add', array('courseId' => $courseId)),
			'method' => 'POST'
		));

		$moduleForm->handleRequest($request);

		if ($moduleForm->isValid()) {
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($module);
	        $em->flush();
	 
	        $session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', 'Course module "' . $module->getName() . '" added');
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

	    return $this->render('InkstandCourseBundle:Module:add.html.twig', array(
	    	'course' => $course,
			'moduleForm' => $moduleForm->createView(),
			'pageHeader' => 'Add Course Module'
		));
	}
}