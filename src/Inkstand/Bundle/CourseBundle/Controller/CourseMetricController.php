<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\CourseMetric;
use Inkstand\Bundle\CourseBundle\Form\Type\CourseMetricType;

/**
 * inkstand_course_metric_add /course/metric/add
 *
 */
class CourseMetricController extends Controller
{
	/**
	 * Add a course metric
	 *
	 * @Route("/course/metric/add", name="inkstand_course_metric_add")
	 */
	public function addAction() 
	{
		$request = $this->getRequest();
		$courseMetric = new CourseMetric();

		$metricForm = $this->createForm(new CourseMetricType(), $courseMetric, array(
			'action' => $this->generateUrl('inkstand_course_metric_add'),
			'method' => 'POST'
		));

		$metricForm->handleRequest($request);

		if ($metricForm->isValid()) {
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($courseMetric);
	        $em->flush();
	 
	        $session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', 'Course metric "' . $courseMetric->getName() . '" added');
	 
	        return $this->redirect($this->generateUrl('inkstand_course_index'));
	    }

		return $this->render('InkstandCourseBundle:CourseMetric:add.html.twig', array(
			'metricForm' => $metricForm->createView(),
			'pageHeader' => 'Add Course Metric'
		));
	}
}