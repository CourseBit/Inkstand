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

		$module = new Module();
		$module->setCourseId($courseId);

		$moduleForm = $this->createForm(new ModuleType(), $module, array(
			'action' => $this->generateUrl('inkstand_course_module_add', array('courseId' => $courseId)),
			'method' => 'POST'
		));

		$metricForm->handleRequest($request);
	}
}