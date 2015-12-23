<?php

namespace Inkstand\Bundle\CourseBundle\Controller;

use Inkstand\Bundle\CourseBundle\Entity\CourseCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CourseCategoryController extends Controller
{
	/**
	 * View a list of course categories
	 *
	 * @Route("/category")
	 */
	public function indexAction() {

	}

	/**
	 * View a single course category
	 * 
	 * @param mixed $slug Required route parameter. Either the category_id or category_slug 
	 * @Route("/category/view{slug}")
	 */
	public function viewAction($slug) {

		$category = null;

		if(is_numeric($slug)) {
			// get category by category_id
			$category = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:CourseCategory')
		        ->findOneByCategoryId($slug);
		} else {
			// get category by URL slug
			$category = $this->getDoctrine()
		        ->getRepository('InkstandCourseBundle:CourseCategory')
		        ->findOneBySlug($slug);
		}

		if($category === null) {
			throw $this->createNotFoundException($this->get('translator')->trans('Category not found'));
		}

		return $this->render('InkstandCourseBundle:CourseCategory:view.html.twig', array(
			'category' => $category,
			'pageHeader' => $category->getName()
		));
	}

	/**
	 * Add a CourseCategory
	 *
	 * @Route("/category/add", name="inkstand_course_category_add")
	 * @Template
	 * @param Request $request
	 * @return array
	 */
	public function addAction(Request $request)
	{
		$courseCategory = new CourseCategory();

		$courseCategoryForm = $this->createForm('courseCategory', $courseCategory, array(
			'action' => $this->generateUrl('inkstand_course_category_add'),
			'method' => 'POST'
		));

		$courseCategoryForm->handleRequest($request);

		if($courseCategoryForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($courseCategory);
			$em->flush();

			$session = $request->getSession();
			$session->getFlashBag()->add('success', $this->get('translator')->trans('course.category.added', array('%name%' => $courseCategory->getName())));

			//return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
		}

		return array(
			'courseCategoryForm' => $courseCategoryForm->createView()
		);
	}

	/**
	 * Edit existing CourseCategory
	 *
	 * @Route("/category/edit/{categoryId}", name="inkstand_course_category_edit")
	 * @Template
	 * @param Request $request
	 * @param int $categoryId ID of CourseCategory to edit
	 * @return array
	 */
	public function editAction(Request $request, $categoryId)
	{
		$courseCategory = $this->get('course_category_service')->findOneByCategoryId($categoryId);

		if($courseCategory === null) {
			throw new NotFoundHttpException($this->get('translator')->trans('course.category.notfound'));
		}

		$courseCategoryForm = $this->createForm('courseCategory', $courseCategory, array(
			'action' => $this->generateUrl('inkstand_course_category_edit', array('categoryId' => $categoryId)),
			'method' => 'POST'
		));

		$courseCategoryForm->handleRequest($request);

		// TODO: Check if the cancel button was clicked

		if($courseCategoryForm->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($courseCategory);
			$em->flush();

			$session = $request->getSession();
			$session->getFlashBag()->add('success', $this->get('translator')->trans('course.category.edited', array('%name%' => $courseCategory->getName())));

			//return $this->redirect($this->generateUrl('inkstand_course_view', array('slug' => $course->getSlug())));
		}

		return array(
			'courseCategory' => $courseCategory,
			'courseCategoryForm' => $courseCategoryForm->createView()
		);
	}
}