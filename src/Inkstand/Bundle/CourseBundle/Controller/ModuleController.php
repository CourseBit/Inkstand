<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Inkstand\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Inkstand\Bundle\CourseBundle\Entity\Module;
use Inkstand\Bundle\CourseBundle\Form\Type\ModuleType;

/**
 * inkstand_course_module_add       /course/module/add/{courseId}
 * inkstand_course_module_edit      /course/module/edit/{moduleId}
 * inkstand_course_module_delete    /course/module/delete/{moduleId}
 * inkstand_course_module_move      /course/module/move/{moduleId}
 * inkstand_course_module_duplicate /course/module/duplicate/{moduleId}
 */
class ModuleController extends Controller
{
	/**
	 * @Route("/course/module/add/{courseId}", name="inkstand_course_module_add")
	 * @param int $courseId Module will be added to course
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

	/**
	 * @Route("/course/module/edit/{moduleId}", name="inkstand_course_module_edit")
	 * @param int $moduleId ID of module to edit
	 */
	public function editAction($moduleId)
	{
		$request = $this->getRequest();

		$module = $this->getDoctrine()
		    ->getRepository('InkstandCourseBundle:Module')
		    ->findOneByModuleId($moduleId);

		if(empty($module)) {
			throw new NotFoundHttpException($this->get('translator')->trans('Module could not be found'));
		}

		$course = $this->getDoctrine()
		    ->getRepository('InkstandCourseBundle:Course')
		    ->findOneByCourseId($module->getCourseId());

		if(empty($course)) {
			throw $this->createException($this->get('translator')->trans('Module is not associated with a course'));
		}

		$moduleForm = $this->createForm(new ModuleType(), $module, array(
			'action' => $this->generateUrl('inkstand_course_module_edit', array('moduleId' => $module->getModuleId())),
			'method' => 'POST'
		));

		$moduleForm->handleRequest($request);

		if ($moduleForm->isValid()) {
	        $em = $this->getDoctrine()->getManager();
	        $em->persist($module);
	        $em->flush();
	 
	        $session = $this->getRequest()->getSession();
	        $session->getFlashBag()->add('success', 'Course module "' . $module->getName() . '" edited');
	 		
	        return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
	    }

	    return $this->render('InkstandCourseBundle:Module:edit.html.twig', array(
	    	'course' => $course,
	    	'module' => $module,
			'moduleForm' => $moduleForm->createView(),
			'pageHeader' => 'Edit Course Module'
		));
	}

	/**
	 * @Route("/course/module/delete/{moduleId}", name="inkstand_course_module_delete")
	 * @param int $moduleId ID of module to delete
	 */
	public function deleteAction($moduleId)
	{
		$request = $this->getRequest();

		$module = $this->getDoctrine()
		    ->getRepository('InkstandCourseBundle:Module')
		    ->findOneByModuleId($moduleId);

		if(empty($module)) {
			throw new NotFoundHttpException($this->get('translator')->trans('Module could not be found'));
		}

		$course = $module->getCourse();

		if(empty($course)) {
			throw $this->createException($this->get('translator')->trans('Module is not associated with a course'));
		}

		$deleteForm = $this->createFormBuilder()
			->add('delete', 'submit', array(
				'label' => $this->get('translator')->trans('Delete'),
			))
			->add('cancel', 'submit', array(
				'label' => $this->get('translator')->trans('Cancel'),
			))
			->getForm();

		if($this->getRequest()->isMethod('POST')) {

			$deleteForm->handleRequest($request);

			if($deleteForm->get('delete')->isClicked()) {
				$em = $this->getDoctrine()->getManager();
		        $em->remove($module);
		        $em->flush();

		        $session = $this->getRequest()->getSession();
	        	$session->getFlashBag()->add('success', 'Course module "' . $module->getName() . '" deleted');

	        	return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
			}
		}

		return $this->render('InkstandCourseBundle:Module:delete.html.twig', array(
			'module' => $module,
			'course' => $course,
			'deleteForm' => $deleteForm->createView()
		));
	}

	/**
	 * @Template
	 */
	public function displayAction(Module $module)
	{
		if(!$this->isGranted('view', $module)) {
			return new Response();
		}

		if($module->getState() == Module::STATE_DRAFT && !$this->isGranted('edit', $module)) {
			return new Response();
		}

		return array('module' => $module);
	}

	/**
	 * @Route("/course/module/move/{moduleId}", name="inkstand_course_module_move")
	 * @param int $moduleId ID of module to move
	 */
	public function moveAction()
	{

	}

	/**
	 * @Route("/course/module/duplicate/{moduleId}", name="inkstand_course_module_duplicate")
	 * @param int $moduleId ID of module to duplicate
	 */
	public function duplicateAction()
	{

	}
}